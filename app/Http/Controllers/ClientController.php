<?php

namespace App\Http\Controllers;

use App\Models\CartClient;
use App\Models\CartItemClient;
use App\Models\ProductClient;
use App\Models\ProductColor;
use App\Models\ProductImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

$user = Auth::user();
class ClientController extends Controller
{
    /**
     * Display a listing of the resource home.
     */
    public function index()
    {
        // Menggabungkan tabel products dengan product_categories menggunakan join
        $produk = ProductClient::join('product_categories', 'products.cat_id', '=', 'product_categories.id')
            ->select('products.*', 'product_categories.name AS category_name')
            ->get();

        return view('client.home', compact('produk'));
    }

    /**
     * Display a listing of the resource cart.
     */
    public function cart()
    {
        // menampilkan page cart ecommerce
        return view('client.cart');
    }

    /**
     * Display a listing of the resource checkouts.
     */
    public function checkout()
    {
        // menampilkan page checkout ecommerce
        return view('client.checkout');
    }

    /**
     * Display a listing of the resource products.
     */
    public function products()
    {
        // Menggabungkan tabel products dengan product_categories menggunakan join
        $produk = ProductClient::join('product_categories', 'products.cat_id', '=', 'product_categories.id')
            ->select('products.*', 'product_categories.name AS category_name')
            ->get();

        return view('client.products', compact('produk'));
    }

    /**
     * Display the specified resource product detail.
     */
    public function productDetail(Request $request, ProductClient $param)
    {
        // Mendapatkan detail produk berdasarkan SKU
        $product = ProductClient::where('slug', $param->slug)->first();

        if ($product) {
            $product_images = ProductImages::where('prod_id', $product->id)->get();
            $product_colors = ProductColor::where('prod_id', $product->id)->get();

            // Rest of your code
        } else {
            // Handle jika produk tidak ditemukan
            abort(404, 'Product not found');
        }

        return view('client.product-detail', compact(['product', 'product_images', 'product_colors']));
    }

    /**
     * Display a listing of the resource.
     */
    public function carts(Request $request)
    {
        $cart_item = CartClient::getUserCart(auth()->user()->id);
        // menampilkan page pesanan admin
        $list_cart = CartItemClient::getCartItems($cart_item->id);

        // Menampilkan page cart ecommerce
        $subtotal = 0; // Initialize $subtotal variable

        if ($list_cart) {
            foreach ($list_cart as $item) {
                // Calculate subtotal
                if ($item->quantity) {
                    if ($item->discount) {
                        $subtotal += $item->discount_price * $item->quantity;
                    } else {
                        $subtotal += $item->sell_price * $item->quantity;
                    }
                }
            }
        }

        return view('client.cart', compact(['list_cart', 'subtotal']));
    }

    public function updateQty(Request $request)
    {
        // Ambil data dari permintaan Ajax
        $quantity = $request->input('quantity');


        // Lakukan validasi atau manipulasi data sesuai kebutuhan

        // Contoh: Simpan data quantity ke database
        // Item::where('id', $itemId)->update(['quantity' => $quantity]);

        // Kirim response berupa JSON
        return response()->json(['success' => true, 'quantity' => $quantity]);
    }

    // public function addToCart(Request $request, CartItemClient $param)
    // {
    //     // menampilkan page pesanan admin
    //     $list_cart = CartItemClient::where('cart_id', $param->cart_id);

    //     return view('client.cart', compact('list_cart'));
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
