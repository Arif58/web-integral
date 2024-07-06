<?php

namespace App\Http\Controllers;

use App\Models\IeGemsHistory;
use App\Models\Major;
use App\Models\Participant;
use App\Models\Question;
use App\Models\SubTest;
use App\Models\User;
use App\Models\UserAnswer;
use App\Models\UserItemScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            DB::transaction(function() use ($request) {
                $participantId = $request->participant_id;
                $answers = $request->answers;
                $startTest = $request->startTest ?? null;
                $endTest = $request->endTest ?? null;
                $ieGems = $request->ieGems ?? null;
            
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
    
                if ($endTest) {
                    Participant::where('id', $participantId)->update(
                        ['end_test' => $endTest]
                    );
                }
    
                if ($ieGems) {
                    $userid = Participant::where('id', $participantId)->first()->user_id;
                    IeGemsHistory::create([
                        'user_id' => $userid,
                        'gems' => $ieGems,
                        'type' => 'in',
                    ]);
    
                    User::where('id', $userid)->increment('ie_gems', $ieGems);
                }
            });
    
            return response()->json(['success' => true, 'message' => 'Answer submitted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function finishExam($participantId)
    {
        $participant = Participant::where('id', $participantId)->with('tryOut')->first();

        return view('web.sections.exam.finish-test', compact('participant'));
    }

    public function getExamResult($participantId)
    {
        $participant = Participant::where('id', $participantId)->with('tryOut', 'user')->first();

        $subTest = $participant->tryOut->subTests()->with('questions', 'categorySubtest')->get();

        // $tryOutParticipantsIds = Participant::where('tryout_id', $participant->tryout_id)->pluck('id');

        $subTestIds = $subTest->pluck('id');

        $averageAllParticipantScore = Participant::where('tryout_id', $participant->tryout_id)->avg('average_score');
        $averageAllParticipantScore = number_format($averageAllParticipantScore, 2);

        //mencari peringkat peserta
        $rankParticipant = Participant::where('tryout_id', $participant->tryout_id)
            ->where('average_score', '>', $participant->average_score)
            ->count() + 1;

        // $participantScore = UserItemScore::whereIn('question_id', function($query) use ($subTestIds) {
        //     $query->select('id')
        //         ->from('questions')
        //         ->whereIn('sub_test_id', $subTestIds);
        // })->where('participant_id', $participantId);

        //rata rata skor peserta pada tryout
        // $averageAllParticipantScore = UserItemScore::select('participant_id', DB::raw('sum(score) as total_score'))
        //     ->whereIn('question_id', function($query) use ($subTestIds) {
        //         $query->select('id')
        //             ->from('questions')
        //             ->whereIn('sub_test_id', $subTestIds);
        //     })->whereIn('participant_id', $tryOutParticipantsIds)
        //     ->groupBy('participant_id')
        //     ->get();


        $totalQuestion = Question::whereIn('sub_test_id', $subTestIds)->count();

        // $averageScore = $participantScore->sum('score') / $totalQuestion;
        // $totalAnswered = $participantScore->count();

        $firstMajor = Major::where('id', $participant->user->first_major)->with('university')->first();
        $secondMajor = Major::where('id', $participant->user->second_major)->with('university')->first();
        // dd($participant, $subTest, $answers, $subTestIds);

        return view('web.sections.exam.result', compact('participant', 'subTest', 'subTestIds', 'firstMajor', 'secondMajor', 'averageAllParticipantScore', 'rankParticipant'));
    }
}
