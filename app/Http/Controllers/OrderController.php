<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Proses checkout dari keranjang
    public function process(Request $request)
    {
        $cartItems = Cart::where('user_id', Auth::id())
                         ->whereIn('id', $request->cart_ids)
                         ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        $order = Order::create([
            'user_id' => Auth::id(),
            'total'   => $total,
            'status'  => 'diproses',
        ]);

        foreach ($cartItems as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $item->product->price,
            ]);
        }

        Cart::whereIn('id', $request->cart_ids)->delete();

        // Redirect ke halaman sukses
        return redirect()->route('order.success', $order->id);
    }

    // Halaman sukses setelah checkout
    public function success($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        return view('user.order_success', compact('order'));
    }

    // Daftar semua pesanan milik user login
    public function index()
    {
        $orders = auth()->user()->orders()->latest()->get();
        return view('user.orders.index', compact('orders'));
    }

    // Detail satu pesanan
    public function show(Order $order)
    {
        return view('user.orders.show', compact('order'));
    }
}
