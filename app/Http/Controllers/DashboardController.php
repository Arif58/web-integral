<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Participant;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() {
        if (Auth::user()->role == 'student') {        
            $participant = Participant::where('user_id', auth()->id())->get();
            $registeredExams = $participant->count();
            $finishedExams = $participant->where('start_test', '!=', null)->where('end_test', '!=', null)->count();
            $unfinishedExams = $participant->where('start_test', null)->where('end_test', null)->count();

            $participantScore = Participant::select('tryout_id','try_outs.name', 'participants.average_score')
                ->join('try_outs', 'participants.tryout_id', '=', 'try_outs.id')
                ->where('participants.user_id', auth()->id())
                ->where('participants.average_score', '!=', null)
                ->get();
            
            $tryOutAvg = Participant::select('participants.tryout_id', 'try_outs.name', DB::raw('AVG(participants.average_score) as avg_score'))
                ->join('try_outs', 'participants.tryout_id', '=', 'try_outs.id')
                ->whereNotNull('participants.average_score')
                ->groupBy('participants.tryout_id', 'try_outs.name')
                ->get();
            // dd($participantScore, $subtestAvg);
    
            return view('web.sections.dashboard.student.dashboard', compact('registeredExams', 'finishedExams', 'unfinishedExams', 'participantScore', 'tryOutAvg'));
        }
        elseif (Auth::user()->role == 'admin') {
            // $countTryoutParticipant = Participant::select('try_outs.id','try_outs.name', 'count(*) as total')
            //     ->join('try_outs', 'participants.tryout_id', '=', 'try_outs.id')
            //     ->groupBy('try_outs.id')
            //     ->get();
            $tryoutParticipant = Participant::select('tryout_id', 'try_outs.name', DB::raw('count(participants.id) as total'))
                ->join('try_outs', 'participants.tryout_id', '=', 'try_outs.id')
                ->orderBy('try_outs.start_date', 'asc')
                ->groupBy('tryout_id', 'try_outs.name')
                ->get();
        
            $tryoutIncome = Order::select('products.tryout_id', 'try_outs.name', DB::raw('sum(orders.total_price) as total'))
                ->join('products', 'orders.product_id', '=', 'products.id')
                ->join('try_outs', 'products.tryout_id', '=', 'try_outs.id')
                ->where('orders.status', 'success')
                ->where('orders.payment_method', '=', 'qris')
                ->groupBy('products.tryout_id', 'try_outs.name')
                ->orderBy('try_outs.start_date', 'asc')
                ->get();
            
            $products = Product::select('tryout_id', 'try_outs.name')
            ->join('try_outs', 'products.tryout_id', '=', 'try_outs.id')
            ->groupBy('tryout_id', 'try_outs.name')
            ->orderBy('try_outs.start_date', 'asc')
            ->get();
                        
            return view('web.sections.dashboard.admin.dashboard', compact('tryoutParticipant', 'tryoutIncome', 'products'));
        }
    }
}
