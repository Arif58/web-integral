<?php

namespace App\Http\Controllers;

use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class TutorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $highlightedOrder = Tutor::where('highlighted_order', '!=', null)->get();
        $tutors = Tutor::orderBy('name', 'asc')->get();
        return view('web.sections.dashboard.admin.tutor', compact('highlightedOrder', 'tutors'));
    }

    public function getTutors()
    {
        $query = Tutor::query();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('photo', function ($tutor) {
                return '<img src="' . asset('storage/' . $tutor->photo) . '" class="img-fluid" style="max-width: 100px;">';
            })
            ->addColumn('action', function ($tutor) {
                return '
                <button class="btn btn-warning btn-lg me-2 edit-tutor" data-id="' . $tutor->id . '"><i class="fas fa-edit"></i></button>
                <button class="btn btn-lg btn-danger delete-tutor" data-id="' . $tutor->id . '"><i class="fas fa-trash"></i></button>';
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
            'highlighted_order.*.distinct' => 'Data Tutor tidak boleh sama.',
        ]);

        $highlightedOrder = $request->highlighted_order;

        // Proses data yang diterima dari formulir
        foreach ($highlightedOrder as $order => $tutorId) {
            if ($tutorId == null) {
                Tutor::where('highlighted_order', $order + 1)->update([
                    'highlighted_order' => null,
                ]);
            }
            else {
                Tutor::where('id', $tutorId)->update([
                    'highlighted_order' => $order + 1,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Tutor yang ditampilkan berhasil diperbarui.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'education' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|file|max:2048',
        ]);

        // Menyimpan foto jika ada
        if ($request->hasFile('photo')) {
            $imageName = Storage::disk('public')->put('posts/images', request()->file('photo'));
            $validated['photo'] = $imageName;

        } else {
            $imageName = null; // Set default value if no photo is uploaded
        }

        // Menyimpan data ke database
        Tutor::create([
            'name' => $request->name,
            'position' => $request->position,
            'education' => $request->education,
            'photo' => $imageName,
        ]);

        return back()->with('success', 'Data tutor berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tutor = Tutor::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'education' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|file|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $imageName = Storage::disk('public')->put('posts/images', request()->file('photo'));
            $tutor->photo = $imageName;
        }

        $tutor->name = $request->name;
        $tutor->position = $request->position;
        $tutor->education = $request->education;
        $tutor->save();

        return back()->with('success', 'Data tutor berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tutor = Tutor::findOrFail($id);
        $tutor->delete();
        return redirect()->back();
    }
}
