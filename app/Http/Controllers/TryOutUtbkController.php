<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TryOutUtbkController extends Controller
{
    public function index() 
    {
        $boundary = 6;
        // $products = Product::with('tryOut')->where('is_active', true)->paginate($boundary);
        $dateNow = Carbon::parse(now())->setTimezone('Asia/Jakarta');

        $products = Product::join('try_outs', 'products.tryout_id', '=', 'try_outs.id')
            ->where('try_outs.is_active', true)
            ->orderByRaw('try_outs.end_date >= ? desc', [$dateNow])
            ->orderBy('try_outs.start_date', 'asc')
            ->paginate($boundary, ['products.*']);

        return view('web.sections.landing-page.tryout', compact('products', 'dateNow'));
    }

    public function show($id)
    {
        $product = Product::with('tryOut')->where('id', $id)->first();
        $otherTryOuts = Product::with('tryOut')->where('tryout_id', '!=', $product->tryout_id)->latest()->limit(3)->get();
        $dateNow = Carbon::parse(now())->setTimezone('Asia/Jakarta');
        return view('web.sections.landing-page.tryout-detail', compact('product', 'otherTryOuts', 'dateNow'));
    }
}
