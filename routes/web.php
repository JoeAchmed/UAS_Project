<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
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

// Client
Route::get('/', [ClientController::class, 'index']);
Route::get('/cart', [ClientController::class, 'cart']);
Route::get('/checkout', [ClientController::class, 'checkout']);
Route::get('/products', [ClientController::class, 'products']);
Route::get('/product/detail', [ClientController::class, 'productDetail']);

// auth
Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::group(['middleware' => ['auth']], function () {
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // // Buat Routing Produk
    // Route::get('/produk', [ProdukController::class, 'index']);
    // Route::get('/produk/create', [ProdukController::class, 'create']);
    // Route::post('/produk/store', [ProdukController::class, 'store']);
    // Route::get('produk/edit/{id}', [ProdukController::class, 'edit']);
    // Route::put('/produk/update/{id}', [ProdukController::class, 'update']);
    // Route::get('/produk/delete/{id}', [ProdukController::class, 'destroy']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/dashboard/produk', [DashboardController::class, 'productList'])->name('admin.produk.list');
    Route::get('/dashboard/produk/kategori', [DashboardController::class, 'categoryProduct'])->name('admin.produk.kategori');
    Route::get('/dashboard/pesanan', [DashboardController::class, 'orders'])->name('admin.pesanan.list');
    Route::get('/dashboard/user', [DashboardController::class, 'users'])->name('admin.user.list');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
