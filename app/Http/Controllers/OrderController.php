<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Participant;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

            $order->update([
                'snap_token' => $snapToken,
            ]);

            // return view('web.sections.payment.payment-qris', compact('snapToken'));
            return redirect()->route('payment-qris', $snapToken);

        } else if ($request->payment_method === 'ie_gems')
        {
            $userIeGems = User::select('ie_gems')->where('id', $request->user_id)->first();

            if ($userIeGems->ie_gems - $order->total_price >= 0)
            {
                DB::transaction(function () use($request, $order) {
                    $user = User::find($request->user_id);
                    $user->update([
                        'ie_gems' => $user->ie_gems - $order->total_price,
                    ]);

                    $order->update([
                        'status' => 'success',
                    ]);

                    $tryout_id = $order->product->tryout_id;

                    Participant::create([
                        'user_id' => $order->user_id,
                        'tryout_id' => $tryout_id,
                    ]);
                });

                return redirect()->route('my-tryout')->with('success', 'Pembelian berhasil dilakukan. Silahkan cek di menu Tryout Saya.');
            } else {
                //rollback order
                $order->delete();
                return back()->with('error', 'IE Gems Anda tidak mencukupi untuk melakukan pembelian ini.');
            }
        }
    }

    public function paymentQris($snapToken)
    {
        $isExpired = Order::where('snap_token', $snapToken)->where('expired_at', '<', now())->exists();
        if ($isExpired) {
            return redirect()->route('order-history')->with('status', 'Order tidak ditemukan atau sudah kadaluarsa.');
        }
        return view('web.sections.payment.payment-qris', compact('snapToken'));
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed==$request->signature_key){
            if($request->transaction_status == 'settlement'){
                DB::transaction(function () use($request) {
                    $order = Order::find($request->order_id);
                    $order->update([
                        'status' => 'success',
                    ]);

                    $tryout_id = $order->product->tryout_id;

                    Participant::create([
                        'user_id' => $order->user_id,
                        'tryout_id' => $tryout_id,
                    ]);
                });
            }
        }
    }

    public function getOrderHistory()
    {
        $boundary = 10;
        $dateTimeNow = Carbon::parse(now())->setTimezone('Asia/Jakarta');
        // $dateTimeNow = now();
        $userId = auth()->id();
        $orders = Order::where('user_id', $userId)->with('product')->latest()->paginate($boundary);
        // dd($dateTimeNow);

        return view('web.sections.dashboard.student.order-history', compact('orders', 'dateTimeNow'));
    }
}
