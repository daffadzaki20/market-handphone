<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('checkout', compact('cart'));
    }

    public function process(Request $request)
    {
        $cart = session()->get('cart', []);

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        Order::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'total' => $total
        ]);

        // kosongkan cart
        session()->forget('cart');

        return redirect('/')->with('success', 'Order berhasil!');
    }
}