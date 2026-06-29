<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Brand;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    public function index(): View|RedirectResponse
    {
        // Kalau belum login, tetap tampilkan dashboard versi guest
        if (!Auth::check()) {
            $products = Product::with('brand')->get();
            return view('user.dashboard', compact('products'));
        }

        $user = Auth::user();

        // Kalau admin, redirect ke admin dashboard
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $products = Product::with('brand')->get();

        return view('user.dashboard', compact('products'));
    }

    public function adminDashboard(): View
    {
        // Gunakan Gate/middleware saja, tidak perlu cek manual di sini
        // Karena route sudah diproteksi middleware('can:admin')
        $totalProducts      = Product::count();
        $totalBrands        = Brand::count();
        $totalUsers         = User::count();
        $handphoneCount     = Product::whereHas('brand', fn($b) => $b->where('type', 'hp'))->count();
        $accessoriesCount   = Product::whereHas('brand', fn($b) => $b->where('type', 'aksesoris'))->count();
        $totalInventoryValue = Product::selectRaw('COALESCE(SUM(price * stock), 0) as total')->value('total');

        $lowStockProducts = Product::with('brand')
            ->where('stock', '<=', 5)
            ->orderBy('stock')
            ->limit(5)
            ->get();

        $latestProducts = Product::with('brand')
            ->latest()
            ->limit(6)
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalBrands',
            'totalUsers',
            'handphoneCount',
            'accessoriesCount',
            'totalInventoryValue',
            'lowStockProducts',
            'latestProducts'
        ));
    }

    public function exportPdf()
    {
        $orders = Order::with('user')->orderBy('created_at', 'desc')->get();

        $pdf = Pdf::loadView('admin.laporan.pdf_view', compact('orders'));
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('Laporan-Penjualan-MyPhoneStore.pdf');
    }
}