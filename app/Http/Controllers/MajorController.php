<?php

namespace App\Http\Controllers;

use App\Models\Cluster;
use App\Models\Major;
use App\Models\University;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $universities = University::all();
        $clusters = Cluster::all();
        return view('web.sections.dashboard.admin.major', compact('universities', 'clusters'));
    }

    public function getMajors()
    {
        $query = Major::with('university', 'cluster')->get();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('university.name', function ($major) {
                return $major->university->name;
            })
            ->addColumn('cluster.name', function ($major) {
                return $major->cluster->name;
            })
            ->addColumn('action', function ($major) {
                return '
                <button class="btn btn-warning btn-lg me-2 edit-major" data-id="' . $major->id . '" data-university_id="' . $major->university_id . '" data-cluster_id="' . $major->cluster_id . '"><i class="fas fa-edit"></i></button>
                <button class="btn btn-lg btn-danger delete-major" data-id="' . $major->id . '"><i class="fas fa-trash"></i></button>';
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
            'university_id' => 'required',
            'cluster_id' => 'required',
            'passing_grade' => 'nullable|numeric'
        ]);

        Major::create([
            'name' => $request->name,
            'university_id' => $request->university_id,
            'cluster_id' => $request->cluster_id,
            'passing_grade' => $request->passing_grade,
        ]);

        return back()->with('success', 'Program Studi berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $major = Major::findOrFail($id);

        //validasi input
        $request->validate([
            'name' => 'required',
            'university_id' => 'required',
            'cluster_id' => 'required',
            'passing_grade' => 'nullable|numeric'
        ]);

        //proses data yang diterima dari formulir
        $major->update([
            'name' => $request->name,
            'university_id' => $request->university_id,
            'cluster_id' => $request->cluster_id,
            'passing_grade' => $request->passing_grade,
        ]);

        return back()->with('success', 'Program Studi berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $major = Major::findOrFail($id);
        $major->delete();

        return back()->with('success', 'Program Studi berhasil dihapus.');
    }
}
