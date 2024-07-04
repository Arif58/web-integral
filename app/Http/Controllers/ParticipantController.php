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
        // $query = Participant::where('tryout_id', $product->tryout_id)->with('user', 'userScores')->get();
        // dd($query->first()->userScores()->avg('score'));
        // $participants = Participant::where('tryout_id', $product->tryout_id)->with('user')->get();
        // dd($participants);

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
                $avg = number_format($avg, 2);
                return $avg;
            })
            ->make(true);
    }
}
