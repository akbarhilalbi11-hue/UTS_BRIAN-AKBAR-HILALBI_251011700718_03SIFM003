<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ElectronicController;
use App\Http\Controllers\CartController;

// Halaman Beranda (Route Statis)
Route::get('/', function () {
    return view('home');
})->name('home');

// Halaman Tentang Kami (Route Statis)
Route::get('/about', function () {
    return view('about');
})->name('about');

// Halaman Katalog (Dipindah ke URL /katalog)
Route::get('/katalog', [ElectronicController::class, 'index'])->name('electronics.index');

// Halaman Detail Produk
Route::get('/katalog/{id}', [ElectronicController::class, 'show'])->name('electronics.show');


// Halaman Keranjang Belanja
Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
Route::post('/keranjang/tambah/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/keranjang/hapus/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Routes untuk Fitur Checkout
Route::get('/checkout', [CartController::class, 'checkoutForm'])->name('cart.checkout');
Route::post('/checkout/proses', [CartController::class, 'processCheckout'])->name('cart.process');
Route::get('/checkout/sukses', [CartController::class, 'success'])->name('cart.success');

// Routes untuk Fitur Checkout
Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::get('/checkout/sukses', [CartController::class, 'success'])->name('cart.success');

// Routes untuk Fitur Checkout
Route::get('/checkout', [CartController::class, 'checkoutForm'])->name('cart.checkout');
Route::post('/checkout/proses', [CartController::class, 'processCheckout'])->name('cart.process');
Route::get('/checkout/validasi', [CartController::class, 'processing'])->name('cart.processing'); // Route Baru
Route::get('/checkout/sukses', [CartController::class, 'success'])->name('cart.success');