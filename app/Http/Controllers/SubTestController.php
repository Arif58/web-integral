<?php

namespace App\Http\Controllers;

use App\Models\CategorySubtest;
use App\Models\Question;
use App\Models\SubTest;
use App\Models\TryOut;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SubTestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $tryOutDetail = TryOut::findOrFail($id);
        // dd($tryOutDetail);
        $categorySubtest = CategorySubtest::all();
        return view('web.sections.dashboard.admin.subtest', compact('tryOutDetail', 'categorySubtest'));
    }

    public function getSubTests($tryOutId)
    {
        $query = SubTest::where('try_out_id', $tryOutId);

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('category_subtest.name', function ($subTest) {
                if($subTest->categorySubtest == null) {
                    return '-';
                }
                return $subTest->categorySubtest->name;
            })
            ->addColumn('total_question', function ($subTest) {
                $questionAvailable = Question::where('sub_test_id', $subTest->id)->count();
                return $questionAvailable.'/'.$subTest->total_question ;
            })
            ->addColumn('action', function ($subTest) {
                return '
                <button class="btn btn-primary btn-lg me-2 view-question" data-id="' . $subTest->id . '"><i class="fas fa-eye"></i></button>
                <button class="btn btn-warning btn-lg me-2 edit-subtest" data-id="' . $subTest->id . '" data-category_subtest_id="' . $subTest->category_subtest_id . '" data-total_question="' . $subTest->total_question . '"><i class="fas fa-edit"></i></button>
                <button class="btn btn-lg btn-danger delete-subtest" data-id="' . $subTest->id . '"><i class="fas fa-trash"></i></button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        //validasi input
        $request->validate([
            'category_subtest_id' => 'required',
            'name' => 'required',
            'total_question' => 'required|numeric|min:1',
            'duration' => 'required|numeric|min:1',

        ]);

        //proses data yang diterima dari formulir
        SubTest::create([
            'name' => $request->name,
            'try_out_id' => $id,
            'category_subtest_id' => $request->category_subtest_id,
            'total_question' => $request->total_question,
            'duration' => $request->duration,
        ]);

        return back()->with(['status' => 'success','message' => 'Subtest berhasil ditambahkan.']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $subTest = SubTest::findOrFail($id);
        $countQuestion = Question::where('sub_test_id', $id)->count();

        //validasi input
        $request->validate([
            'category_subtest_id' => 'required',
            'name' => 'required',
            'total_question' => 'required|numeric|min:'.$countQuestion,
            'duration' => 'required|numeric|min:1',
        ]);

        //proses data yang diterima dari formulir
        $subTest->update([
            'name' => $request->name,
            'category_subtest_id' => $request->category_subtest_id,
            'total_question' => $request->total_question,
            'duration' => $request->duration,
        ]);

        return back()->with(['status' => 'success','message' => 'Subtest berhasil diperbarui.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $subTest = SubTest::findOrFail($id);
            $subTest->delete();

            return response()->json(['status' => 'success','message' => 'Subtest berhasil dihapus.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
