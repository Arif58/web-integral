<?php

namespace App\Http\Controllers;

use App\Models\StudentAchievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class StudentAchievementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $highlightedOrder = StudentAchievement::whereBetween('highlighted_order', [1,6])->get();
        $achievements = StudentAchievement::orderBy('name', 'asc')->get();
        return view('web.sections.dashboard.admin.student-achievements', compact('highlightedOrder', 'achievements'));
    }

    public function getStudentAchievements()
    {
        $query = StudentAchievement::query();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('photo', function ($achievement) {
                return '<img src="' . asset('storage/' . $achievement->photo) . '" class="img-fluid" style="max-width: 100px;">';
            })
            ->addColumn('action', function ($achievement) {
                return '
                <button class="btn btn-warning btn-lg me-2 edit-achievement" data-id="' . $achievement->id . '"><i class="fas fa-edit"></i></button>
                <button class="btn btn-lg btn-danger delete-achievement" data-id="' . $achievement->id . '"><i class="fas fa-trash"></i></button>';
            })
            ->rawColumns(['photo', 'action'])
            ->make(true);
    }

    public function updateHighlight(Request $request)
    {
        // Validasi input
        $request->validate([
            'highlighted_order.*' => 'nullable|distinct|integer',
        ], [
            'highlighted_order.*.distinct' => 'Data Siswa Berprestasi tidak boleh sama.',
        ]);

        $highlightedOrder = $request->highlighted_order;

        // Proses data yang diterima dari formulir
        foreach ($highlightedOrder as $order => $achievementId) {
            if ($achievementId == null) {
                StudentAchievement::where('highlighted_order', $order + 1)->update([
                    'highlighted_order' => null,
                ]);
            }
            else {
                StudentAchievement::where('id', $achievementId)->update([
                    'highlighted_order' => $order + 1,
                ]);
            }
        }

        return redirect()->back()->with(['status' => 'success', 'message' => 'Urutan data siswa berprestasi berhasil diperbarui.']);
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
        $request->validate([
            'name' => 'required|string|max:20',
            'achievement' => 'required|string|max:80',
            'school' => 'required|string|max:60',
            'photo' => 'required|image|mimes:jpeg,png,jpg|file|max:2048',
        ]);

        // Menyimpan foto jika ada
        if ($request->hasFile('photo')) {
            $imageName = Storage::disk('public')->put('posts/images', request()->file('photo'));
            $validated['photo'] = $imageName;

        } else {
            $imageName = null; // Set default value if no photo is uploaded
        }

        // Menyimpan data ke database
        StudentAchievement::create([
            'name' => $request->name,
            'achievement' => $request->achievement,
            'school' => $request->school,
            'photo' => $imageName,
        ]);

        // Redirect kembali dengan pesan sukses
        return back()->with(['status' => 'success', 'message' => 'Prestasi siswa berhasil disimpan.']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $achievement = StudentAchievement::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'achievement' => 'required|string|max:255',
            'school' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $imageName = Storage::disk('public')->put('posts/images', request()->file('photo'));
            $achievement->photo = $imageName;
        }

        $achievement->name = $request->name;
        $achievement->achievement = $request->achievement;
        $achievement->school = $request->school;
        $achievement->save();

        return redirect()->back()->with(['status' => 'success', 'message' => 'Prestasi siswa berhasil diperbarui.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $achievement = StudentAchievement::findOrFail($id);
            $achievement->delete();

            return response()->json(['status' => 'success', 'message' => 'Prestasi siswa berhasil dihapus.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
        
    }
}
