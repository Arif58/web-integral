<?php

namespace App\Http\Controllers;

use App\Exports\UserAnswerGradingExport;
use App\Models\Participant;
use App\Models\Product;
use App\Models\TryOut;
use App\Traits\GradingIrt;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class ParticipantController extends Controller
{
    use GradingIrt;
    public function index($productId) {

        $product = Product::where('id', $productId)->with('participants')->first();
        // dd($this->grading($product->tryout_id));

        return view('web.sections.dashboard.admin.participants', compact('product'));
    }

    public function getParticipant($productId) {
        $products = Product::where('id',$productId)->first();
        
        $query = Participant::where('tryout_id', $products->tryout_id)->with('user', 'userScores')->get();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('name', function ($participant) {
                return $participant->user->username;
            })
            ->addColumn('email', function ($participant) {
                return $participant->user->email;
            })
            ->addColumn('average_score', function ($participant) {
                $avg = $participant->average_score;
                if ($avg == null) {
                    return 'Belum ada nilai';
                }
                $avg = number_format($avg, 2);
                return $avg;
            })
            ->make(true);
    }

    public function downloadExcel($tryOutId)
    {
        $tryOutName = TryOut::where('id', $tryOutId)->first()->name;
        $data = $this->grading($tryOutId, true);
        // $correctAnswerParticipant = $data['correctAnswerParticipant'];
        
        return Excel::download(new UserAnswerGradingExport($data), 'nilai-peserta-tryout-' . $tryOutName . '.xlsx');
    }
}
