<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        $cart[$id] = [
            "name" => $product->name,
            "price" => $product->price,
            "image" => $product->image,
            "quantity" => 1
        ];

        session()->put('cart', $cart);

        return redirect()->back();
    }

    public function index()
    {
        $cart = session()->get('cart', []);

        return view('cart', compact('cart'));
    }

    public function increase($id)
{
    $cart = session()->get('cart');

    if (isset($cart[$id])) {
        $cart[$id]['quantity']++;
    }

    session()->put('cart', $cart);
    return redirect()->back();
}

public function decrease($id)
{
    $cart = session()->get('cart');

    if (isset($cart[$id])) {
        $cart[$id]['quantity']--;

        if ($cart[$id]['quantity'] <= 0) {
            unset($cart[$id]);
        }
    }

    session()->put('cart', $cart);
    return redirect()->back();
}

public function remove($id)
{
    $cart = session()->get('cart');

    if (isset($cart[$id])) {
        unset($cart[$id]);
    }

    session()->put('cart', $cart);
    return redirect()->back();
}
}