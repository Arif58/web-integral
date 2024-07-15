<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;

class BadgesController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $userParticipant = Participant::join('try_outs', 'participants.tryout_id', '=', 'try_outs.id')
            ->where('participants.user_id', $user->id)
            ->where('try_outs.is_grading_completed', true)
            ->select('participants.*', 'try_outs.name')
            ->get();

        $userTryOutIds = $userParticipant->pluck('tryout_id')->toArray();

        $countCompletedTryOuts = $userParticipant->where('average_score', '!=', null)->count();

        $isCompletedThreeTryOuts = $countCompletedTryOuts >= 3 ? true : false;
        $isCompletedFiveTryOuts = $countCompletedTryOuts >= 5 ? true : false;

        $countTryOutsWithScoreAboveSixHundredsFifty = $userParticipant->where('average_score', '>=', 650)->count();

        $isScoreOneTryOutAboveSixHundredsFifty = $countTryOutsWithScoreAboveSixHundredsFifty >= 1 ? true : false;

        $isScoreThreeTryOutsAboveSixHundredsFifty = $countTryOutsWithScoreAboveSixHundredsFifty >= 3 ? true : false;

        //hitung berapa kali user mendapatkan peringkat 10 besar
        $userHasTenRanking = 0;

        foreach ($userTryOutIds as $tryOutId) {
            $tenParticipantWithBigScore = Participant::where('tryout_id', $tryOutId)->orderBy('average_score', 'desc')->get()->take(10);
            
            $participantRankingIds = $tenParticipantWithBigScore->pluck('user_id')->toArray();

            if (in_array($user->id, $participantRankingIds)) {
                $userHasTenRanking++;
            }
        }

        $isTenRankingOneTryOut = $userHasTenRanking >= 1 ? true : false;
        $isTenRankingThreeTryOuts = $userHasTenRanking >= 3 ? true : false;

        // dd($isTenRankingOneTryOut, $isTenRankingThreeTryOuts, $userHasTenRanking);

        return view('web.sections.dashboard.student.achievement', compact('isCompletedThreeTryOuts', 'isCompletedFiveTryOuts', 'isScoreOneTryOutAboveSixHundredsFifty', 'isScoreThreeTryOutsAboveSixHundredsFifty', 'isTenRankingOneTryOut', 'isTenRankingThreeTryOuts', 'userHasTenRanking', 'countCompletedTryOuts', 'countTryOutsWithScoreAboveSixHundredsFifty'));

    }
}
