<?php

namespace App\Traits;

use App\Models\Participant;
use App\Models\Question;
use App\Models\SubTest;
use App\Models\TestAnswer;
use App\Models\TryOut;
use App\Models\UserAnswer;
use App\Models\UserItemScore;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Raw;

trait GradingIrt {

    public function grading($tryOutId) {
        $SubTest = SubTest::where('try_out_id', $tryOutId)->with('questions')->get();

        $subTestIds = $SubTest->pluck('id');        
        $participants = Participant::where('tryout_id', $tryOutId)->where('start_test', '!=', null)->get();
        $totalParticipant = $participants->count();

        // $totalQuestion = Question::whereIn('sub_test_id', $SubTest->pluck('id'))->count();
        $partition = $totalParticipant > 10 ? 10 : $totalParticipant;

        $maxCorrectPerSubTest = [];
        $determine = [];

        $weight = [];

        $skorAfterGrading = [];

        $totalScoreParticipantAllSubtest = [];

        $averageScoreParticipant = [];
        
        foreach ($SubTest as $value) {
            $userAnswer = DB::table('user_answers')
                ->join('test_answers', 'user_answers.test_answer_id', '=', 'test_answers.id')
                ->join('questions', 'user_answers.question_id', '=', 'questions.id')
                ->whereIn('user_answers.question_id', function ($query) use ($value) {
                    $query->select('id')
                        ->from('questions')
                        // ->where('type', 'pilihan_ganda')
                        ->where('sub_test_id', $value->id);
                })
                ->select('user_answers.id', 'user_answers.participant_id', 'user_answers.test_answer_id', 'user_answers.question_id','user_answers.answer_text', 'test_answers.is_correct', 'questions.type', 'test_answers.answer', 'test_answers.statement', 'questions.sub_test_id')
                ->orderBy('user_answers.participant_id')
                ->get();

            if ($userAnswer->count() !== 0) {
                $questions = Question::where('sub_test_id', $value->id)->get();
                $questionIds = $questions->pluck('id');
                $testAnswer = TestAnswer::whereIn('question_id', $questionIds)->get();
    
                $questionPilihanGanda[$value->id] = $userAnswer;
                //tentukan banyak soal yang terjawab benar oleh peserta dari satu subtest
                $maxCorrect = $this->maxCorrectAnswer($userAnswer, $testAnswer);
                $maxCorrectPerSubTest[$value->id] = $maxCorrect;
    
                //tentukan range dan skor
                $determineAndScore = $this->determineRangeAndScore($totalParticipant, $partition, $maxCorrect);
                $determine[$value->id] = $determineAndScore;
    
                //tambahkan bobot soal
                $weightQuestion = $this->addWeightQuestion($questionIds, $userAnswer, $determineAndScore);
                $weight[$value->id] = $weightQuestion;
    
                //nilai akhir tiap user answer
                $grading = $this->gradingAnswer($userAnswer, $weightQuestion, $questions);
                $skorAfterGrading[$value->id] = $grading;
    
                //menentukan rata-rata skor peserta
                foreach ($grading as $participantId => $question) {

                    $totalScore = array_sum($question) + 200;
                    if (isset($totalScoreParticipantAllSubtest[$participantId])) {
                        $totalScoreParticipantAllSubtest[$participantId] += $totalScore;
                    } else {
                        $totalScoreParticipantAllSubtest[$participantId] = $totalScore;
                    }
                }
            }

            //ketika subtest tidak ada yg menjawab sama sekali, set nilai default per subtestnya adalah 200
            else {
                if ($totalScoreParticipantAllSubtest !== []) {
                    foreach ($totalScoreParticipantAllSubtest as $participantId => $score) {
                        $totalScoreParticipantAllSubtest[$participantId] += 200;
                    }
                } else {
                    foreach ($participants as $participant) {
                        $totalScoreParticipantAllSubtest[$participant->id] = 200;
                    }
                }
            }
            

        }

        $participantIds = $participants->pluck('id');
        //tambah skor 200 tiap subtest kepada peserta yg tidak mengerjakan suatu subtest
        foreach ($skorAfterGrading as $subTestId => $participant) {
            foreach ($participantIds as $participantId) {
                if (!array_key_exists($participantId, $participant)) {
                    // $skorAfterGrading[$subTestId][$participantId] = 200;
                    $totalScoreParticipantAllSubtest[$participantId] += 200;
                }
            }
        }

        foreach ($totalScoreParticipantAllSubtest as $participantId => $totalScore) {
            $averageScoreParticipant[$participantId] = $totalScore / count($SubTest);
        }

        try {
            $this->storeGrading($skorAfterGrading, $weight, $tryOutId, $averageScoreParticipant);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
        
    }

    public function maxCorrectAnswer($answers, $testAnswer) {
        $participant = $answers->select('participant_id')->pluck('participant_id')->unique();

        $userAnswer = [];
        $totalCorrect = [];

        foreach ($participant as $key => $item) {
            $participantAnswer = $answers->where('participant_id', $item);
            $totalCorrectAnswer = 0;

            // jawaban benar user per nomor pilihan ganda majemuk
            $totalCorrectAnswerUserPilganMajemuk = [];

            // jawaban benar user per nomor pernyataan
            $totalCorrectAnswerUserPernyataan = [];

            //total jawaban benar pada question pilihan ganda majemuk
            $totalCorrectQuestionPilganMajemuk = [];

            //total jawaban benar pada question pernyataan
            $totalCorrectQuestionPernyataan = [];

            foreach ($participantAnswer as $answer) {
                if ($answer->type == 'pilihan_ganda') {
                    $answer->is_correct == 1 ? $totalCorrectAnswer++ : null;
                } elseif ($answer->type == 'isian_singkat') {
                    intval($answer->answer_text) == intval($answer->answer) ? $totalCorrectAnswer++ : null;
                } elseif ($answer->type == 'pilihan_ganda_majemuk') {
                    // $totalCorrectQuestion = TestAnswer::where('question_id', $answer->question_id)->where('is_correct', 1)->count();
                    $totalCorrectQuestion = $testAnswer->where('question_id', $answer->question_id)->where('is_correct', 1)->count();

                    $totalCorrectQuestionPilganMajemuk[$answer->question_id] = $totalCorrectQuestion;
                    
                    if (isset($totalCorrectAnswerUserPilganMajemuk[$answer->question_id])) {
                        $totalCorrectAnswerUserPilganMajemuk[$answer->question_id] += $answer->is_correct;
                    } else {
                        $totalCorrectAnswerUserPilganMajemuk[$answer->question_id] = $answer->is_correct;
                    }
                }  elseif ($answer->type == 'pernyataan') {
                    $totalCorrectQuestion = TestAnswer::where('question_id', $answer->question_id)->where('is_correct', 1)->count();

                    $totalCorrectQuestionPernyataan[$answer->question_id] = $totalCorrectQuestion;

                    if ($answer->answer_text == $answer->statement) {
                        if (isset($totalCorrectAnswerUserPernyataan[$answer->question_id])) {
                            $totalCorrectAnswerUserPernyataan[$answer->question_id] += $answer->is_correct;
                        } else {
                            $totalCorrectAnswerUserPernyataan[$answer->question_id] = $answer->is_correct;
                        }
                    }
                    
                }
            }

            foreach ($totalCorrectAnswerUserPilganMajemuk as $key => $value) {
                $total = $value/$totalCorrectQuestionPilganMajemuk[$key];
                $totalCorrectAnswer += $total;
            }

            foreach ($totalCorrectAnswerUserPernyataan as $key => $value) {
                $total = $value/$totalCorrectQuestionPernyataan[$key];
                $totalCorrectAnswer += $total;
            }

            $totalCorrect[$item] = $totalCorrectAnswer;
            $userAnswer[$item] = $participantAnswer;

        }
        // dd($totalCorrect,max($totalCorrect));
        return max($totalCorrect);
    }

    public function determineRangeAndScore($totalParticipant, $partition, $totalCorrectAnswer) {
        //bulatkan jangkauan partisi
        $jangkauanPartisi = round($totalParticipant / $partition);
        //menghindari pembagian dengan 0
        if ($totalCorrectAnswer == 0) {
            $totalCorrectAnswer = 1;
        }
        $skorMaksimalSatuNomor = 800 / $totalCorrectAnswer;

        $batasBawahPartisi = [];
        $batasAtasPartisi = [];
        $skorPadaPartisi = [];


        for ($i=0; $i < $partition; $i++) { 
            if ($i == 0) {
                //menambahkan nilai ke array batas atas partisi
                $batasAtasPartisi[$i] = $jangkauanPartisi;
                //menambahkan nilai ke array batas bawah partisi
                $batasBawahPartisi[$i] = 1;
                $skorPadaPartisi[$i] = $skorMaksimalSatuNomor;
            } else {
                //menambahkan nilai ke array batas atas partisi
                $batasAtasPartisi[$i] = ($i+1) * $jangkauanPartisi;
                //menambahkan nilai ke array batas bawah partisi
                $batasBawahPartisi[$i] = $batasAtasPartisi[$i-1] + 1;
                $skorPadaPartisi[$i] = $skorMaksimalSatuNomor - (($i+1)*$skorMaksimalSatuNomor) / (2 * $partition);
            }
        }

        return [
            'batasBawahPartisi' => $batasBawahPartisi,
            'batasAtasPartisi' => $batasAtasPartisi,
            'skorPadaPartisi' => $skorPadaPartisi,
        ];

    }

    public function addWeightQuestion($questions, $answer, $determineRangeAndScore) {

        $weightQuestion = [];
        // dd($questions, $answer->where('question_id', $questions[4]));
        foreach ($questions as $question) {
            //mendapatkan jawaban per nomor
            $answerPerQuestion = $answer->where('question_id', $question);
            $answerPerNumber[$question] = $answerPerQuestion;

            $skor = 0;
            // menentukan type soal
            if ($answerPerQuestion->first()?->type === 'pilihan_ganda') {

                $skor = $this->addWeightMultipleChoiceQuestion($answerPerQuestion, $determineRangeAndScore);
            } else if ($answerPerQuestion->first()?->type === 'pilihan_ganda_majemuk') {
                $skor = $this->addWeightCompundMultipleChoiceQuestion($answerPerQuestion, $determineRangeAndScore);
            } else if ($answerPerQuestion->first()?->type === 'isian_singkat') {
                $skor = $this->addWeightEssayQuestion($answerPerQuestion, $determineRangeAndScore);

            } else if ($answerPerQuestion->first()?->type === 'pernyataan') {
                $skor = $this->addWeightStatementQuestion($answerPerQuestion, $determineRangeAndScore);
            } 

            $weightQuestion[$question] = $skor;
        }

        return $weightQuestion;
        // dd($weightQuestion);
    }

    public function addWeightMultipleChoiceQuestion($answerPerQuestion, $determineRangeAndScore) {
        $totalCorrectAnswer = $answerPerQuestion->where('is_correct', 1)->count();
        // dd($totalCorrectAnswer);
    
        $skor = 0;
                
        for ($i=0; $i < count($determineRangeAndScore['batasBawahPartisi']); $i++) { 
            if ($totalCorrectAnswer >= $determineRangeAndScore['batasBawahPartisi'][$i] && $totalCorrectAnswer <= $determineRangeAndScore['batasAtasPartisi'][$i]) {
                $skor = $determineRangeAndScore['skorPadaPartisi'][$i];
            }
        }

        return $skor;
    }

    public function addWeightCompundMultipleChoiceQuestion($answerPerQuestion, $determineRangeAndScore) {
        //mendapatkan total jawaban yg dijawab benar oleh masing-masing siswa
        $totalCorrectAnswerUser = [];

        $skor = 0;

       //mendapatkan total siswa yang menjawab benar
        foreach ($answerPerQuestion as $value) {

            if (isset($totalCorrectAnswerUser[$value->participant_id])) {
                $totalCorrectAnswerUser[$value->participant_id] += $value->is_correct;
            } else {
                $totalCorrectAnswerUser[$value->participant_id] = $value->is_correct;
            }
        }

        //tentukan max berapa jawaban yg dijawab benar oleh masing-masing siswa
        $maxCorrectAnswer = max($totalCorrectAnswerUser);

        //tentukan ada berapa user yang menjawab max jawaban benar 
        $totalCorrectAnswer = count(array_keys($totalCorrectAnswerUser, $maxCorrectAnswer));

        //menentukan total jawaban benar per nomor berada pada partisi mana
        for ($i=0; $i < count($determineRangeAndScore['batasBawahPartisi']); $i++) { 
            if ($totalCorrectAnswer >= $determineRangeAndScore['batasBawahPartisi'][$i] && $totalCorrectAnswer <= $determineRangeAndScore['batasAtasPartisi'][$i]) {
                //menentukan bobot soal berdasarkan partisi
                $skor = $determineRangeAndScore['skorPadaPartisi'][$i];
            }
        }
        
        return $skor;
    }

    public function addWeightStatementQuestion($answerPerQuestion, $determineRangeAndScore) {
        //mendapatkan total jawaban yg dijawab benar oleh masing-masing siswa
        $totalCorrectAnswerUser = [];

        $skor = 0;

         //mendapatkan total siswa yang menjawab benar
        foreach ($answerPerQuestion as $answer) {
            if ($answer->answer_text == $answer->statement) {
                if (isset($totalCorrectAnswerUser[$answer->participant_id])) {
                    $totalCorrectAnswerUser[$answer->participant_id] += $answer->is_correct;
                } else {
                    $totalCorrectAnswerUser[$answer->participant_id] = $answer->is_correct;
                }
            }
        }

         //tentukan max berapa jawaban yg dijawab benar oleh masing-masing siswa
        $maxCorrectAnswer = max($totalCorrectAnswerUser);

         //tentukan ada berapa user yang menjawab max jawaban benar 
        $totalCorrectAnswer = count(array_keys($totalCorrectAnswerUser, $maxCorrectAnswer));

         //menentukan total jawaban benar per nomor berada pada partisi mana
        for ($i=0; $i < count($determineRangeAndScore['batasBawahPartisi']); $i++) { 
            if ($totalCorrectAnswer >= $determineRangeAndScore['batasBawahPartisi'][$i] && $totalCorrectAnswer <= $determineRangeAndScore['batasAtasPartisi'][$i]) {
                 //menentukan bobot soal berdasarkan partisi
                $skor = $determineRangeAndScore['skorPadaPartisi'][$i];
            }
        }

         return $skor;
    }

    public function addWeightEssayQuestion($answerPerQuestion, $determineRangeAndScore) {
        $totalCorrectAnswer = 0;

        $skor = 0;
        //mendapatkan total siswa yang menjawab benar
        foreach ($answerPerQuestion as $key => $value) {
            intval($value->answer_text) == intval($value->answer) ? $totalCorrectAnswer++ : null;
        }

        //menentukan total jawaban benar per nomor berada pada partisi mana
        for ($i=0; $i < count($determineRangeAndScore['batasBawahPartisi']); $i++) { 
            if ($totalCorrectAnswer >= $determineRangeAndScore['batasBawahPartisi'][$i] && $totalCorrectAnswer <= $determineRangeAndScore['batasAtasPartisi'][$i]) {
                //menentukan bobot soal berdasarkan partisi
                $skor = $determineRangeAndScore['skorPadaPartisi'][$i];
            }
        }

        return $skor;
    }

    public function gradingAnswer($answer, $weightQuestion, $questions) {

        $participants = $answer->pluck('participant_id')->unique();

        $questionIds = $questions->pluck('id');

        $testAnswer = TestAnswer::whereIn('question_id', $questionIds)->get();

        $dataItemSkorParticipant = [];

        $dataSkorParticipantAfterGrading = [];

        foreach ($participants as $participant) {
            // jawaban benar user per nomor pilihan ganda majemuk
            $totalCorrectAnswerUserPilganMajemuk = [];

            // jawaban benar user per nomor pernyataan
            $totalCorrectAnswerUserPernyataan = [];

            //total jawaban benar pada question pilihan ganda majemuk
            $totalCorrectQuestionPilganMajemuk = [];

            //total jawaban benar pada question pernyataan
            $totalCorrectQuestionPernyataan = [];
            
            foreach ($questionIds as $question) {
                $userAnswer = $answer->where('question_id', $question)->where('participant_id', $participant);

                if ($userAnswer) {
                    $typeQuestion = $userAnswer->first()->type ?? null;
                    $userAnswerText =$userAnswer->first()->answer_text ?? null;
                    $questionAnswer = $userAnswer->first()->answer ?? null;
                    
                    if ($typeQuestion === 'pilihan_ganda') {
    
                        $dataItemSkorParticipant[$participant][$question] = $userAnswer->first()->is_correct ?? null;
                    } elseif ($typeQuestion === 'isian_singkat') {
    
                        $dataItemSkorParticipant[$participant][$question] = intval($userAnswerText) == intval($questionAnswer) ? $userAnswer->first()->is_correct : 0;
                    } elseif ($typeQuestion === 'pilihan_ganda_majemuk') {
    
                        $totalCorrect = $testAnswer->where('question_id', $question)->where('is_correct', 1)->count();
    
                        $totalCorrectQuestionPilganMajemuk[$question] = $totalCorrect;
                        
                        foreach ($userAnswer as $item) {
                            if (isset($totalCorrectAnswerUserPilganMajemuk[$question])) {
                                $totalCorrectAnswerUserPilganMajemuk[$question] += $item->is_correct;
                            } else {
                                $totalCorrectAnswerUserPilganMajemuk[$question] = $item->is_correct;
                            }
                        }
    
                    } elseif ($typeQuestion === 'pernyataan') {
                        //mencari total jawaban benar yang seharusnya pada setiap nomor pernyataan
                        $totalCorrect = TestAnswer::where('question_id', $question)->where('is_correct', 1)->count();

                        //memasukan total jawaban benar seharusnya ke dalam array
                        $totalCorrectQuestionPernyataan[$question] = $totalCorrect;
    
                        //mencari total jawaban benar user pada setiap nomor pernyataan
                        foreach ($userAnswer as $item) {
                            //ketika jawaban user sama dengan pernyataan
                            if ($item->answer_text == $item->statement) {
                                if (isset($totalCorrectAnswerUserPernyataan[$question])) {
                                    $totalCorrectAnswerUserPernyataan[$question] += $item->is_correct;
                                } else {
                                    $totalCorrectAnswerUserPernyataan[$question] = $item->is_correct;
                                }
                            } 
                            //ketika jawaban user tidak sama dengan pernyataan
                            else {
                                if (isset($totalCorrectAnswerUserPernyataan[$question])) {
                                    $totalCorrectAnswerUserPernyataan[$question] += 0;
                                } else {
                                    $totalCorrectAnswerUserPernyataan[$question] = 0;
                                }
                            }
                        }
                        
                    }        
                }
                        
            }
            
            foreach ($totalCorrectAnswerUserPilganMajemuk as $key => $value) {
                $total = $value/$totalCorrectQuestionPilganMajemuk[$key];
                $dataItemSkorParticipant[$participant][$key] = $total;
            }

            foreach ($totalCorrectAnswerUserPernyataan as $key => $value) {
                $total = $value/$totalCorrectQuestionPernyataan[$key];
                $dataItemSkorParticipant[$participant][$key] = $total;
            }
        }

        foreach ($dataItemSkorParticipant as $participantId => $itemAnswer) {
            // $skor = 0;
            foreach ($itemAnswer as $questionId => $answer) {
                $skor = $answer * $weightQuestion[$questionId];
                $dataSkorParticipantAfterGrading[$participantId][$questionId] = $skor;
            }
        }

        return $dataSkorParticipantAfterGrading;

    }

    public function storeGrading($skorAfterGrading, $weight, $tryOutId, $averageScoreParticipant) {
        DB::transaction(function () use ($skorAfterGrading, $weight, $tryOutId, $averageScoreParticipant) {
            foreach ($weight as $subTestId => $questions) {
                foreach ($questions as $questionId => $weight) {
                    $question = Question::find($questionId);
                    $question->update([
                        'difficulty_parameter' => $weight
                    ]);
                }
            }
            
            foreach ($skorAfterGrading as $subTestId => $participant) {
                foreach ($participant as $participantId => $question) {
                    foreach ($question as $questionId => $skor) {
                        UserItemScore::create([
                            'participant_id' => $participantId,
                            'question_id' => $questionId,
                            'sub_test_id' => $subTestId,
                            'score' => $skor
                        ]);
                    }
                }
            }

            foreach ($averageScoreParticipant as $participantId => $averageScore) {
                $participant = Participant::find($participantId);
                $participant->update([
                    'average_score' => $averageScore
                ]);
            }



            $tryOut = TryOut::find($tryOutId);
            $tryOut->update([
                'is_grading_completed' => true,
            ]);


        });
    }
}