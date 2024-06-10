<?php

namespace App\Http\Controllers;

use App\Models\TryOut;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TryOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('web.sections.dashboard.admin.tryout');
    }

    public function getTryOuts()
    {
        $query = TryOut::where('is_active', true);

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('start_date', function ($tryOut) {
                return Carbon::parse($tryOut->start_date)->format('d M Y, H:i');
            })
            ->addColumn('end_date', function ($tryOut) {
                return Carbon::parse($tryOut->end_date)->format('d M Y, H:i');
            })
            ->addColumn('status', function ($tryOut) {
                $dateNow = Carbon::parse(now())->setTimezone('Asia/Jakarta');

                if ($tryOut->start_date <= $dateNow && $tryOut->end_date >= $dateNow) {
                    return '<span class="badge bg-success">Sedang Berlangsung</span>';
                } elseif ($tryOut->start_date > $dateNow) {
                    return '<span class="badge bg-warning">Belum dimulai</span>';
                } elseif ($tryOut->end_date < $dateNow) {
                    return '<span class="badge bg-danger">Selesai</span>';
                }
            })
            ->addColumn('action', function ($tryOut) {
                return '
                <button class="btn btn-primary btn-lg me-2 view-subtest" data-id="' . $tryOut->id . '"><i class="fas fa-eye"></i></button>
                <button class="btn btn-warning btn-lg me-2 edit-tryout" data-id="' . $tryOut->id . '"><i class="fas fa-edit"></i></button>
                <button class="btn btn-lg btn-danger delete-tryout" data-id="' . $tryOut->id . '"><i class="fas fa-trash"></i></button>';
            })
            ->rawColumns(['action', 'status'])
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
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        //proses data yang diterima dari formulir
        TryOut::create([
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return back()->with('success', 'Try Out berhasil ditambahkan.');


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tryOut = TryOut::findOrFail($id);

        //validasi input
        $request->validate([
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        //proses data yang diterima dari formulir
        $tryOut->update([
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return back()->with('success', 'Try Out berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tryOut = TryOut::findOrFail($id);
        $tryOut->update([
            'is_active' => false,
        ]);

        return back()->with('success', 'Try Out berhasil dihapus.');
    }
}
