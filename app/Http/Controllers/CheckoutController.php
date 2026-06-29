<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Cart;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil ID keranjang dari URL (?cart_ids[]=...)
        $cartIds = $request->query('cart_ids');

        if (!$cartIds) {
            return redirect()->route('cart.index')->with('error', 'Pilih produk terlebih dahulu.');
        }

        // 2. Ambil produk yang dipilih untuk checkout
        $checkoutItems = Cart::with('product')
            ->whereIn('id', $cartIds)
            ->where('user_id', Auth::id())
            ->get();

        // 3. Hitung Rincian Biaya
        $totalHarga = $checkoutItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        $ongkir = 15000;
        $biayaLayanan = 1000;
        $grandTotal = $totalHarga + $ongkir + $biayaLayanan;

        // 4. LOGIKA PILIH ALAMAT (Manual via Modal atau Default)
        $pilihanAlamatId = $request->query('alamat_id');

        if ($pilihanAlamatId) {
            $alamatUtama = Alamat::with('user')
                ->where('id', $pilihanAlamatId)
                ->where('user_id', Auth::id())
                ->first();
        } else {
            $alamatUtama = Alamat::with('user')
                ->where('user_id', Auth::id())
                ->where('is_utama', true)
                ->first() 
                ?? Alamat::with('user')
                    ->where('user_id', Auth::id())
                    ->latest()
                    ->first();
        }

        // 5. Ambil semua daftar alamat untuk Modal
        $semuaAlamat = Alamat::with('user')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        // 6. Ambil kartu kredit/debit user
        $kartu = Auth::user()->paymentMethods()->where('type', 'kartu')->get();

        // 7. Kirim semua variabel ke View
        return view('user.checkout', compact(
            'alamatUtama',
            'checkoutItems',
            'totalHarga',
            'biayaLayanan',
            'grandTotal',
            'semuaAlamat',
            'kartu'
        ));
    }
}