<?php

namespace App\Http\Controllers;

use App\Models\CategorySubtest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategorySubtestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorySubtest = CategorySubtest::all();
        return view('web.sections.dashboard.admin.category-subtest', compact('categorySubtest'));
    }

    public function getCategorySubtests()
    {
        $query = CategorySubtest::query();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($categorySubtest) {
                return '
                <button class="btn btn-warning btn-lg me-2 edit-category-subtest" data-id="' . $categorySubtest->id . '"><i class="fas fa-edit"></i></button>
                <button class="btn btn-lg btn-danger delete-category-subtest" data-id="' . $categorySubtest->id . '"><i class="fas fa-trash"></i></button>';
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
            'name' => 'required',
        ]);

        //proses data yang diterima dari formulir
        CategorySubtest::create([
            'name' => $request->name,
        ]);

        return back()->with(['status' => 'success', 'message' => 'Kategori subtest berhasil ditambahkan.']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $categorySubtest = CategorySubtest::findOrFail($id);

        //validasi input
        $request->validate([
            'name' => 'required',
        ]);

        //proses data yang diterima dari formulir
        $categorySubtest->update([
            'name' => $request->name,
        ]);

        return back()->with(['status' => 'success', 'message' => 'Kategori subtest berhasil diperbarui.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $categorySubtest = CategorySubtest::findOrFail($id);
            $categorySubtest->delete();
    
            return response()->json(['status' => 'success', 'message' => 'Kategori subtest berhasil dihapus.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
        
    }
}
