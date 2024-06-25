<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index($productId)
    {
        $product = Product::with('tryOut')->where('id', $productId)->first();
        $user = auth()->user();
        return view('web.sections.payment.payment', compact('product', 'user'));
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
            'total_price' => 'required|numeric',
            'payment_method' => 'required|string',
        ]);

        $order = Order::create([
            'product_id' => $request->product_id,
            'user_id' => $request->user_id,
            'total_price' => $request->total_price,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
            'expired_at' => now()->addDay(),
        ]);

        if ($request->payment_method === 'qris')
        {
            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;

            $params = array(
                'transaction_details' => array(
                    'order_id' => $order->id,
                    'gross_amount' => $order->total_price,
                ),
                'customer_details' => array(
                    'name' => $request->fullname,
                    'phone' => $request->phone,
                ),
            );

            $snapToken = \Midtrans\Snap::getSnapToken($params);

            return view('web.sections.payment.payment-qris', compact('snapToken'));
        }
    }
}
