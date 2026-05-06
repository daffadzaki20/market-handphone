<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage; // 🔥 DITAMBAHKAN UNTUK UPLOAD FOTO
use Illuminate\Http\Request;

// Controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;


// Models
use App\Models\Brand;
use App\Models\Product;
use App\Models\User;

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
| GUEST ROUTES (Belum Login)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    // REGISTER 🔥 (Ditambahkan ->name('register') agar error Route Not Defined hilang)
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    
    // LOGIN
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Jika kamu pakai fitur Forgot Password bawaan Breeze, biarkan Laravel memanggil auth.php
    // require __DIR__.'/auth.php'; 
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (Sudah Login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // LOGOUT 🔥 (Diubah jadi POST agar sinkron dengan form Sidebar dan bebas error 405)
    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    })->name('logout');


    // ----------------------------------------------------------------------
    // PROFIL KITA
    // ----------------------------------------------------------------------
    Route::get('/profile', function () {
        return view('profile.index');
    })->name('profile');

    Route::post('/profile/update', function (Request $request) {
        $user = Auth::user();

        // 1. Validasi Input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => 'nullable|string|max:15',
            'gender' => 'nullable|in:Laki-laki,Perempuan,Lainnya',
        ]);

        // 2. Update Data User
        $user->name = $request->name;
        $user->email = $request->email;
        
        if ($request->phone_number) {
            $user->phone_number = $request->phone_number;
        }
        if ($request->gender) {
            $user->gender = $request->gender;
        }

        // 3. Gabungkan Tanggal, Bulan, Tahun
        if ($request->dob_year && $request->dob_month && $request->dob_day) {
            $bulan = str_pad($request->dob_month, 2, '0', STR_PAD_LEFT);
            $hari = str_pad($request->dob_day, 2, '0', STR_PAD_LEFT);
            $user->date_of_birth = $request->dob_year . '-' . $bulan . '-' . $hari;
        }

        $user->save();
        return back()->with('success', 'Profil berhasil diperbarui!');
    });

    // UPLOAD FOTO PROFIL
    Route::post('/profile/photo', function (Request $request) {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();

        if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        $path = $request->file('profile_photo')->store('profile_photos', 'public');
        $user->profile_photo = $path;
        $user->save();

        return back();
    });

    // MENU PROFIL LAINNYA
    Route::get('/profile/bank', function () { return view('profile.bank'); });
    Route::get('/profile/pesanan', function () { return view('profile.pesanan'); });
    Route::get('/profile/notifikasi', function () { return view('profile.notifikasi'); });
    Route::get('/profile/voucher', function () { return view('profile.voucher'); });

    // ALAMAT
    Route::get('/profile/alamat', [AlamatController::class, 'index'])->name('alamat.index');
    Route::post('/profile/alamat', [AlamatController::class, 'store'])->name('alamat.store');
    Route::delete('/profile/alamat/{id}', [AlamatController::class, 'destroy'])->name('alamat.destroy');
    Route::put('/profile/alamat/{id}', [AlamatController::class, 'update'])->name('alamat.update');

    // UBAH PASSWORD
    Route::get('/profile/password', function () { return view('profile.password'); });
    Route::post('/profile/password', function (Request $request) {
        $request->validate([
            'current_password' => ['required', 'current_password'], 
            'password' => ['required', 'min:8'], 
        ]);
        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);
        return back()->with('success', 'Password Anda berhasil diperbarui!');
    });

    // ----------------------------------------------------------------------
// DASHBOARD USER (LANDING PAGE)
// ----------------------------------------------------------------------
// Menambahkan middleware 'auth' agar user yang belum login dipaksa ke halaman login
Route::get('/dashboard', function () {
    $user = Auth::user();

    // 1. Cek Role: Jika admin mencoba masuk ke dashboard user, lempar ke halaman admin
    if ($user->role == 'admin') {
        return redirect('/admin');
    }

    // 2. Ambil data produk untuk ditampilkan di landing page dashboard user
    $products = Product::with('brand')->get();

    return view('dashboard', compact('products'));
})->middleware(['auth'])->name('dashboard');
    

    // ----------------------------------------------------------------------
    // TRANSAKSI & KERANJANG
    // ----------------------------------------------------------------------
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'store']);
    Route::delete('/cart/remove/{id}', [CartController::class, 'destroy']);
    Route::patch('/cart/update/{id}', [CartController::class, 'update']);
    Route::delete('/cart/bulk-delete', [CartController::class, 'bulkDelete']);
    
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');


    // ----------------------------------------------------------------------
    // HALAMAN PRODUK
    Route::get('/products/handphone', [ProductController::class, 'handphoneIndex'])->name('handphone.index');
    Route::get('/products/aksesoris', [ProductController::class, 'aksesorisIndex'])->name('aksesoris.index');

    Route::get('/product/{id}', function ($id) {
        $product = Product::with('brand')->findOrFail($id);
        $brandType = $product->brand?->type ?? null;
        return view('products.detail', compact('product', 'brandType'));
});

    Route::get('/test', function () {
        return Product::with('brand')->get();
    });

    // ----------------------------------------------------------------------
    // ADMIN PAGE
    // ----------------------------------------------------------------------
    Route::get('/admin', function () {
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

        $lowStockProducts = Product::with('brand')->where('stock', '<=', 5)->orderBy('stock')->limit(5)->get();
        $latestProducts = Product::with('brand')->latest()->limit(6)->get();

        return view('admin', compact(
            'totalProducts', 'totalBrands', 'totalUsers', 'handphoneCount',
            'accessoriesCount', 'totalInventoryValue', 'lowStockProducts', 'latestProducts'
        ));
    })->name('admin.dashboard');

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

    // Proses checkout
    Route::post('/checkout/process', [OrderController::class, 'process'])->name('checkout.process');

    // Halaman sukses setelah order
    Route::get('/order/success/{id}', [OrderController::class, 'success'])->name('order.success');

});

// Jika kamu menggunakan route tambahan dari Breeze (seperti Lupa Password), aktifkan baris di bawah ini:
require __DIR__.'/auth.php';