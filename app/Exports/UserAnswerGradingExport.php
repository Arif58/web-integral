<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class UserAnswerGradingExport implements WithMultipleSheets
{
    protected $userAnswer;

    public function __construct($userAnswer)
    {
        $this->userAnswer = $userAnswer;
    }

    /**
     * Generate multiple sheets for each subtest.
     */
    public function sheets(): array
    {
        $sheets = [];

        $correctAnswerParticipant = $this->userAnswer['correctAnswerParticipant'];
        $skorAfterGrading = $this->userAnswer['skorAfterGrading'];

        foreach ($correctAnswerParticipant as $subTestId => $correctAnswer) {
            $skor = $skorAfterGrading[$subTestId];
            $sheets[] = new SkorSubTestSheetExport($subTestId, $correctAnswer, $skor);
        }

        $sheets[] = new AverageSkorSubTestSheetExport($skorAfterGrading);


        return $sheets;
    }
}
