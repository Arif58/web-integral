<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class TestimoniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $highlightedOrder = Testimoni::whereBetween('highlighted_order', [1,8])->get();
        $testimonies = Testimoni::orderBy('name', 'asc')->get();
        return view('web.sections.dashboard.admin.testimonial', compact('highlightedOrder', 'testimonies'));
    }

    public function getTestimonials()
    {
        $query = Testimoni::query();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('photo', function ($testimoni) {
                return '<img src="' . asset('storage/' . $testimoni->photo) . '" class="img-fluid" style="max-width: 100px;">';
            })
            ->addColumn('action', function ($testimoni) {
                return '
                <button class="btn btn-warning btn-lg me-2 edit-testimonial" data-id="' . $testimoni->id . '"><i class="fas fa-edit"></i></button>
                <button class="btn btn-lg btn-danger delete-testimonial" data-id="' . $testimoni->id . '"><i class="fas fa-trash"></i></button>';
            })
            ->rawColumns(['photo', 'action'])
            ->make(true);
    }

    public function updateHighlight(Request $request)
    {
        // Validasi input

        // dd($request->all());
        $request->validate([
            'highlighted_order.*' => 'nullable|distinct|integer',
        ], [
            'highlighted_order.*.distinct' => 'Nama testimoni tidak boleh sama.',
        ]);

        $highlightedOrder = $request->highlighted_order;

        // Proses data yang diterima dari formulir
        foreach ($highlightedOrder as $order => $testimonialId) {
            if ($testimonialId == null) {
                Testimoni::where('highlighted_order', $order + 1)->update([
                    'highlighted_order' => null,
                ]);
            }
            else {
                Testimoni::where('id', $testimonialId)->update([
                    'highlighted_order' => $order + 1,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Testimoni yang ditampilkan berhasil diperbarui.');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Validasi input
         $request->validate([
            'name' => 'required|string|max:255',
            'major' => 'required|string|max:255',
            'testimonials' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|file|max:2048',
        ]);

        // Menyimpan foto jika ada
        if ($request->hasFile('photo')) {
            // $imageName = time().'.'.$request->photo->extension();
            // $request->photo->storeAs('public/images', $imageName);
            $imageName = Storage::disk('public')->put('posts/images', request()->file('photo'));
            $validated['photo'] = $imageName;

        } else {
            $imageName = null; // Set default value if no photo is uploaded
        }

        // Menyimpan data ke database
        Testimoni::create([
            'name' => $request->name,
            'major' => $request->major,
            'testimonials' => $request->testimonials,
            'photo' => $imageName,
        ]);

        // Redirect kembali dengan pesan sukses
        return back()->with('success', 'Testimoni berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimoni $testimoni)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimoni $testimoni)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $testimonial = Testimoni::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'major' => 'required|string|max:255',
            'testimonials' => 'required|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        $testimonial->name = $request->name;
        $testimonial->major = $request->major;
        $testimonial->testimonials = $request->testimonials;

        if ($request->hasFile('photo')) {
            $testimonial->photo = $request->file('photo')->store('photos', 'public');
        }

        $testimonial->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $testimoni = Testimoni::findOrFail($id);
        $testimoni->delete();
        return redirect()->back();
    }
}
