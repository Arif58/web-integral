<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MyTryOutController extends Controller
{
    public function index()
    {
        $myTryOuts = Participant::where('user_id', auth()->id())->with('tryOut')->get();
        
        $otherTryOuts = Product::whereNotIn('tryout_id', function($query) {
            $query->select('tryout_id')->from('participants')->where('user_id', auth()->id());
        })->get();

        return view('web.sections.dashboard.student.my-tryout', compact('myTryOuts', 'otherTryOuts'));

    }
}
