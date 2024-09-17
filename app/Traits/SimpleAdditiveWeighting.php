<?php

namespace App\Traits;

use App\Models\Major;
use App\Models\Participant;
use App\Models\Question;
use App\Models\SubTest;
use App\Models\TestAnswer;
use App\Models\TryOut;
use App\Models\UserAnswer;
use App\Models\UserItemScore;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Raw;

trait SimpleAdditiveWeighting {
    
    public function simpleAdditiveWeighting($participant_id)
    {
        $participant = Participant::find($participant_id);
        $participantScore = $participant->average_score;

        $majorList = Major::where('passing_grade', '<=', $participantScore)->where('cluster_id', '!=', null)->get();

        
        $interest = $participant->user()->first()->interest;

        $firstMajor = $participant->user()->first()->first_major;
        $secondMajor = $participant->user()->first()->second_major;

        $interestWeight = $this->weightCriteria(1, 3);
        $universityWeight = $this->weightCriteria(2, 3);
        $passingGradeWeight = $this->weightCriteria(3, 3);


        if ($interest !== null) {

            if ($firstMajor === null || $secondMajor === null) {
                return 'Silahkan isikan pilihan jurusan 1 atau jurusan 2 terlebih dahulu pada menu profil saya';
            }
            else {
                $firstUniversity = Major::where('id', $firstMajor)->first()->university_id;
                $secondUniversity = Major::where('id', $secondMajor)->first()->university_id;
    
                $matriksTernomalisasi = [];
        
                foreach ($majorList as $major) {
                    $interestScore = $this->interestCriteria($major, $interest) / 3;
                    $universityScore = $this->universityCriteria($major, $firstUniversity, $secondUniversity) / 3;
                    $passingGradeScore = $this->passingGradeCriteria($major, $participantScore) / 5;
                    $matriksTernomalisasi[$major->id] = ['interest'=>$interestScore, 'university'=>$universityScore, 'passing_grade'=>$passingGradeScore];
                }
        
                $majorScore = [];
                foreach ($matriksTernomalisasi as $majorId => $value) {
                    $majorScore[$majorId] = ($value['interest']*$interestWeight) + ($value['university']*$universityWeight) + ($value['passing_grade']*$passingGradeWeight);
                }
        
                $majorScore = collect($majorScore)->sortDesc();
                $majorScoreSixId = $majorScore->keys()->take(6);
        
                $majorResult = Major::whereIn('id', $majorScoreSixId)->with('university')->get();
        
                return $majorResult;
                
            }
        }
        else {
            return 'Silahkan isikan minat dan bakat dahulu pada menu profil saya';
        }


    }

    public function weightCriteria($rankingPriority, $max)
    {
        $alternatif = 0;
        for ($i=$rankingPriority; $i<$max+1; $i++) {
            $criteria = 1/$i;
            $alternatif += $criteria;
        }


        $weight = $alternatif / $max;
        return $weight;
    }

    public function interestCriteria($major, $interest)
    {
        if ($major->cluster_id == $interest) {
            return 2;
        } else {
            return 1;
        }
    }

    public function universityCriteria($major, $firstUniversity, $secondUniversity)
    {
        if ($major->university_id == $firstUniversity) {
            return 3;
        } else if ($major->university_id == $secondUniversity) {
            return 2;
        } else {
            return 1;
        }
    }

    public function passingGradeCriteria($major, $participantScore)
    {
        $scoreDifference = $participantScore - $major->passing_grade;
        if ($scoreDifference >= 0 && $scoreDifference <= 49.99) {
            return 5;
        } else if ($scoreDifference >= 50 && $scoreDifference <= 99.99) {
            return 4;
        } else if ($scoreDifference >= 100 && $scoreDifference <= 149.99) {
            return 3;
        } else if ($scoreDifference >= 150 && $scoreDifference <= 199.99) {
            return 2;
        } else {
            return 1;
        }
    }
  
}