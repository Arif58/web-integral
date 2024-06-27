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
        $timeNow = Carbon::parse(now())->setTimezone('Asia/Jakarta');
        $myTryOuts = Participant::where('user_id', auth()->id())->with('tryOut')->get();
        
        $otherTryOuts = Product::whereNotIn('tryout_id', function($query) {
            $query->select('tryout_id')->from('participants')->where('user_id', auth()->id());
        })->get();

        $otherTryOuts = $otherTryOuts->filter(function($product) use ($timeNow) {
            return Carbon::parse($product->tryOut->end_date)->setTimezone('Asia/Jakarta') > $timeNow;
        });

        return view('web.sections.dashboard.student.my-tryout', compact('myTryOuts', 'otherTryOuts'));

    }
}
