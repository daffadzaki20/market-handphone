<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Controllers
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\UserVoucherController;

/*
|--------------------------------------------------------------------------
| HOME → Selalu buka dashboard dulu (public, tanpa cek login)
|--------------------------------------------------------------------------
*/
Route::get('/', [DashboardController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (Login / Register / Logout)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // ------------------------------------------------------------------
    // DASHBOARD (untuk user yang sudah login, akses /dashboard)
    // ------------------------------------------------------------------
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ------------------------------------------------------------------
    // PROFIL
    // ------------------------------------------------------------------
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/',             [ProfileController::class, 'edit'])->name('edit');
        Route::post('/update',       [ProfileController::class, 'update'])->name('update');
        Route::post('/photo',        [ProfileController::class, 'uploadPhoto'])->name('photo');
        Route::delete('/',           [ProfileController::class, 'destroy'])->name('destroy');

        Route::get('/password',      [ProfileController::class, 'passwordForm'])->name('password');
        Route::post('/password',     [ProfileController::class, 'updatePassword'])->name('password.update');

        Route::get('/pesanan',       [ProfileController::class, 'orders'])->name('orders');

        // Payment Method (Bank/Kartu)
        Route::get('/bank',          [PaymentMethodController::class, 'index'])->name('bank');
        Route::post('/kartu/store',          [PaymentMethodController::class, 'storeCard'])->name('card.store');
        Route::post('/kartu/{id}/detail',    [PaymentMethodController::class, 'getCardDetails'])->name('card.detail');
        Route::delete('/kartu/{id}',         [PaymentMethodController::class, 'destroy'])->name('bank.destroy');

        // 👇 RUTE NOTIFIKASI SUDAH DIPERBARUI MENGGUNAKAN CONTROLLER 👇
        Route::get('/notifikasi',    [ProfileController::class, 'notifications'])->name('notifications');
        
        Route::get('/voucher', [UserVoucherController::class, 'index'])->name('voucher');
        Route::post('/vouchers/claim', [UserVoucherController::class, 'claim'])->name('voucher.claim');
    });

    // ------------------------------------------------------------------
    // ALAMAT
    // ------------------------------------------------------------------
    Route::prefix('profile/alamat')->name('alamat.')->group(function () {
        Route::get('/',       [AlamatController::class, 'index'])->name('index');
        Route::post('/',      [AlamatController::class, 'store'])->name('store');
        Route::put('/{id}',   [AlamatController::class, 'update'])->name('update');
        Route::delete('/{id}',[AlamatController::class, 'destroy'])->name('destroy');
    });

    // ------------------------------------------------------------------
    // KERANJANG
    // ------------------------------------------------------------------
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/',                    [CartController::class, 'index'])->name('index');
        Route::post('/add/{id}',           [CartController::class, 'store'])->name('add');
        Route::patch('/update/{id}',       [CartController::class, 'update'])->name('update');
        Route::delete('/remove/{id}',      [CartController::class, 'destroy'])->name('remove');
        Route::delete('/bulk-delete',      [CartController::class, 'bulkDelete'])->name('bulk-delete');
    });

    // Wishlist Routes
    Route::post('/wishlist/toggle/{product}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::delete('/wishlist/{product}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

    // ------------------------------------------------------------------
    // CHECKOUT & ORDER (USER)
    // ------------------------------------------------------------------
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [OrderController::class, 'process'])->name('checkout.process');

    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/',              [OrderController::class, 'index'])->name('index');
        Route::get('/{order}',       [OrderController::class, 'show'])->name('show');
        Route::put('/{id}/cancel', [OrderController::class, 'userCancel'])->name('cancel');
    });

    Route::get('/order/success/{id}', [OrderController::class, 'success'])->name('order.success');

    // ------------------------------------------------------------------
    // ADMIN ROUTES (proteksi role admin)
    // ------------------------------------------------------------------
    Route::middleware('can:admin')->prefix('admin')->name('admin.')->group(function () {

        Route::get('/', [DashboardController::class, 'adminDashboard'])->name('dashboard');

        // Handphone
        Route::prefix('handphones')->name('handphones.')->group(function () {
            Route::get('/',           [ProductController::class, 'adminHandphoneIndex'])->name('index');
            Route::get('/create',     [ProductController::class, 'adminHandphoneCreate'])->name('create');
            Route::post('/',          [ProductController::class, 'adminHandphoneStore'])->name('store');
            Route::get('/{id}',       [ProductController::class, 'adminHandphoneShow'])->name('show');
            Route::get('/{id}/edit',  [ProductController::class, 'adminHandphoneEdit'])->name('edit');
            Route::put('/{id}',       [ProductController::class, 'adminHandphoneUpdate'])->name('update');
            Route::delete('/{id}',    [ProductController::class, 'adminHandphoneDestroy'])->name('destroy');
        });

        // Aksesoris
        Route::prefix('aksesoris')->name('aksesoris.')->group(function () {
            Route::get('/',           [ProductController::class, 'adminAksesorisIndex'])->name('index');
            Route::get('/create',     [ProductController::class, 'adminAksesorisCreate'])->name('create');
            Route::post('/',          [ProductController::class, 'adminAksesorisStore'])->name('store');
            Route::get('/{id}',       [ProductController::class, 'adminAksesorisShow'])->name('show');
            Route::get('/{id}/edit',  [ProductController::class, 'adminAksesorisEdit'])->name('edit');
            Route::put('/{id}',       [ProductController::class, 'adminAksesorisUpdate'])->name('update');
            Route::delete('/{id}',    [ProductController::class, 'adminAksesorisDestroy'])->name('destroy');
        });

        // Users
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/',          [AdminUserController::class, 'index'])->name('index');
            Route::get('/create',    [AdminUserController::class, 'create'])->name('create');
            Route::post('/',         [AdminUserController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [AdminUserController::class, 'edit'])->name('edit');
            Route::put('/{id}',      [AdminUserController::class, 'update'])->name('update');
            Route::delete('/{id}',   [AdminUserController::class, 'destroy'])->name('destroy');
        });

        // Orders Admin
        Route::prefix('orders')->name('orders.')->group(function () {
            Route::get('/',              [OrderController::class, 'adminIndex'])->name('index');
            Route::get('/{id}/detail', [OrderController::class, 'adminShow'])->name('show');
            Route::put('/{id}/status', [OrderController::class, 'updateStatus'])->name('updateStatus');
            Route::put('/{id}/cancel', [OrderController::class, 'adminCancel'])->name('cancel');
        });

        // Kelola Voucher Admin
        Route::prefix('vouchers')->name('vouchers.')->group(function () {
            Route::get('/',          [VoucherController::class, 'index'])->name('index');
            Route::get('/create',    [VoucherController::class, 'create'])->name('create');
            Route::post('/',         [VoucherController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [VoucherController::class, 'edit'])->name('edit');
            Route::put('/{id}',      [VoucherController::class, 'update'])->name('update');
            Route::delete('/{id}',   [VoucherController::class, 'destroy'])->name('destroy');
        });

        // Laporan PDF
        Route::get('/laporan/pdf', [DashboardController::class, 'exportPdf'])->name('laporan.pdf');
    });
});

// ------------------------------------------------------------------
// PRODUK (PUBLIC - bisa diakses tanpa login)
// ------------------------------------------------------------------
Route::prefix('products')->name('products.')->group(function () {
    Route::get('/handphone', [ProductController::class, 'handphoneIndex'])->name('handphone');
    Route::get('/aksesoris', [ProductController::class, 'aksesorisIndex'])->name('aksesoris');
});
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');