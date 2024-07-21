<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('web.sections.dashboard.admin.university');
    }

    public function getUniversities()
    {
        $query = University::query();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($university) {
                return '
                <button class="btn btn-warning btn-lg me-2 edit-university" data-id="' . $university->id . '"><i class="fas fa-edit"></i></button>
                <button class="btn btn-lg btn-danger delete-university" data-id="' . $university->id . '"><i class="fas fa-trash"></i></button>';
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
        University::create([
            'name' => $request->name,
        ]);

        return back()->with(['status' => 'success','message' => 'Universitas berhasil ditambahkan.']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $university = University::findOrFail($id);

        //validasi input
        $request->validate([
            'name' => 'required',
        ]);

        //proses data yang diterima dari formulir
        $university->update([
            'name' => $request->name,
        ]);

        return back()->with(['status' => 'success','message' => 'Universitas berhasil diperbarui.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $university = University::findOrFail($id);
            $university->delete();

            return response()->json(['status' => 'success', 'message' => 'Universitas berhasil dihapus.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
