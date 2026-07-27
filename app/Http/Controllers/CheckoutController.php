<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Cart;
use App\Models\Product; 
use App\Models\PaymentMethod;
use App\Models\UserVoucher; // <-- Tambahkan model UserVoucher
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $checkoutItems = collect(); 
        
        // Penanda khusus untuk fitur "Beli Langsung"
        $isDirect = false;
        $directProductId = null;
        $directQuantity = null;

        // 1. Cek apakah ini jalur "Beli Sekarang" (pembelian langsung)
        if ($request->has('product_id')) {
            $product = Product::findOrFail($request->query('product_id'));
            $quantity = $request->query('quantity', 1);

            $dummyCart = new Cart();
            $dummyCart->id = 'direct'; 
            $dummyCart->product_id = $product->id;
            $dummyCart->quantity = $quantity;
            $dummyCart->setRelation('product', $product);

            $checkoutItems->push($dummyCart);
            
            // Simpan data untuk dikirim ke view
            $isDirect = true;
            $directProductId = $product->id;
            $directQuantity = $quantity;
        }
        // 2. Jika bukan Beli Sekarang, gunakan jalur standar Keranjang
        elseif ($request->has('cart_ids')) {
            $cartIds = $request->query('cart_ids');
            $checkoutItems = Cart::with('product')
                ->whereIn('id', $cartIds)
                ->where('user_id', Auth::id())
                ->get();
        }

        if ($checkoutItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Pilih produk terlebih dahulu.');
        }

        // 3. Hitung Rincian Biaya
        $totalHarga = $checkoutItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        $ongkir = 15000;
        $biayaLayanan = 1000;
        $grandTotal = $totalHarga + $ongkir + $biayaLayanan;

        // 4. LOGIKA PILIH ALAMAT
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

        // 6. Ambil kartu kredit/debit dan e-wallet user
        $savedCards = Auth::user()->paymentMethods()->where('type', 'kartu')->get();
        $savedEwallets = Auth::user()->paymentMethods()->where('type', 'ewallet')->get();

        // 7. AMBIL VOUCHER YANG SUDAH DIKLAIM USER
        $myVouchers = UserVoucher::with('voucher')
    ->where('user_id', Auth::id())
    ->whereNull('used_at') // Hanya ambil voucher yang belum pernah dipakai
    ->get()
    ->pluck('voucher');

        // 8. Kirim semua variabel ke View (termasuk $myVouchers)
        return view('user.checkout', compact(
            'alamatUtama',
            'checkoutItems',
            'totalHarga',
            'biayaLayanan',
            'grandTotal',
            'semuaAlamat',
            'savedCards',
            'savedEwallets',
            'isDirect',        
            'directProductId', 
            'directQuantity',  
            'myVouchers'       // <-- Variabel Voucher yang dikirim ke view checkout
        ));
    }
}