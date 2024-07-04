<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ParticipantController extends Controller
{
    public function index($productId) {

        $product = Product::where('id', $productId)->with('participants')->first();

        return view('web.sections.dashboard.admin.participants', compact('product'));
    }

    public function getParticipant($productId) {
        $products = Product::where('id',$productId)->first();
        
        $query = Participant::where('tryout_id', $products->tryout_id)->with('user', 'userScores')->get();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('name', function ($participant) {
                return $participant->user->username;
            })
            ->addColumn('email', function ($participant) {
                return $participant->user->email;
            })
            ->addColumn('average_score', function ($participant) {
                $avg = $participant->userScores->avg('score');
                if ($avg == null) {
                    return 'Belum ada nilai';
                }
                $avg = number_format($avg, 2) + 200;
                return $avg;
            })
            ->make(true);
    }
}
