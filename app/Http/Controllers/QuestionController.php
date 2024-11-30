<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Question;
use App\Models\SubTest;
use App\Models\TestAnswer;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($subTestId)
    {
        $boundary = 10;
        $subTest = SubTest::findOrFail($subTestId);
        $questions = Question::where('sub_test_id', $subTestId)->paginate($boundary);
        $countQuestions = Question::where('sub_test_id', $subTestId)->count();
        $no = $boundary * ($questions->currentPage() - 1);
        return view('web.sections.dashboard.admin.question', compact('subTest','questions', 'no', 'countQuestions'));
    }

    public function upload(Request $request)
    {
        // Log::info('Upload request received:', $request->all());
        // if($request->hasFile('file')) {
        //     $file = $request->file('file');
        //     $path = $file->store('public/questions');
        //     $path = str_replace('public/', '', $path);
        //     return response()->json(['path' => $path]);
        // }
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $path = storage_path('app/public/tmp/uploads');
            $fileName = $request->file('upload')->move($path, $fileName)->getFilename();
    
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/tmp/uploads/' . $fileName);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
    
            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
        return false;
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
    public function store(StoreQuestionRequest $request, $id)
    {
            
        try {
            DB::transaction(function () use($request, $id) {
                $question = Question::create([
                    'sub_test_id' => $id,
                    'type' => $request->type,
                    'question_text' => $request->question_text,
                    'answer_explanation' => $request->answer_explanation,
                ]);

                // Dapatkan ID dari pertanyaan yang baru saja dimasukkan
                $questionId = $question->id;
                $answers = $request->answers;
                $isCorrects = $request->is_correct;
                $statements = $request->statements ?? null;
    
                if ($request->type !=='isian_singkat') {
                    foreach ($answers as $index => $answer) {
                        TestAnswer::create([
                            'question_id' => $questionId,
                            'answer' => $answer,
                            'is_correct' => $isCorrects[$index],
                            'statement' => $statements[$index] ?? null,
                        ]);
                    }
                } else {
                    TestAnswer::create([
                        'question_id' => $questionId,
                        'answer' => $request->answers,
                        'is_correct' => 1,
                    ]);
                }
                
            });
            return redirect()->route('questions', $id)->with([
                'status' => 'success',
                'message' => 'Soal berhasil ditambahkan.'
            ]);
        } catch (QueryException $e) {
            return back()->with([
                'status' => 'error', 
                'message' => 'Gagal menambahkan soal karena.'.$e->getMessage()
            ]);
        }
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
    public function edit($id)
    {
        $question = Question::find($id);
        $types = Question::$types;
        $testAnswer = TestAnswer::where('question_id', $id)->get();

        return view('web.sections.dashboard.admin.question-edit', compact('question', 'types', 'testAnswer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuestionRequest $request, $id)
    {
        try {
            DB::transaction(function () use($request, $id) {
                $question = Question::find($id);
                $question->update([
                    'type' => $request->type,
                    'question_text' => $request->question_text,
                    'answer_explanation' => $request->answer_explanation,
                ]);

                $answers = $request->answers;
                $isCorrects = $request->is_correct;
                $statements = $request->statements ?? null;
                $initialIdAnswers = $request->id_answers;
                $oldIdAnswers = TestAnswer::where('question_id', $id)->pluck('id')->toArray();
                // check apakah ada id yang dihapus
                foreach($oldIdAnswers as $index => $id_answer) {
                    if (!in_array($id_answer, $initialIdAnswers)) {
                        TestAnswer::find($id_answer)->delete();
                    }
                }
    
                if ($request->type === 'pilihan_ganda' || $request->type === 'pilihan_ganda_majemuk') {
                    foreach ($answers as $index => $answer) {
                        if ($initialIdAnswers[$index] !== null) {
                            TestAnswer::find($initialIdAnswers[$index])->update([
                                'answer' => $answer,
                                'is_correct' => $isCorrects[$index],
                                'statement' => $statements[$index] ?? null,
                            ]);
                        } else {
                            TestAnswer::create([
                                'question_id' => $id,
                                'answer' => $answer,
                                'is_correct' => $isCorrects[$index],
                                'statement' => $statements[$index] ?? null,
                            ]);
                        }
                    }
                } else if ($request->type === 'pernyataan') {
                    foreach ($answers as $index => $answer) {
                        if ($initialIdAnswers[$index] !== null) {
                            TestAnswer::find($initialIdAnswers[$index])->update([
                                'answer' => $answer,
                                'is_correct' => $isCorrects[$index],
                                'statement' => $statements[$index] ?? null,
                            ]);
                        } else {
                            TestAnswer::create([
                                'question_id' => $id,
                                'answer' => $answer,
                                'is_correct' => $isCorrects[$index],
                                'statement' => $statements[$index] ?? null,
                            ]);
                        }
                    }
                } else {
                    if ($initialIdAnswers[0] !== null) {
                        TestAnswer::find($initialIdAnswers[0])->update([
                            'answer' => $answers,
                            'is_correct' => 1,
                        ]);
                    } else {
                        TestAnswer::create([
                            'question_id' => $id,
                            'answer' => $answers,
                            'is_correct' => 1,
                        ]);
                    }
                }
                
            });
            return redirect()->route('questions', $request->sub_test_id)->with([
                'status' => 'success',
                'message' => 'Soal berhasil diubah.'
            ]);
        } catch (QueryException $e) {
            return back()->with([
                'status' => 'error', 
                'message' => 'Gagal mengubah soal karena.'.$e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $question = Question::findOrFail($id);
            $question->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Soal berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error', 'message' => 
                'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }
}
