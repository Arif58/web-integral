<?php

namespace App\Http\Controllers;

use App\Models\Qna;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class QnaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('web.sections.dashboard.admin.faqs');
    }

    public function getFaqs()
    {
        $query = Qna::query();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($faq) {
                return '
                <button class="btn btn-warning btn-lg me-2 edit-faq" data-id="' . $faq->id . '"><i class="fas fa-edit"></i></button>
                <button class="btn btn-lg btn-danger delete-faq" data-id="' . $faq->id . '"><i class="fas fa-trash"></i></button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validasi input
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        //proses data yang diterima dari formulir
        Qna::create([
            'question' => $request->question,
            'answer' => $request->answer,
        ]);

        return back()->with('success', 'Pertanyaan dan jawaban berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $faq = Qna::findOrFail($id);

        //validasi input
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        //proses data yang diterima dari formulir
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();

        return back()->with('success', 'Pertanyaan dan jawaban berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $faq = Qna::findOrFail($id);
        $faq->delete();

        return redirect()->back();
    }
}
