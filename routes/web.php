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

Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/register', function () {
    return view('auth.register');
});

// Client
Route::get('/', [ClientController::class, 'index'])->name('home');
Route::get('/products', [ClientController::class, 'products']);
Route::get('/product/detail/{param:slug}', [ClientController::class, 'productDetail'])->name('product_detail');

// Admin
Route::get('/login-dbo', [DashboardController::class, 'login'])->name('admin.login');
Route::post('/post-login-dbo', [DashboardController::class, 'postLogin'])->name('admin.postLogin');
Route::post('/logout-dbo', [DashboardController::class, 'logout'])->name('admin.logout');

Route::group(['middleware' => 'auth-dbo'], function () {
    // Dashboard
    Route::get('/dbo', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/dbo/produk', [DashboardController::class, 'productList'])->name('admin.produk.list');
    Route::get('/dbo/produk/kategori', [DashboardController::class, 'categoryProduct'])->name('admin.produk.kategori');
    Route::get('/dbo/pesanan', [DashboardController::class, 'orders'])->name('admin.pesanan.list');
    Route::get('/dbo/user', [DashboardController::class, 'users'])->name('admin.user.list');
});


Route::group(['middleware' => ['auth']], function () {
    // Client
    // cart
    Route::get('/cart', [ClientController::class, 'carts']);
    Route::post('/update-quantity', [ClientController::class, 'updateQty'])->name('update.quantity');
    Route::post('/product/delete', [ClientController::class, 'destroyProduct'])->name('delete.cart');
    Route::post('/product/create', [ClientController::class, 'addToCart'])->name('create.cart');

    // orders
    Route::get('/orders', [ClientController::class, 'orders'])->name('orders');
    Route::get('/checkout', [ClientController::class, 'checkout'])->name('checkout');
    Route::post('/orders/create', [ClientController::class, 'createOrder'])->name('create.order');

    // tracking
    Route::get('/tracking-order', [ClientController::class, 'trackingOrder']);
});


Auth::routes();
