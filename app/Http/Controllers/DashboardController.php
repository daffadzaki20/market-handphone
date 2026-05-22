<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $products = Product::with('brand')->get();

        return view('user.dashboard', compact('products'));
    }

    public function adminDashboard(): View
    {
        $user = Auth::user();
        if ($user->role !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat mengakses halaman ini.');
        }

        $totalProducts = Product::query()->count('id');
        $totalBrands = Brand::query()->count('id');
        $totalUsers = User::query()->count('id');
        $handphoneCount = Product::query()->whereHas('brand', function ($b) {
            $b->where('type', 'hp');
        })->count('id');
        $accessoriesCount = Product::query()->whereHas('brand', function ($b) {
            $b->where('type', 'aksesoris');
        })->count('id');
        $totalInventoryValue = Product::query()->selectRaw('COALESCE(SUM(price * stock), 0) as total')->value('total');

        $lowStockProducts = Product::with('brand')->where('stock', '<=', 5)->orderBy('stock')->limit(5)->get();
        $latestProducts = Product::with('brand')->latest()->limit(6)->get();

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
}
