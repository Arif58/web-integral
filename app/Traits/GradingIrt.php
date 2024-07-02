<?php

namespace App\Traits;

use App\Models\Participant;
use App\Models\Question;
use App\Models\SubTest;
use App\Models\TestAnswer;
use App\Models\UserAnswer;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Raw;

trait GradingIrt {

    public function grading($tryOutId) {
        $SubTest = SubTest::where('try_out_id', $tryOutId)->with('questions')->get();
        $totalParticipant = Participant::where('tryout_id', $tryOutId)->count();
        $partition = 2;

        $maxCorrectPerSubTest = [];
        $determine = [];
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
                ->select('user_answers.id', 'user_answers.participant_id', 'user_answers.question_id','user_answers.answer_text', 'test_answers.is_correct', 'questions.type', 'test_answers.answer', 'test_answers.statement' )
                ->orderBy('user_answers.participant_id')
                ->get();
            
            $questionPilihanGanda[$value->id] = $userAnswer;
            //tentukan banyak soal yang terjawab benar oleh peserta dari satu subtest
            $maxCorrect = $this->maxCorrectAnswer($userAnswer);
            $maxCorrectPerSubTest[$value->id] = $maxCorrect;

            //tentukan range dan skor
            $determineAndScore = $this->determineRangeAndScore($totalParticipant, $partition, $maxCorrect);
            $determine[$value->id] = $determineAndScore;

            $gradingMultipleChoice = $this->gradingMultipleChoice($determineAndScore, $userAnswer);

        }
        return [
            // 'SubTest' => $SubTest,
            'totalParticipant' => $totalParticipant,
            'partition' => $partition,
            'maxCorrectPerSubTest' => $maxCorrectPerSubTest,
            'determine and Score' => $determine,
        ];
    }

    public function maxCorrectAnswer($answers) {
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
                    $totalCorrectQuestion = TestAnswer::where('question_id', $answer->question_id)->where('is_correct', 1)->count();

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
        $jangkauanPartisi = $totalParticipant / $partition;
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

    public function gradingMultipleChoice($determineRangeAndScore, $answers) {
        $answer = $answers->where('type', 'pilihan_ganda');
        $questionIds = $answer->pluck('question_id')->unique();

        $total = [];
        
        foreach ($questionIds as $question) {
            $answerPerQuestion = $answer->where('question_id', $question);
            $totalAnswerPerQuestion = $answerPerQuestion->where('is_correct', 1)->count();

            foreach($answerPerQuestion as $key => $value) {
                $participant = $value->participant_id;
                $answer = $value->answer;
                $isCorrect = $value->is_correct;

                $skor = 0;
                for ($i=0; $i < count($determineRangeAndScore['batasBawahPartisi']); $i++) { 
                    if ($totalAnswerPerQuestion >= $determineRangeAndScore['batasBawahPartisi'][$i] && $totalAnswerPerQuestion <= $determineRangeAndScore['batasAtasPartisi'][$i]) {
                        $skor = $determineRangeAndScore['skorPadaPartisi'][$i];
                    }
                }

                if ($isCorrect == 1) {
                    $skor = $skor;
                } else {
                    $skor = 0;
                }

                $total[$participant] = [$question, $skor];
            }
            dd($total);
        }


    }

    public function compoundMultipleChoiceGrading() {

    }
}