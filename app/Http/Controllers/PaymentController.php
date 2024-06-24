<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index($productId)
    {
        $product = Product::with('tryOut')->where('id', $productId)->first();
        $user = auth()->user();
        return view('web.sections.landing-page.payment', compact('product', 'user'));
    }
}
