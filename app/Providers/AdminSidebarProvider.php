<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\Voucher;
use Carbon\Carbon;

class AdminSidebarProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Bagikan data ke file layout admin_app / app_admin
        View::composer('layouts.app_admin', function ($view) {
            
            // 1. Handphone dengan stok <= 3
            // (Sesuaikan relasi brand/kategori jika diperlukan, misal: where('category_id', ...))
            $lowStockHandphone = Product::whereHas('brand', function($q) {
                $q->where('type', 'hp'); // atau sesuaikan filter kategori HP Anda
            })->where('stock', '<=', 3)->count();

            // 2. Aksesoris dengan stok <= 3
            $lowStockAksesoris = Product::whereHas('brand', function($q) {
                $q->where('type', '!=', 'hp'); 
            })->where('stock', '<=', 3)->count();

            // 3. User baru (Misal: user yang mendaftar dalam 24 jam terakhir)
            $newUsersCount = User::where('created_at', '>=', Carbon::now()->subDay())->count();

            // 4. Pesanan masuk dengan status 'diproses'
            $pendingOrdersCount = Order::where('status', 'diproses')->count();

            // 5. Voucher yang stoknya sudah habis (0)
            $emptyVouchersCount = Voucher::where('stock', '<=', 0)->count();

            $view->with(compact(
                'lowStockHandphone', 
                'lowStockAksesoris', 
                'newUsersCount', 
                'pendingOrdersCount', 
                'emptyVouchersCount'
            ));
        });
    }
}