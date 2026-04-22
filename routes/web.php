<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Landing Page
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('landing'); // nanti kita buat
});

/*
|--------------------------------------------------------------------------
| Halaman Produk
|--------------------------------------------------------------------------
*/
Route::get('/home', [ProductController::class, 'index']);
Route::get('/product/{id}', [ProductController::class, 'show']);
use Illuminate\Support\Facades\Session;

Route::get('/cart', function () {
    $cart = session()->get('cart', []);
    return view('cart', compact('cart'));
});

Route::get('/cart/add/{id}', function ($id) {
    $product = \App\Models\Product::findOrFail($id);

    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $cart[$id]['quantity']++;
    } else {
        $cart[$id] = [
            "name" => $product->name,
            "price" => $product->price,
            "image" => $product->image,
            "quantity" => 1
        ];
    }

    session()->put('cart', $cart);

    return redirect()->back();
});

Route::get('/cart/increase/{id}', function ($id) {
    $cart = session()->get('cart');

    if (isset($cart[$id])) {
        $cart[$id]['quantity']++;
        session()->put('cart', $cart);
    }

    return redirect()->back();
});

Route::get('/cart/decrease/{id}', function ($id) {
    $cart = session()->get('cart');

    if (isset($cart[$id])) {
        $cart[$id]['quantity']--;

        if ($cart[$id]['quantity'] <= 0) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);
    }

    return redirect()->back();
});

Route::get('/cart/remove/{id}', function ($id) {
    $cart = session()->get('cart');

    unset($cart[$id]);

    session()->put('cart', $cart);

    return redirect()->back();
});

/*
|--------------------------------------------------------------------------
| Dashboard (redirect aja biar gak kepake)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return redirect('/');
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile (biarin aja)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});

/*
|--------------------------------------------------------------------------
| Auth routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';