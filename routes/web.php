<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ProductController;
use App\Models\Brand;
use App\Models\Product;
use App\Models\User;

// HOME (LANGSUNG KE LOGIN)
Route::get('/', function () {
    return redirect('/login');
});
Route::middleware('guest')->group(function () {
    // REGISTER
    Route::get('/register', [AuthController::class, 'registerForm']);
    Route::post('/register', [AuthController::class, 'register']);
    
    // LOGIN
    Route::get('/login', [AuthController::class, 'loginForm']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function (){

    // LOGOUT
    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/login');
    });
    
    Route::get('/profile', function () {
    return view('profile.index');
})->middleware('auth');
    
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

    Route::get('/cart', function () {
        return view('cart.index');
    });
    
    
    
    /*
    |--------------------------------------------------------------------------
    | HALAMAN PRODUK (KATEGORI MARKETPLACE)
    |--------------------------------------------------------------------------
    */
    
    // 📱 HANDPHONE
    Route::get('/products/handphone', [ProductController::class, 'handphoneIndex']);
    
    // 🎧 AKSESORIS
    Route::get('/products/aksesoris', [ProductController::class, 'aksesorisIndex']);
    
    
    
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
    
        $totalProducts = Product::query()->count('id');
        $totalBrands = Brand::query()->count('id');
        $totalUsers = User::query()->count('id');
        $handphoneCount = Product::query()->whereHas('brand', function ($b) {
            $b->where('type', 'hp');
        })->count('id');
        $accessoriesCount = Product::query()->whereHas('brand', function ($b) {
            $b->where('type', 'aksesoris');
        })->count('id');
        $totalInventoryValue = Product::query()->selectRaw('COALESCE(SUM(price * stock), 0) as total', [])->value('total');

        $lowStockProducts = Product::with('brand')
            ->where('stock', '<=', 5)
            ->orderBy('stock')
            ->limit(5)
            ->get();

        $latestProducts = Product::with('brand')
            ->latest()
            ->limit(6)
            ->get();

        return view('admin', compact(
            'totalProducts',
            'totalBrands',
            'totalUsers',
            'handphoneCount',
            'accessoriesCount',
            'totalInventoryValue',
            'lowStockProducts',
            'latestProducts'
        ));
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
    
    // ADMIN CRUD HANDPHONE
    Route::get('/admin/handphones', [ProductController::class, 'adminHandphoneIndex']);
    Route::get('/admin/handphones/create', [ProductController::class, 'adminHandphoneCreate']);
    Route::post('/admin/handphones', [ProductController::class, 'adminHandphoneStore']);
    Route::get('/admin/handphones/{id}', [ProductController::class, 'adminHandphoneShow']);
    Route::get('/admin/handphones/{id}/edit', [ProductController::class, 'adminHandphoneEdit']);
    Route::put('/admin/handphones/{id}', [ProductController::class, 'adminHandphoneUpdate']);
    Route::delete('/admin/handphones/{id}', [ProductController::class, 'adminHandphoneDestroy']);

    // ADMIN CRUD AKSESORIS
    Route::get('/admin/aksesoris', [ProductController::class, 'adminAksesorisIndex']);
    Route::get('/admin/aksesoris/create', [ProductController::class, 'adminAksesorisCreate']);
    Route::post('/admin/aksesoris', [ProductController::class, 'adminAksesorisStore']);
    Route::get('/admin/aksesoris/{id}', [ProductController::class, 'adminAksesorisShow']);
    Route::get('/admin/aksesoris/{id}/edit', [ProductController::class, 'adminAksesorisEdit']);
    Route::put('/admin/aksesoris/{id}', [ProductController::class, 'adminAksesorisUpdate']);
    Route::delete('/admin/aksesoris/{id}', [ProductController::class, 'adminAksesorisDestroy']);

    // ADMIN CRUD USERS
    Route::get('/admin/users', [AdminUserController::class, 'index']);
    Route::get('/admin/users/create', [AdminUserController::class, 'create']);
    Route::post('/admin/users', [AdminUserController::class, 'store']);
    Route::get('/admin/users/{id}/edit', [AdminUserController::class, 'edit']);
    Route::put('/admin/users/{id}', [AdminUserController::class, 'update']);
    Route::delete('/admin/users/{id}', [AdminUserController::class, 'destroy']);
    
    Route::get('/product/{id}', function ($id) {
    
        $product = Product::with('brand')->findOrFail($id);
        $brandType = $product->brand?->type ?? null;
        // dd($brandType);
        return view('products.detail', compact('product', 'brandType'));
    
    });
});