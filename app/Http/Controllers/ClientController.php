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
    public function trackingOrder()
    {
        // menampilkan page cart ecommerce
        return view('client.tracking-order');
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
     * Display a listing group of the resource products.
     */
    public function products(Request $request)
    {
        $cat_id = $request->query('cat_id');
        // Menggabungkan tabel products dengan product_categories menggunakan join
        $produk = ProductClient::join('product_categories', 'products.cat_id', '=', 'product_categories.id')
            ->select('products.*', 'product_categories.name AS category_name')
            ->get();

        if ($cat_id) {
            $produk = ProductClient::join('product_categories', 'products.cat_id', '=', 'product_categories.id')
            ->select('products.*', 'product_categories.name AS category_name')
            ->where('cat_id', $cat_id)
            ->get();
        }

        return view('client.products', compact('produk'));
    }

    // Display the specified resource product detail.
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
     * Display a listing group of the carts.
     */
    public function carts(Request $request)
    {
        $cart_item = CartClient::getUserCart(auth()->user()->id);
        // menampilkan page pesanan admin
        $list_cart = CartItemClient::getCartItems($cart_item->id)->where('status', 1);

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

        return view('client.cart', compact(['list_cart', 'subtotal', 'cart_item']));
    }

    public function updateQty(Request $request)
    {
        // Ambil data dari permintaan Ajax
        $action = $request->input('action');
        $cart_item_id = $request->input('cart_item_id');
        $order_id = $request->input('order_id');
        $qty = $request->input('qty');

        $orders = CartItemClient::find($order_id);
        $list_cart = CartItemClient::getCartItems($cart_item_id)->where('status', 1);
        $product = ProductClient::find($orders->prod_id);
        $orders->quantity = $qty;
        $price = 0;

        if ($product) {
            if ($product->discount) {
                $price = $product->discount_price;
            } else {
                $price = $product->sell_price;
            }
        }

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

        $orders->save();

        return response()->json(['success' => true, 'response' => [
            'action' => $action,
            'cart_item_id' => $cart_item_id,
            'order_id' => $order_id,
            'qty' => $qty,
            'orders' => $orders,
            'price' => $price,
            'subtotal' => $subtotal,
        ]]);
    }

    public function addToCart(Request $request)
    {
        // menampilkan page pesanan admin
        $orders = new CartItemClient();
        $carts = CartClient::getUserCart(auth()->user()->id);
        $prod_id = $request->prod_id;
        $exist_product = CartItemClient::where('prod_id', $prod_id)->where('cart_id', $carts->id)->first();

        if ($exist_product) {
            $exist_product->quantity += 1;
            $exist_product->status = 1;
            $exist_product->save();
        } else {
            $orders->prod_id = $prod_id;
            $orders->cart_id = $carts->id;
            $orders->quantity = 1;
            $orders->status = 1;
            $orders->save();
        }

        return redirect('cart')->with('success', 'Produk berhasil ditambahkan');
    }

    public function destroyProduct(Request $request)
    {
        // 
        $id = $request->id;
        $cart_items = CartItemClient::find($id);
        $cart_items->status = 0;
        $cart_items->quantity = 0;
        $cart_items->save();

        return redirect('cart')->with('success', 'Produk berhasil dihapus');
    }

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
}
