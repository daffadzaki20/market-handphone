<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
use App\Models\Product;

// HOME (LANGSUNG KE LOGIN)
Route::get('/', function () {
    return redirect('/login');
});
Route::middleware('guest')->group(function () {
    // REGISTER
    Route::get('/register', [AuthController::class, 'registerForm']);
    Route::post('/register', [AuthController::class, 'register']);
    
    // LOGIN
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function (){

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

        // 3. Gabungkan Tanggal, Bulan, Tahun menjadi format YYYY-MM-DD
        if ($request->dob_year && $request->dob_month && $request->dob_day) {
            $bulan = str_pad($request->dob_month, 2, '0', STR_PAD_LEFT); // Ubah 7 jadi 07
            $hari = str_pad($request->dob_day, 2, '0', STR_PAD_LEFT);    // Ubah 6 jadi 06
            $user->date_of_birth = $request->dob_year . '-' . $bulan . '-' . $hari;
        }

        // 4. Simpan ke Database
        $user->save();

        // 5. Kembali ke halaman profil bawa pesan sukses
        return back()->with('success', 'Profil berhasil diperbarui!');
    });

    // LOGOUT
    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/login');
    });
    
    // PROFIL KITA
    Route::get('/profile', function () {
        return view('profile.index');
    });

    Route::get('/profile/bank', function () {
        return view('profile.bank');
    });

    Route::get('/profile/alamat', function () {
        return view('profile.alamat');
    });

    // 👇 TAMBAHKAN RUTE UPLOAD FOTO DI SINI 👇
     Route::post('/profile/photo', function (Request $request) {
        // 1. Validasi file (harus gambar, max 2MB)
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();

        // 2. Jika user sudah punya foto lama, hapus dulu dari storage agar tidak menumpuk
        if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        // 3. Simpan foto baru ke folder: storage/app/public/profile_photos
        $path = $request->file('profile_photo')->store('profile_photos', 'public');

        // 4. Update nama file di database user
        $user->profile_photo = $path;
        $user->save();

        // 5. Kembalikan ke halaman profil
        return back();
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
});