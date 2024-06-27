<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Question;
use App\Models\SubTest;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index($id)
    {
        $participant = Participant::where('id', $id)->with('tryOut')->first();

        $subTest = $participant->tryOut->subTests()->with('questions', 'categorySubtest')->get();

        //pass the data as JSON
        $subTestIds = $subTest->pluck('id');

        return view('web.sections.exam.confirm-test', compact('participant', 'subTest', 'subTestIds'));
    }

    public function getQuestion($participantId, $subTestId)
    {
        $subTest = SubTest::where('id', $subTestId)->with('questions')->first();

        $questions = Question::where('sub_test_id', $subTestId)->with('questionChoices')->get();

        return view('web.sections.exam.test', compact('questions', 'subTest'));
    }
}
