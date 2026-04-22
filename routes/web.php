<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;



Route::get('/', [ProductController::class, 'index']);

Route::get('/product/{id}', [ProductController::class, 'show']);

Route::post('/cart/add/{id}', [CartController::class, 'add']);
Route::get('/cart', [CartController::class, 'index']);

Route::get('/cart/increase/{id}', [CartController::class, 'increase']);
Route::get('/cart/decrease/{id}', [CartController::class, 'decrease']);
Route::get('/cart/remove/{id}', [CartController::class, 'remove']);

Route::get('/checkout', [CheckoutController::class, 'index']);
Route::post('/checkout', [CheckoutController::class, 'process']);