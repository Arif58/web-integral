<?php

namespace App\Http\Controllers;

use App\Models\Qna;
use App\Models\StudentAchievement;
use App\Models\Testimoni;
use App\Models\Tutor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $studentAchievementsHighlight = StudentAchievement::whereBetween('highlighted_order', [1, 6])->orderBY('highlighted_order', 'asc')->get();

        $testimonialHighlightRowOne = Testimoni::whereBetween('highlighted_order', [1, 4])->orderBY('highlighted_order', 'asc')->get();

        $testimonialHighlightRowTwo = Testimoni::whereBetween('highlighted_order', [5, 8])->orderBY('highlighted_order', 'asc')->get();

        $tutorHighlight = Tutor::whereBetween('highlighted_order', [1, 4])->orderBY('highlighted_order', 'asc')->get();

        $faqs = Qna::orderBy('id', 'asc')->get();

        return view('web.sections.landing-page.home', compact('testimonialHighlightRowOne', 'testimonialHighlightRowTwo', 'studentAchievementsHighlight', 'tutorHighlight', 'faqs'));
    }
}
