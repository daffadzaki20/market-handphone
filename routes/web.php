<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// HOME (LANGSUNG KE LOGIN)
Route::get('/', function () {
    return redirect('/login');
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (Login / Register / Logout)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {

    // ----------------------------------------------------------------------
    // DASHBOARD
    // ----------------------------------------------------------------------
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');

    // ----------------------------------------------------------------------
    // PROFIL
    // ----------------------------------------------------------------------
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile');
        Route::post('/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('/photo', [ProfileController::class, 'uploadPhoto'])->name('profile.photo');
        Route::get('/password', [ProfileController::class, 'passwordForm'])->name('profile.password');
        Route::post('/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::view('/bank', 'user.profile.bank')->name('profile.bank');
        Route::get('/pesanan', [ProfileController::class, 'orders'])->name('profile.orders');
        Route::view('/notifikasi', 'user.profile.notifikasi')->name('profile.notifications');
        Route::view('/voucher', 'user.profile.voucher')->name('profile.voucher');
    });

    // ALAMAT
    Route::get('/profile/alamat', [AlamatController::class, 'index'])->name('alamat.index');
    Route::post('/profile/alamat', [AlamatController::class, 'store'])->name('alamat.store');
    Route::delete('/profile/alamat/{id}', [AlamatController::class, 'destroy'])->name('alamat.destroy');
    Route::put('/profile/alamat/{id}', [AlamatController::class, 'update'])->name('alamat.update');

    // TRANSAKSI & KERANJANG
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'store'])->name('cart.add');
    Route::delete('/cart/remove/{id}', [CartController::class, 'destroy'])->name('cart.remove');
    Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/bulk-delete', [CartController::class, 'bulkDelete'])->name('cart.bulk-delete');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [OrderController::class, 'process'])->name('checkout.process');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    // HALAMAN PRODUK
    Route::get('/products/handphone', [ProductController::class, 'handphoneIndex'])->name('handphone.index');
    Route::get('/products/aksesoris', [ProductController::class, 'aksesorisIndex'])->name('aksesoris.index');
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

    // ADMIN PAGE
    Route::get('/admin/handphones', [ProductController::class, 'adminHandphoneIndex'])->name('admin.handphones.index');
    Route::get('/admin/handphones/create', [ProductController::class, 'adminHandphoneCreate'])->name('admin.handphones.create');
    Route::post('/admin/handphones', [ProductController::class, 'adminHandphoneStore'])->name('admin.handphones.store');
    Route::get('/admin/handphones/{id}', [ProductController::class, 'adminHandphoneShow'])->name('admin.handphones.show');
    Route::get('/admin/handphones/{id}/edit', [ProductController::class, 'adminHandphoneEdit'])->name('admin.handphones.edit');
    Route::put('/admin/handphones/{id}', [ProductController::class, 'adminHandphoneUpdate'])->name('admin.handphones.update');
    Route::delete('/admin/handphones/{id}', [ProductController::class, 'adminHandphoneDestroy'])->name('admin.handphones.destroy');

    Route::get('/admin/aksesoris', [ProductController::class, 'adminAksesorisIndex'])->name('admin.aksesoris.index');
    Route::get('/admin/aksesoris/create', [ProductController::class, 'adminAksesorisCreate'])->name('admin.aksesoris.create');
    Route::post('/admin/aksesoris', [ProductController::class, 'adminAksesorisStore'])->name('admin.aksesoris.store');
    Route::get('/admin/aksesoris/{id}', [ProductController::class, 'adminAksesorisShow'])->name('admin.aksesoris.show');
    Route::get('/admin/aksesoris/{id}/edit', [ProductController::class, 'adminAksesorisEdit'])->name('admin.aksesoris.edit');
    Route::put('/admin/aksesoris/{id}', [ProductController::class, 'adminAksesorisUpdate'])->name('admin.aksesoris.update');
    Route::delete('/admin/aksesoris/{id}', [ProductController::class, 'adminAksesorisDestroy'])->name('admin.aksesoris.destroy');

    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [AdminUserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');

    Route::get('/order/success/{id}', [OrderController::class, 'success'])->name('order.success');
    Route::get('/admin/orders/pdf', [DashboardController::class, 'exportPdf'])->name('admin.laporan.pdf');
    Route::get('/admin/orders', [OrderController::class, 'adminIndex'])->name('admin.orders.index');
    Route::get('/admin/orders/{id}/detail', [OrderController::class, 'adminShow'])->name('admin.orders.show');
    Route::put('/admin/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    Route::put('/admin/orders/{id}/cancel', [OrderController::class, 'adminCancel'])->name('admin.orders.cancel');
    
    Route::put('/orders/{id}/cancel', [OrderController::class, 'userCancel'])->name('user.orders.cancel');

    });
