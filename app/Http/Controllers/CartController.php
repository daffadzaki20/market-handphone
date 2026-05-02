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

        // Pastikan mengarah ke view 'cart' karena kamu ingin menggunakan resources/views/cart.blade.php
        return view('cart', compact('cartItems', 'totalPrice')); 
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

    /**
     * Tampilkan halaman Checkout berdasarkan item yang dipilih
     */
    public function checkout(Request $request)
    {
        // Pastikan ada barang yang dipilih
        if (!$request->cart_ids || !is_array($request->cart_ids)) {
            return redirect('/cart')->with('error', 'Pilih minimal satu produk untuk di-checkout.');
        }

        // Ambil data keranjang beserta produknya berdasarkan ID yang diceklis (Khusus milik user yang login)
        $checkoutItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->whereIn('id', $request->cart_ids)
            ->get();

        // Jika data keranjangnya kosong setelah difilter
        if ($checkoutItems->isEmpty()) {
            return redirect('/cart')->with('error', 'Produk tidak valid.');
        }

        // Hitung total harga barang
        $totalHarga = $checkoutItems->sum(function($item) {
            return ($item->product->price ?? 0) * $item->quantity;
        });

        // Contoh biaya tambahan (Bisa Anda buat dinamis nanti)
        $ongkosKirim = 15000;
        $biayaLayanan = 2500;
        $grandTotal = $totalHarga + $ongkosKirim + $biayaLayanan;

        return view('checkout', compact('checkoutItems', 'totalHarga', 'ongkosKirim', 'biayaLayanan', 'grandTotal'));
    }
}