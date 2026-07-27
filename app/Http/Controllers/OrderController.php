<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\UserVoucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

// Tambahkan dua baris ini untuk fitur Email
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderStatusUpdated;

class OrderController extends Controller
{
    // Proses checkout dari keranjang
    public function process(Request $request)
    {
        $cartIds = $request->cart_ids ?? [];
        $cartItems = collect();

        // 1. Ambil data produk (Beli Langsung vs Keranjang Normal)
        if (in_array('direct', $cartIds) || $request->has('product_id')) {
            // Jalur Beli Langsung
            $product = \App\Models\Product::find($request->product_id);
            if ($product) {
                $dummyCart = new Cart();
                $dummyCart->id = 'direct';
                $dummyCart->product_id = $product->id;
                $dummyCart->quantity = $request->quantity ?? 1;
                $dummyCart->setRelation('product', $product);
                $cartItems->push($dummyCart);
            }
        } else {
            // Jalur Keranjang
            $cartItems = Cart::with('product')
                ->where('user_id', Auth::id())
                ->whereIn('id', $cartIds)
                ->get();
        }

        // Cek jika data kosong atau tidak valid
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong atau pesanan tidak valid.');
        }

        // 2. Validasi Keamanan PIN (Untuk E-Wallet & Kartu Tersimpan)
        $pembayaran = $request->pembayaran ?? 'cod';
        if (str_starts_with($pembayaran, 'ewallet_') || str_starts_with($pembayaran, 'kartu_')) {
            $pin = $request->pin_pembayaran;
            if (!$pin || strlen($pin) !== 6) {
                return redirect()->back()->with('error', 'Gagal memproses pesanan: PIN verifikasi pembayaran tidak valid.');
            }
        }

        // 3. Kalkulasi Biaya Akhir
        $subtotal = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        $ongkir = (int) ($request->pengiriman ?? 15000);
        $proteksi = ($request->proteksi ?? 0) == 1 ? 45000 : 0;
        $biayaLayanan = 1000;
        $pesanPembeli = $request->pesan;

        // Menentukan nama pengiriman berdasarkan harga (Sesuai UI Checkout)
        $namaPengiriman = $ongkir == 35000 ? 'Kargo' : 'Reguler';

        // --- VALIDASI VOUCHER ---
        $diskonVoucher = 0;
        $userVoucher = null;

        if (!empty($request->voucher)) {
            $code = strtoupper(trim($request->voucher));

            $userVoucher = UserVoucher::with('voucher')
                ->where('user_id', Auth::id())
                ->whereNull('used_at') // belum pernah dipakai
                ->whereHas('voucher', fn($q) => $q->where('code', $code))
                ->first();

            if (!$userVoucher) {
                return redirect()->back()->with('error', 'Voucher tidak valid, sudah digunakan, atau belum Anda klaim.');
            }

            $voucher = $userVoucher->voucher;

            // Cek kedaluwarsa
            if ($voucher->expired_at && Carbon::parse($voucher->expired_at)->isPast()) {
                return redirect()->back()->with('error', 'Voucher sudah kedaluwarsa.');
            }

            // Cek minimal belanja
            if ($subtotal < $voucher->min_spend) {
                return redirect()->back()->with(
                    'error',
                    'Minimal belanja Rp ' . number_format($voucher->min_spend, 0, ',', '.') . ' untuk memakai voucher ini.'
                );
            }

            // Hitung potongan sesuai tipe
            $diskonVoucher = $voucher->type === 'percent'
                ? $subtotal * ($voucher->value / 100)
                : $voucher->value;

            // Jangan sampai potongan melebihi subtotal
            $diskonVoucher = min($diskonVoucher, $subtotal);
        }

        $total = $subtotal + $ongkir + $proteksi + $biayaLayanan - $diskonVoucher;

        // ==========================================
        // AMBIL ALAMAT ID DENGAN AMAN
        // ==========================================
        $alamatId = $request->alamat_id;
        
        // Fallback cerdas: Jika form checkout gagal mengirim alamat_id, 
        // otomatis ambil "Alamat Utama" milik user dari database.
        if (!$alamatId) {
            $alamatUtama = \App\Models\Alamat::where('user_id', Auth::id())
                ->orderBy('is_utama', 'desc')
                ->first();
                
            $alamatId = $alamatUtama ? $alamatUtama->id : null;
        }

        // 4. Buat Record Order di Database (dibungkus transaksi)
        // Menyuntikkan seluruh variabel rincian biaya ke dalam closure function use()
        $order = DB::transaction(function () use ($cartItems, $total, $subtotal, $ongkir, $biayaLayanan, $proteksi, $diskonVoucher, $namaPengiriman, $pembayaran, $pesanPembeli, $userVoucher, $alamatId) {
            
            // Simpan Data Order Beserta Seluruh Rinciannya
            $order = Order::create([
                'user_id'           => Auth::id(),
                'alamat_id'         => $alamatId,
                'subtotal'          => $subtotal,
                'ongkir'            => $ongkir,
                'biaya_layanan'     => $biayaLayanan,
                'proteksi'          => $proteksi,
                'diskon_voucher'    => $diskonVoucher,
                'metode_pengiriman' => $namaPengiriman,
                'metode_pembayaran' => $pembayaran,
                'pesan'             => $pesanPembeli,
                'total'             => $total,
                'status'            => 'diproses',
            ]);

            foreach ($cartItems as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity'   => $item->quantity,
                    'price'      => $item->product->price,
                ]);
            }

            // Tandai voucher sebagai sudah terpakai
            if ($userVoucher) {
                $userVoucher->update(['used_at' => now()]);
            }

            return $order;
        });

        // 5. Bersihkan keranjang KECUALI jika ini jalur Beli Langsung
        $dbCartIds = array_filter($cartIds, fn($id) => $id !== 'direct');
        if (count($dbCartIds) > 0) {
            Cart::whereIn('id', $dbCartIds)->delete();
        }

        // 6. Redirect dengan aman ke halaman Order Success
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

    public function adminIndex()
    {
        $orders = \App\Models\Order::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    // Menampilkan detail pesanan di sisi Admin
    public function adminShow($id)
    {
        $order = Order::with(['user', 'items.product'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    // UPDATE STATUS OLEH ADMIN (TERMASUK CATATAN DAN EMAIL KE PELANGGAN)
    public function updateStatus(Request $request, $id)
    {
        // Validasi input status dan catatan admin
        $request->validate([
            'status' => 'required|in:belum_bayar,diproses,dikirim,selesai,ditolak,dibatalkan',
            'catatan_admin' => 'nullable|string|max:500'
        ]);

        $order = \App\Models\Order::findOrFail($id);
        $order->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin
        ]);

        // LOGIKA KIRIM EMAIL FEEDBACK KE USER
        if ($order->user && $order->user->email) {
            try {
                Mail::to($order->user->email)->send(new OrderStatusUpdated($order));
            } catch (\Exception $e) {
                return redirect()->back()->with('success', 'Status pesanan diupdate, namun gagal mengirim email ke pelanggan. Pastikan koneksi internet stabil.');
            }
        }

        return redirect()->back()->with('success', 'Status pesanan berhasil diupdate dan email notifikasi telah dikirim ke pelanggan!');
    }

    // KHUSUS ADMIN: Membatalkan pesanan via tombol
    public function adminCancel($id)
    {
        $order = \App\Models\Order::findOrFail($id);

        if ($order->status !== 'diproses' && $order->status !== 'belum_bayar') {
            return redirect()->back()->with('error', 'Pesanan tidak dapat dibatalkan karena sudah masuk tahap pengiriman atau selesai.');
        }

        $order->update([
            'status' => 'dibatalkan'
        ]);

        // LOGIKA KIRIM EMAIL PEMBATALAN OLEH ADMIN
        if ($order->user && $order->user->email) {
            try {
                Mail::to($order->user->email)->send(new OrderStatusUpdated($order));
            } catch (\Exception $e) {
                // Abaikan error email
            }
        }

        return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan secara paksa oleh Admin dan email notifikasi telah dikirim.');
    }

    // KHUSUS USER: Membatalkan pesanan
    public function userCancel($id)
    {
        $order = \App\Models\Order::where('user_id', \Illuminate\Support\Facades\Auth::id())->findOrFail($id);

        if ($order->status !== 'diproses') {
            return redirect()->back()->with('error', 'Pesanan tidak bisa dibatalkan karena sudah dalam proses pengiriman atau selesai.');
        }

        $order->update([
            'status' => 'dibatalkan'
        ]);

        return redirect()->back()->with('success', 'Pesanan Anda berhasil dibatalkan.');
    }
}