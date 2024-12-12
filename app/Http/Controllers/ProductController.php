<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\TryOut;
use App\Traits\GradingIrt;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    use GradingIrt;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $selectedTryoutIds = Product::pluck('tryout_id')->toArray();
        $tryouts = Tryout::whereNotIn('id', $selectedTryoutIds)->where('is_active', true)->get();
        // $tryouts = TryOut::where('is_active', true)->orderBy('created_at', 'desc')->get();
        return view('web.sections.dashboard.admin.product', compact('tryouts'));
    }

    public function getProducts()
    {
        $query = Product::with('tryOut', 'participants')->where('is_active', true)->get();
 
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('try_outs.name', function ($product) {
                if($product->tryOut == null) {
                    return '-';
                }
                return $product->tryOut->name;
            })
            ->addColumn('try_outs.date', function ($product) {
                if($product->tryOut == null) {
                    return '-';
                }
                $startDate = Carbon::parse($product->tryOut->start_date)->format('d M');
                $endDate = Carbon::parse($product->tryOut->end_date)->format('d M Y');
                return $startDate . ' - ' . $endDate;
            })
            ->addColumn('price', function ($product) {
                return 'Rp ' . number_format($product->price, 0, ',', '.');
            })
            ->addColumn('ie_gems', function ($product) {
                return $product->ie_gems;
            })
            ->addColumn('participants', function ($product) {
                return $product->participants->count();
            })
            ->addColumn('is_grading_completed', function ($product) {
                if($product->tryOut == null) {
                    return '-';
                }
                return $product->tryOut->is_grading_completed ? 'Sudah' : 'Belum';
            })
            ->addColumn('action', function ($product) {
                $dateNow = Carbon::parse(now())->setTimezone('Asia/Jakarta');

                if(($product->tryOut->end_date < $dateNow && $product->tryOut->is_grading_completed == false) && $product->participants->count() > 0) {
                    return '
                    <div class="row text-center">
                        <div class="col-12">
                        <button class="btn btn-warning btn-lg generate-score" data-id="' . $product->tryout_id . '">Proses Nilai</button>
                        </div>
                    </div>
                    <div class="row text-center mt-2">
                        <div class="col-12">
                        <button class="btn btn-primary btn-lg me-2 view-participants" data-id="' . $product->id . '"><i class="fas fa-eye"></i></button>
                        <button class="btn btn-lg btn-danger delete-product" data-id="' . $product->id . '"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>';
                } else {
                    return '
                    <div class="row text-center mt-2">
                        <div class="col-12">
                        <button class="btn btn-primary btn-lg me-2 view-participants" data-id="' . $product->id . '"><i class="fas fa-eye"></i></button>
                        <button class="btn btn-lg btn-danger delete-product" data-id="' . $product->id . '"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>';
                }
                
                
                
            })
            ->rawColumns(['action'])
            ->make(true);
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
            'tryout_id' => 'required',
            'price' => 'required',
            'ie_gems' => 'required|numeric|min:0',
            'supported' => 'required',
            'not_supported' => 'nullable',
            // 'answer_explanation_file' => 'required|file|mimes:pdf,doc,docx,zip|max:10240',
        ]);

        $features = [
            'supported' => explode("\r\n", $request->supported),
            'not_supported' => explode("\r\n", $request->not_supported),
        ];

        if($request->hasFile('answer_explanation_file')) {
           $fileName = Storage::disk('public')->put('posts/file', request()->file('answer_explanation_file'));
           $validated['answer_explanation_file'] = $fileName;
        } else {
            $fileName = null;
        }

        Product::create([
            'tryout_id' => $request->tryout_id,
            'price' => str_replace('.', '', $request->price),
            'ie_gems' => $request->ie_gems,
            'features' => json_encode($features),
            'answer_explanation_file' => $fileName,
        ]);

        return back()->with(['status' => 'success', 'message' => 'Produk berhasil ditambahkan.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    public function softDelete($id) {
        $product = Product::findOrFail($id);
        $product->update([
            'is_active' => false,
        ]);
        return back()->with('success', 'Produk berhasil dihapus');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return response()->json(['status' => 'success', 'message' => 'Produk berhasil dihapus.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
        
    }

    public function generateScore($tryOutId)
    {
        try {
            $this->grading($tryOutId);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
        }
    }

}
