<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $participant = Participant::where('user_id', auth()->id())->get();
        $registeredExams = $participant->count();
        $finishedExams = $participant->where('start_test', '!=', null)->where('end_test', '!=', null)->count();
        $unfinishedExams = $participant->where('start_test', null)->where('end_test', null)->count();

        return view('web.sections.dashboard.dashboard', compact('registeredExams', 'finishedExams', 'unfinishedExams'));
    }
}
