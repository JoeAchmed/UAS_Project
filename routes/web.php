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

Route::group(['middleware' => 'auth-dbo:admin-manager'], function () {
    // Dashboard
    Route::get('/dbo', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/dbo/user/pelanggan', [DashboardController::class, 'usersCustomer'])->name('admin.user.customer');
    Route::get('/dbo/user/admin', [DashboardController::class, 'usersAdmin'])->name('admin.user.admin');

    // Produk
    Route::get('/dbo/produk', [DashboardController::class, 'products'])->name('admin.produk.list');
    // Kategori Produk
    Route::get('/dbo/produk/kategori', [DashboardController::class, 'categories'])->name('admin.produk.kategori.list');
    Route::get('/dbo/produk/tambah-kategori', [DashboardController::class, 'category_add'])->name('admin.produk.kategori.add');
    Route::get('/dbo/produk/ubah-kategori/{params:id}', [DashboardController::class, 'category_edit'])->name('admin.produk.kategori.edit');
    Route::post('/dbo/produk/hapus-kategori', [DashboardController::class, 'category_delete'])->name('admin.produk.kategori.delete');

    Route::post('/dbo/produk/tambah-kategori', [DashboardController::class, 'category_add'])->name('admin.produk.kategori.add');
    Route::post('/dbo/produk/update-kategori', [DashboardController::class, 'category_update'])->name('admin.produk.kategori.update');

    Route::get('/dbo/pesanan', [DashboardController::class, 'orders'])->name('admin.pesanan.list');
    Route::get('/dbo/pesanan/ubah-pesanan/{params:id}', [DashboardController::class, 'orders_edit'])->name('admin.pesanan.edit');
    Route::post('/dbo/produk/ubah-pesanan', [DashboardController::class, 'update_status_order'])->name('admin.pesanan.ubah_status');
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
    Route::get('/success', [ClientController::class, 'orders'])->name('success');
    Route::get('/checkout', [ClientController::class, 'checkout'])->name('checkout');
    Route::post('/orders/create', [ClientController::class, 'createOrder'])->name('create.order');

    // tracking
    Route::get('/tracking-order', [ClientController::class, 'trackingOrder']);
});


Auth::routes();
