<?php

namespace App\Http\Controllers;

use App\Models\CategorySubtest;
use App\Models\CompletedSubtest;
use App\Models\IeGemsHistory;
use App\Models\Major;
use App\Models\Participant;
use App\Models\Product;
use App\Models\Question;
use App\Models\SubTest;
use App\Models\User;
use App\Models\UserAnswer;
use App\Models\UserItemScore;
use App\Traits\SimpleAdditiveWeighting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class ExamController extends Controller
{
    use SimpleAdditiveWeighting;
    public function index($id)
    {
        $participant = Participant::where('id', $id)->with('tryOut')->first();

        if($participant == null) {
            return redirect()->route('my-tryout')->with([
                'status' => 'error', 
                'message' => 'Anda tidak memiliki akses ke halaman ini.'
            ]);
        }

        if($participant?->user_id != Auth::id()) {
            return redirect()->route('my-tryout')->with([
                'status' => 'error', 
                'message' => 'Anda tidak memiliki akses ke halaman ini.'
            ]);
        }

        //check apakah masuk waktu try out atau belum
        $isTryOutPeriod = Carbon::now('Asia/Jakarta')->between($participant->tryOut?->start_date, $participant->tryOut?->end_date);

        if (!$isTryOutPeriod) {
            return redirect()->route('my-tryout')->with([
                'status' => 'error', 
                'message' => 'Tidak dalam periode Try Out.'
            ]);
        }

        $countTest = CompletedSubtest::where('participant_id', $id)->count();

        //get subtest completed by participant
        $completedSubtestId = CompletedSubtest::where('participant_id', $id)->where('status', '=', 'completed')->pluck('sub_test_id');

        //get subtest not completed by participant
        $subTest = $participant->tryOut->subTests()->whereNotIn('id', $completedSubtestId)->with('questions', 'categorySubtest')->orderBy('id', 'asc')->get();

        //sisa subtest yang belum dikerjakan
        $countSubTestLeft = $subTest->count();

        //subtest yang akan dikerjakan
        $currentSubTest = $subTest->first();

        //pass the data as JSON
        $subTestIds = $subTest->pluck('id');
        // dd($subTest);

        if ($countTest == 0) {
            // $startTest = Carbon::now('Asia/Jakarta')->setTimezone('UTC')->format('Y-m-d H:i:s');
            $startTest = Carbon::now()->format('Y-m-d H:i:s');
            $participant->update([
                'start_test' => $startTest,
            ]);
        }

        return view('web.sections.exam.confirm-test', compact('participant', 'subTest', 'subTestIds', 'countSubTestLeft', 'currentSubTest'));
    }

    public function getQuestion($participantId, $subTestId)
    {
        //check apakah participant adalah user yang sedang login
        $participant = Participant::where('id', $participantId)->with('tryOut')->first();

        if($participant == null) {
            return redirect()->route('my-tryout')->with([
                'status' => 'error', 
                'message' => 'Anda tidak memiliki akses ke halaman ini.'
            ]);
        }

        if ($participant?->user_id != Auth::id()) {
            return redirect()->route('my-tryout')->with([
                'status' => 'error', 
                'message' => 'Anda tidak memiliki akses ke halaman ini.'
            ]);
        }

        $isSubTestExist = SubTest::where('id', $subTestId)->where('try_out_id', $participant->tryOut->id)->exists();
        if (!$isSubTestExist) {
            return redirect()->route('my-tryout')->with([
                'status' => 'error', 
                'message' => 'Subtest tidak ditemukan pada Try Out ini.'
            ]);
        }

        //check apakah subtest sudah dikerjakan atau belum
        $isSubTestCompleted = CompletedSubtest::where('participant_id', $participantId)
                                ->where('sub_test_id', $subTestId)
                                ->where('status', 'completed')
                                ->exists();

        if ($isSubTestCompleted) {
            //jika sudah dikerjakan, maka lanjutkan ke subtest selanjutnya
            return redirect()->route('exam', ['id' => $participantId]);
        }

        $subTest = SubTest::where('id', $subTestId)->with('questions', 'categorySubtest')->first();

        $questions = Question::where('sub_test_id', $subTestId)->with('questionChoices')->get();

        //check apakah participant sudah mengerjakan subtest atau belum
        $completedSubtest = CompletedSubtest::where('participant_id', $participantId)
                            ->where('sub_test_id', $subTestId)
                            ->first();
        if ($completedSubtest?->status == 'completed') {
            return redirect()->route('my-tryout')->with('error', 'Anda sudah mengerjakan subtest ini.');
        } else if ($completedSubtest?->status == 'in-progress') {
            $startTest = $completedSubtest->started_at;
        } else {
            //jam mulai ujian sesuai waktu GMT+7
            $startTest = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');

            //create new data pada table completed_subtests
            CompletedSubtest::create([
                'participant_id' => $participantId,
                'sub_test_id' => $subTestId,
                'started_at' => $startTest,
            ]);
        }

        $participant = Participant::where('id', $participantId)->with('tryOut')->first();
        //get subtest completed by participant
        $completedSubtestId = CompletedSubtest::where('participant_id', $participantId)->where('status', '=', 'completed')->pluck('sub_test_id');

        //get subtest not completed by participant
        $subTestNotCompleted = $participant->tryOut->subTests()->whereNotIn('id', $completedSubtestId)->with('questions', 'categorySubtest')->get();
 
        //sisa subtest yang belum dikerjakan
        $lengthSubTest = $subTestNotCompleted->count();
        // dd($lengthSubTest);


        return view('web.sections.exam.test', compact('questions', 'subTest', 'participantId', 'startTest', 'lengthSubTest'));
    }

    public function submitAnswer(Request $request)
    {
        try {
            DB::transaction(function() use ($request) {
                $participantId = $request->participant_id;
                $answers = $request->answers;
                // $startTest = $request->startTest ?? null;
                $endTest = $request->endTest ?? null;
                $ieGems = $request->ieGems ?? null;
                $subTestId = $request->subTestId;

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
    
                // if ($startTest) {
                //     Participant::where('id', $participantId)->update(
                //         ['start_test' => $startTest]
                //     );
                // }
    
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

                $completedSubtest = CompletedSubtest::where('participant_id', $participantId)
                                    ->where('sub_test_id', $subTestId)
                                    ->first();
                $completedSubtest->update([
                    'status' => 'completed',
                    'completed_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                ]);
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

        if ($participant->user_id != Auth::id()) {
            return redirect()->route('my-tryout')->with([
                'status' => 'error', 
                'message' => 'Anda tidak memiliki akses ke halaman ini.'
            ]);
        }

        //apakah tryout sudah selesai atau belum dan apakah nilai sudah dihitung atau belum
        $isTryOutPeriod = Carbon::now('Asia/Jakarta')->between($participant->tryOut->start_date, $participant->tryOut->end_date);

        $isScoreCalculated = $participant->tryOut->is_grading_completed;

        if($isTryOutPeriod || !$isScoreCalculated) {
            return redirect()->route('my-tryout')->with([
                'status' => 'error', 
                'message' => 'Try Out belum selesai atau nilai belum dihitung.'
            ]);
        }

        $subTests = SubTest::select('sub_tests.id', 'sub_tests.name', 'category_subtest_id', 'category_subtests.name as category_name')
                        ->join('category_subtests', 'sub_tests.category_subtest_id', '=', 'category_subtests.id')
                        ->where('try_out_id', $participant->tryout_id)->get();

        $categorySubtest = $subTests->pluck('category_name','category_subtest_id')->unique()->sortKeys();

        $subTestIds = $subTests->pluck('id');

        $averageAllParticipantScore = Participant::where('tryout_id', $participant->tryout_id)
                                        ->where('average_score', '!=', null)
                                        ->avg('average_score');
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
                                ->groupBy('questions.sub_test_id', 'subtest_name', 'category_name')
                                ->get();

        $totalQuestion = Question::whereIn('sub_test_id', $subTestIds)->count();

        $firstMajor = Major::where('id', $participant->user->first_major)->with('university')->first();
        $secondMajor = Major::where('id', $participant->user->second_major)->with('university')->first();

        $product = Product::where('tryout_id', $participant->tryout_id)->first();

        return view('web.sections.exam.result', compact('participant', 'subTests', 'subTestIds', 'firstMajor', 'secondMajor', 'averageAllParticipantScore', 'rankParticipant', 'averageScoreSubtest', 'categorySubtest', 'product'));
    }

    public function getLeaderboard($tryOutId)
    {

        $query = Participant::select('id', 'user_id', 'average_score')
                    ->selectRaw('
                        (
                            SELECT COUNT(*) + 1
                            FROM participants AS p2
                            WHERE p2.average_score > participants.average_score
                            AND p2.tryout_id = ?
                        ) AS ranking', [$tryOutId])
                    ->where('tryout_id', $tryOutId)
                    ->where('average_score', '!=', null)
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
                $averageScore = number_format($participant->average_score, 2, ',', '');
                return $averageScore;
            })
            ->rawColumns(['ranking'])
            ->make(true);
    }

    public function getMajorRecommendation($participantId)
    {
        if (Participant::where('id', $participantId)->first()->average_score == null) {
            return redirect()->route('/tryout-saya')->with('error', 'Nilai peserta belum diproses.');
        }
        $majorRecommendation = $this->simpleAdditiveWeighting($participantId);

        return view('web.sections.exam.major-recommendation', compact('majorRecommendation'));
    }

    public function getAnswerExplanation($participantId, $subTestId)
    {
        $subTest = SubTest::where('id', $subTestId)->with('questions', 'categorySubtest')->first();

        $questions = Question::where('sub_test_id', $subTestId)->with('questionChoices')->get();

        $userAnswers = UserAnswer::where('participant_id', $participantId)->whereIn('question_id', $questions->pluck('id'))->get();

        // Transformasi data userAnswers sesuai format yang diinginkan
        $userAnswers = $userAnswers->groupBy('question_id')->map(function ($item) {
            $transformed = [];
            foreach ($item as $answer) {
                if ($answer->answer_text) {
                    $transformed[] = [$answer->test_answer_id, $answer->answer_text];
                } else {
                    $transformed[] = (string) $answer->test_answer_id;
                }
            }
            return $transformed;
        });
        // dd($userAnswers);
        

        return view('web.sections.exam.answer-explanation', compact('questions', 'subTest', 'userAnswers'));
    }
}
