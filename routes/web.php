<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/produk', function () {
    return view('admin.produk.list');
})->name('admin.produk.list');

Route::get('/produk/kategori', function () {
    return view('admin.produk.kategori');
})->name('admin.produk.kategori');

Route::get('/pesanan', function () {
    return view('admin.pesanan.list');
})->name('admin.pesanan.list');
