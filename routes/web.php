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
Route::get('/products', [ClientController::class, 'products']);
Route::get('/product/detail/{param:slug}', [ClientController::class, 'productDetail'])->name('product_detail');

// auth
Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/login-dbo', [DashboardController::class, 'login']);
Route::post('/post-login-dbo', [DashboardController::class, 'postLogin']);

Route::get('/register', function () {
    return view('auth.register');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // Dashboard
    Route::get('/dbo', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/dbo/produk', [DashboardController::class, 'productList'])->name('admin.produk.list');
    Route::get('/dbo/produk/kategori', [DashboardController::class, 'categoryProduct'])->name('admin.produk.kategori');
    Route::get('/dbo/pesanan', [DashboardController::class, 'orders'])->name('admin.pesanan.list');
    Route::get('/dbo/user', [DashboardController::class, 'users'])->name('admin.user.list');
    // Client
    Route::get('/cart', [ClientController::class, 'carts']);
    Route::get('/checkout', [ClientController::class, 'checkout']);
    Route::get('/tracking-order', [ClientController::class, 'trackingOrder']);
    Route::post('/update-quantity', [ClientController::class, 'updateQty'])->name('update.quantity');
    Route::post('/product/delete', [ClientController::class, 'destroyProduct'])->name('delete.order');
    Route::post('/product/create', [ClientController::class, 'addToCart'])->name('create.order');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
