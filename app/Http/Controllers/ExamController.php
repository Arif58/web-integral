<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Question;
use App\Models\SubTest;
use App\Models\UserAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

        return view('web.sections.exam.test', compact('questions', 'subTest', 'participantId'));
    }

    public function submitAnswer(Request $request)
    {
        try {

            $participantId = $request->participant_id;
            $answers = $request->answers;
            $startTest = $request->startTest ?? null;
            $endTest = $request->endTest ?? null;

            // Debug log
            Log::info("Start Test: ", ['startTest' => $startTest]);
        
            foreach ($answers as $questionId => $answer) {
                if (is_array($answer)) {
                    foreach ($answer as $subAnswer) {
                        if (is_array($subAnswer)) {
                            // For 'pernyataan' and 'isian_singkat' with answer_text
                            $testAnswerId = $subAnswer[0];
                            $answerText = $subAnswer[1];
                            UserAnswer::updateOrCreate(
                                [
                                    'participant_id' => $participantId, 
                                    'question_id' => $questionId, 
                                    'test_answer_id' => $testAnswerId,
                                    'answer_text' => $answerText
                                ],
                            );
                        } else {
                            // For 'pilihan_ganda_majemuk' dan 'pilihan_ganda
                            $testAnswerId = $subAnswer;
                            UserAnswer::updateOrCreate(
                                [
                                    'participant_id' => $participantId, 
                                    'question_id' => $questionId, 
                                    'test_answer_id' => $testAnswerId,
                                    'answer_text' => null
                                ],
                            );
                        }
                    }
                } else {
                    // For 'pilihan_ganda', 'pilihan_ganda_majemuk' tidak ada jawaban
                    UserAnswer::updateOrCreate(
                        [
                            'participant_id' => $participantId, 
                            'question_id' => $questionId, 
                            'test_answer_id' => null,
                            'answer_text' => null
                        ],
                    );
                }
            }

            if ($startTest) {
                Participant::where('id', $participantId)->update(
                    ['start_test' => $startTest]
                );
            }

            Participant::where('id', $participantId)->update(
                ['end_test' => $endTest]
            );
    
            return response()->json(['success' => true,'message' => 'Answer submitted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
