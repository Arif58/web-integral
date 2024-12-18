<?php

namespace App\Exports;

use App\Models\Participant;
use App\Models\SubTest;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class AverageSkorSubTestSheetExport implements FromView, WithTitle
{
    protected $skor;

    public function __construct($skor)
    {
        $this->skor = $skor;
    }

    /**
     * Return a view for the sheet.
     */
    public function view(): View
    {
        //mendapatkan nama subtest berdasarkan key pada $skor
        $subTestName = SubTest::whereIn('id', array_keys($this->skor))->pluck('name', 'id');
        $subTestCount = count($subTestName);

       // Menyiapkan data skor dengan total
        $averageScores = [];
        foreach ($this->skor as $subTestId => $participantScores) {
            foreach ($participantScores as $participantId => $scores) {
                $participant = Participant::where('id', $participantId)->with('user')->first();
                if (!isset($averageScores[$participantId])) {
                    $averageScores[$participantId] = [
                        'participantId' => $participantId,
                        'fullname' => $participant->user->fullname,
                        'school' => $participant->user->institution,
                        'total' => 0,
                        'subTestScores' => array_fill_keys(array_keys($this->skor), 200), // Skor default 200
                    ];
                }

                // Update skor untuk subtest yang dikerjakan
                $averageScores[$participantId]['subTestScores'][$subTestId] += array_sum($scores);
            }
        }

        // Hitung total skor rata-rata untuk setiap peserta
        foreach ($averageScores as $participantId => &$data) {
            $data['total'] = array_sum($data['subTestScores']) / $subTestCount;
        }

        return view('exports.average-subtest', [
            'averageScores' => $averageScores,
            'subTestName' => $subTestName,
        ]);
    }

    /**
     * Set the title for the sheet.
     */
    public function title(): string
    {
        return "Rekap Rata-rata Skor";
    }
}
