<?php

namespace App\Http\Controllers;

use App\Models\CategorySubtest;
use App\Models\IeGemsHistory;
use App\Models\Major;
use App\Models\Participant;
use App\Models\Product;
use App\Models\Question;
use App\Models\SubTest;
use App\Models\User;
use App\Models\UserAnswer;
use App\Models\UserItemScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

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

        $subTests = SubTest::select('sub_tests.id', 'sub_tests.name', 'category_subtest_id', 'category_subtests.name as category_name')
            ->join('category_subtests', 'sub_tests.category_subtest_id', '=', 'category_subtests.id')
            ->where('try_out_id', $participant->tryout_id)->get();

        $categorySubtest = $subTests->pluck('category_name','category_subtest_id')->unique();

        $subTestIds = $subTests->pluck('id');

        $averageAllParticipantScore = Participant::where('tryout_id', $participant->tryout_id)->avg('average_score');
        $averageAllParticipantScore = number_format($averageAllParticipantScore, 2);

        //mencari peringkat peserta
        $rankParticipant = Participant::where('tryout_id', $participant->tryout_id)
            ->where('average_score', '>', $participant->average_score ?? 0)
            ->count() + 1;

        //detail nilai rata-rata berdasarkan subtest
        $averageScoreSubtest = UserItemScore::select(
            'questions.sub_test_id',
            'sub_tests.name as subtest_name',
            'category_subtests.name as category_name',
            DB::raw('sum(user_item_scores.score) as total_score'),
            DB::raw('count(distinct questions.id) as total_questions')
        )
        ->join('questions', 'user_item_scores.question_id', '=', 'questions.id')
        ->join('sub_tests', 'questions.sub_test_id', '=', 'sub_tests.id')
        ->join('category_subtests', 'sub_tests.category_subtest_id', '=', 'category_subtests.id')
        ->whereIn('questions.sub_test_id', $subTestIds)
        ->where('user_item_scores.participant_id', $participantId)
        ->groupBy('questions.sub_test_id')
        ->get();
    
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

        $firstMajor = Major::where('id', $participant->user->first_major)->with('university')->first();
        $secondMajor = Major::where('id', $participant->user->second_major)->with('university')->first();

        $product = Product::where('tryout_id', $participant->tryout_id)->first();

        return view('web.sections.exam.result', compact('participant', 'subTests', 'subTestIds', 'firstMajor', 'secondMajor', 'averageAllParticipantScore', 'rankParticipant', 'averageScoreSubtest', 'categorySubtest', 'product'));
    }

    public function getLeaderboard($tryOutId)
    {
        // $query = Participant::select('id', 'user_id', 'average_score')
        //         ->where('tryout_id', $tryOutId)
        //         ->with('user')
        //         ->get();

        $query = Participant::select('id', 'user_id', 'average_score')
            ->selectRaw('
                (
                    SELECT COUNT(*) + 1
                    FROM participants AS p2
                    WHERE p2.average_score > participants.average_score
                    AND p2.tryout_id = ?
                ) AS ranking', [$tryOutId])
            ->where('tryout_id', $tryOutId)
            ->with('user')
            ->orderBy('ranking', 'asc')
            ->get();

        return DataTables::of($query)
            ->addColumn('ranking', function ($participant) {
                if ($participant->ranking == 1) {
                    $rank = '<span data-rank="1"><img src="' . asset('images/icons/rank1.svg') . '" alt="Gold Medal" class="img-fluid" width="30" height="30"></span>';
                } else if ($participant->ranking == 2) {
                    $rank = '<span data-rank="2"><img src="' . asset('images/icons/rank2.svg') . '" alt="Silver Medal" class="img-fluid" width="30" height="30"></span>';
                } else if ($participant->ranking == 3) {
                    $rank = '<span data-rank="3"><img src="' . asset('images/icons/rank3.svg') . '" alt="Bronze Medal" class="img-fluid" width="30" height="30"></span>';
                } else {
                    $rank = '<span data-rank="' . $participant->ranking . '" style="color: #DC7E3F">' . $participant->ranking . '</span>';
                }
                return $rank;
            })
            ->addColumn('user.username', function ($participant) {
                return $participant->user->username;
            })
            ->addColumn('average_score', function ($participant) {
                $averageScore = number_format($participant->average_score, 2);
                return $averageScore;
            })
            ->rawColumns(['ranking'])
            ->make(true);
    }
}
