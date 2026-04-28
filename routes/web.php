<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Models\Product;

// HOME (LANGSUNG KE LOGIN)
Route::get('/', function () {
    return redirect('/login');
});

// REGISTER
Route::get('/register', [AuthController::class, 'registerForm']);
Route::post('/register', [AuthController::class, 'register']);

// LOGIN
Route::get('/login', [AuthController::class, 'loginForm']);
Route::post('/login', [AuthController::class, 'login']);

// LOGOUT
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
});



/*
|--------------------------------------------------------------------------
| DASHBOARD USER (LANDING PAGE)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    if (!Auth::check()) {
        return redirect('/login');
    }

    if (Auth::user()->role == 'admin') {
        return redirect('/admin');
    }

    // 🔥 ambil semua produk untuk ditampilkan di dashboard
    $products = Product::with('brand')->get();

    return view('dashboard', compact('products'));
});



/*
|--------------------------------------------------------------------------
| HALAMAN PRODUK (KATEGORI MARKETPLACE)
|--------------------------------------------------------------------------
*/

// 📱 HANDPHONE
Route::get('/products/handphone', function () {

    $query = App\Models\Product::with('brand')
        ->where('type', 'hp');

    // 🔍 SEARCH
    if (request('search')) {
        $query->where('name', 'like', '%' . request('search') . '%');
    }

    // 🏷️ FILTER BRAND
    if (request('brand')) {
        $query->whereHas('brand', function ($q) {
            $q->where('name', request('brand'));
        });
    }

    $products = $query->get();

    return view('products.handphone', compact('products'));
});

// 🎧 AKSESORIS
Route::get('/products/aksesoris', function () {

    $products = Product::with('brand')
        ->where('type', 'aksesoris')
        ->get();

    return view('products.aksesoris', compact('products'));
});



/*
|--------------------------------------------------------------------------
| ADMIN PAGE
|--------------------------------------------------------------------------
*/

Route::get('/admin', function () {

    if (!Auth::check()) {
        return redirect('/login');
    }

    if (Auth::user()->role != 'admin') {
        return redirect('/dashboard');
    }

    return view('admin');
});



/*
|--------------------------------------------------------------------------
| TEST RELASI PRODUCT + BRAND
|--------------------------------------------------------------------------
*/

Route::get('/test', function () {
    return Product::with('brand')->get();
});



/*
|--------------------------------------------------------------------------
| CRUD PRODUCTS
|--------------------------------------------------------------------------
*/

// lihat semua produk
Route::get('/products', [ProductController::class, 'index']);

// form tambah produk
Route::get('/products/create', [ProductController::class, 'create']);

// simpan produk
Route::post('/products', [ProductController::class, 'store']);

Route::get('/product/{id}', function ($id) {

    $product = Product::with('brand')->findOrFail($id);

    return view('products.detail', compact('product'));

});