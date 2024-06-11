<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\SubTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function upload(Request $request)
    {
        dd('test');
        try {
                $question = new Question();
                $question->id = 0;
                $question->exists = true;
                $image = $question->addMediaFromRequest('upload')->toMediaCollection('thumb');
        return response()->json([
                    'uploaded' => true,
                    'url' => $image->getUrl('thumb')
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'uploaded' => false,
                    'error' => [
                        'message' => $e->getMessage()
                    ]
                ]);
            }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($subTestId)
    {
        $subTest = SubTest::findOrFail($subTestId);
        $types = Question::$types;
        return view('web.sections.dashboard.admin.question-create', compact('subTest', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        dd($request->all());

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
