<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\SubTest;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($subTestId)
    {
        $boundary = 5;
        $subTest = SubTest::findOrFail($subTestId);
        $questions = Question::where('sub_test_id', $subTestId)->paginate($boundary);
        $no = $boundary * ($questions->currentPage() - 1);
        return view('web.sections.dashboard.admin.question', compact('subTest','questions', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        //
    }
}
