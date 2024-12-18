<?php

namespace App\Exports;

use App\Models\Participant;
use App\Models\Question;
use App\Models\SubTest;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class SkorSubTestSheetExport implements FromView, WithTitle
{
    protected $subTestId;
    protected $correctAnswer;
    protected $skor;
    protected $subTestName;

    public function __construct($subTestId, $correctAnswer, $skor)
    {
        $this->subTestId = $subTestId;
        $this->correctAnswer = $correctAnswer;
        $this->skor = $skor;
        $this->subTestName = SubTest::where('id', $this->subTestId)->first()->name;
    }

    /**
     * Return a view for the sheet.
     */
    public function view(): View
    {
        // Transform data if needed
        $formattedParticipants = [];
        foreach ($this->correctAnswer as $participantId => $answer) {
            $participant = Participant::where('id', $participantId)->with('user')->first();
            $formattedParticipants[] = [
                'participantId' => $participantId,
                'name' => $participant->user->username,
                'fullname' => $participant->user->fullname,
                'school' => $participant->user->institution,
                'correctAnswer' => $answer
            ];
        }
        $questionId = Question::where('sub_test_id', $this->subTestId)->pluck('id')->toArray();

        $score = $this->skor;

        return view('exports.skor-subtest', [
            'subTestName' => $this->subTestName,
            'participants' => $formattedParticipants,
            'questionId' => $questionId,
            'score' => $score
        ]);
    }

    /**
     * Set the title for the sheet.
     */
    public function title(): string
    {
        // Sesuaikan nama sheet sesuai kebutuhan, misalnya berdasarkan ID SubTest
        return "SubTest - " . $this->subTestName;
    }
}