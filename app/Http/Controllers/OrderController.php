<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Services\OrderCheckoutService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * @var OrderCheckoutService
     */
    protected $checkoutService;

    public function __construct(OrderCheckoutService $checkoutService)
    {
        $this->checkoutService = $checkoutService;
    }

    // Proses checkout dari keranjang
    public function process(Request $request)
    {
        $request->validate([
            'cart_ids' => 'required|array',
            'cart_ids.*' => 'exists:carts,id',
        ]);

        $order = $this->checkoutService->processCheckout(
            Auth::id(),
            $request->cart_ids,
            $request->only(['pengiriman', 'proteksi', 'voucher'])
        );

        if (!$order) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong atau item tidak ditemukan.');
        }

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

    public function adminIndex()
    {
    // Mengambil data pesanan beserta relasi data usernya, dibatasi 10 data per halaman
    $orders = \App\Models\Order::with('user')->orderBy('created_at', 'desc')->paginate(10);

    return view('admin.orders.index', compact('orders'));
    }

    // Menampilkan detail pesanan di sisi Admin
    public function adminShow($id)
    {
        // Ambil data order, beserta relasi user dan item produk yang dibeli
        $order = Order::with(['user', 'items.product'])->findOrFail($id);
        
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:diproses,dikirim,selesai,dibatalkan'
    ]);

    $order = \App\Models\Order::findOrFail($id);
    $order->update([
        'status' => $request->status
    ]);

    return redirect()->back()->with('success', 'Status pesanan berhasil diupdate!');
}
// KHUSUS ADMIN: Membatalkan pesanan via tombol
    public function adminCancel($id)
    {
        $order = \App\Models\Order::findOrFail($id);

        if ($order->status !== 'diproses') {
            return redirect()->back()->with('error', 'Pesanan tidak dapat dibatalkan karena sudah masuk tahap pengiriman atau selesai.');
        }

        $order->update([
            'status' => 'dibatalkan'
        ]);

        return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan oleh Admin.');
    }
// KHUSUS USER: Membatalkan pesanan
    public function userCancel($id)
    {
        // Pastikan order yang dicari memang milik user yang sedang login
        $order = \App\Models\Order::where('user_id', \Illuminate\Support\Facades\Auth::id())->findOrFail($id);

        // Syarat: Hanya bisa dibatalkan jika statusnya masih 'diproses'
        if ($order->status !== 'diproses') {
            return redirect()->back()->with('error', 'Pesanan tidak bisa dibatalkan karena sudah dalam proses pengiriman atau selesai.');
        }

        // Update status menjadi dibatalkan
        $order->update([
            'status' => 'dibatalkan'
        ]);

        return redirect()->back()->with('success', 'Pesanan Anda berhasil dibatalkan.');
    }
}
