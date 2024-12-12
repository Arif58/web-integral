<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MyTryOutController extends Controller
{
    public function index()
    {
        $boundary = 6;
        $timeNow = Carbon::parse(now())->setTimezone('Asia/Jakarta');
        $myTryOuts = Participant::where('user_id', auth()->id())->with('tryOut')->get();
        // dd($myTryOuts);
        

        //query untuk mendapatkan produk tryout yang belum selesai dikerjakan
        $unfinishedTryOuts = $myTryOuts->where('end_test', null)->filter(function ($tryOut) use ($timeNow) {
            $startTest = $tryOut->start_test;
            $endTestWindow = $startTest ? $startTest->copy()->addHours(4) : null;

            // Jika start_test null, tetap dianggap unfinished
            if (is_null($startTest)) {
                return true;
            }

            // Jika start_test ada, periksa apakah timeNow berada dalam rentang
            return $timeNow->between($startTest, $endTestWindow);
        });

    

        //query untuk mendapatkan produk tryout yang sudah dikerjakan dan sudah selesai
        $finishedTryOuts = $myTryOuts->where('end_test', '!=', null);
        
        // Query untuk mendapatkan produk tryout yang belum diikuti oleh pengguna saat ini dan belum berakhir
        $otherTryOuts = Product::whereNotIn('tryout_id', function($query) {
            $query->select('tryout_id')
                ->from('participants')
                ->where('user_id', auth()->id());
        })
        ->join('try_outs', 'products.tryout_id', '=', 'try_outs.id') // Bergabung dengan tabel try_outs
        ->where('try_outs.end_date', '>', $timeNow)
        ->orderBy('try_outs.start_date', 'asc') 
        ->paginate($boundary, ['products.*']); // Mengambil semua kolom dari tabel products

        return view('web.sections.dashboard.student.my-tryout', compact('myTryOuts', 'otherTryOuts', 'boundary', 'timeNow', 'unfinishedTryOuts', 'finishedTryOuts'));

    }
}
