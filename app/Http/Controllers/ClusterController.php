<?php

namespace App\Http\Controllers;

use App\Models\Cluster;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ClusterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('web.sections.dashboard.admin.cluster');
    }

    public function getClusters()
    {
        $query = Cluster::query();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($cluster) {
                return '
                <button class="btn btn-warning btn-lg me-2 edit-cluster" data-id="' . $cluster->id . '"><i class="fas fa-edit"></i></button>
                <button class="btn btn-lg btn-danger delete-cluster" data-id="' . $cluster->id . '"><i class="fas fa-trash"></i></button>';
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
        Cluster::create([
            'name' => $request->name,
        ]);

        return back()->with(['status' => 'success','message' => 'Rumpun berhasil ditambahkan.']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $cluster = Cluster::findOrFail($id);

        //validasi input
        $request->validate([
            'name' => 'required',
        ]);

        //proses data yang diterima dari formulir
        $cluster->update([
            'name' => $request->name,
        ]);

        return back()->with(['status' => 'success','message' => 'Rumpun berhasil diperbarui.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $cluster = Cluster::findOrFail($id);
            $cluster->delete();

            return response()->json(['status' => 'success','message' => 'Rumpun berhasil dihapus.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
        
    }
}
