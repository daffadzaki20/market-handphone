<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        if (!Auth::check()) { return redirect()->route('login'); }

        $cartItems = Cart::query()
            ->with(['product.brand'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        $totalPrice = $cartItems->sum(function($item) {
            return ($item->product->price ?? 0) * $item->quantity;
        });

        // Pastikan mengarah ke view 'cart' karena file sekarang berada di resources/views/user/cart.blade.php
        return view('user.cart', compact('cartItems', 'totalPrice'));
    }

    public function store(Request $request, $id)
    {
        // 1. Cek Login
        if (!Auth::check()) {
            return response()->json(['status' => 'error', 'message' => 'Login dulu'], 401);
        }

        // 2. Keamanan ekstra: Pastikan produknya ada di database
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['status' => 'error', 'message' => 'Produk tidak ditemukan'], 404);
        }

        // 3. Proses penambahan ke keranjang
        $cart = Cart::query()->where('user_id', Auth::id())->where('product_id', $id)->first();

        if ($cart) {
            $cart->update(['quantity' => $cart->quantity + 1]);
        } else {
            Cart::query()->create([
                'user_id' => Auth::id(),
                'product_id' => $id,
                'quantity' => 1
            ]);
        }

        $cartCount = (int) Cart::query()->where('user_id', Auth::id())->sum('quantity');

        return response()->json([
            'status' => 'success',
            'cart_count' => $cartCount
        ]);
    }

    public function destroy($id)
    {
        $cart = Cart::query()->where('user_id', Auth::id())->find($id);
        if ($cart) { 
            $cart->delete(); 
        }
        return redirect()->back()->with('success', 'Produk dihapus dari keranjang');
    }

    public function bulkDelete(Request $request)
    {
        // Keamanan ekstra: Pastikan request ids ada isinya dan berupa array
        if ($request->ids && is_array($request->ids)) {
            Cart::query()->where('user_id', Auth::id())->whereIn('id', $request->ids)->delete();
            return redirect()->back()->with('success', 'Produk terpilih berhasil dihapus');
        }
        
        return redirect()->back()->with('error', 'Tidak ada produk yang dipilih');
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::query()->where('user_id', Auth::id())->find($id);
        
        if ($cart && $request->quantity > 0) {
            $cart->update(['quantity' => $request->quantity]);
            
            $cartCount = (int) Cart::where('user_id', Auth::id())->sum('quantity');
            
            return response()->json([
                'status' => 'success',
                'cart_count' => $cartCount 
            ]);
        }
        
        return response()->json(['status' => 'error', 'message' => 'Gagal mengupdate keranjang'], 404);
    }


}