<?php

namespace App\Http\Controllers;

use App\Models\CartClient;
use App\Models\CartItemClient;
use App\Models\OrdersClient;
use App\Models\OrdersItemClient;
use App\Models\ProductClient;
use App\Models\ProductColor;
use App\Models\ProductImages;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

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
        $products = ProductClient::join('product_categories', 'products.cat_id', '=', 'product_categories.id')
            ->select('products.*', 'product_categories.name AS category_name')
            ->get();
        $product = ProductClient::where('slug', $param->slug)->first();

        if ($product) {
            $product_images = ProductImages::where('prod_id', $product->id)->get();
            $product_colors = ProductColor::where('prod_id', $product->id)->get();

            // Rest of your code
        } else {
            // Handle jika produk tidak ditemukan
            abort(404, 'Product not found');
        }

        return view('client.product-detail', compact(['product', 'product_images', 'product_colors', 'products']));
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
        $cart_items = new CartItemClient();
        $carts = CartClient::getUserCart(auth()->user()->id);
        $prod_id = $request->prod_id;
        $qty = 1;
        $exist_product = CartItemClient::where('prod_id', $prod_id)->where('cart_id', $carts->id)->first();

        if ($request->qty) {
            $qty = $request->qty;
        } else {
            $qty = 1;
        }

        if ($exist_product) {
            $exist_product->quantity += $qty;
            $exist_product->status = 1;
            $exist_product->save();
        } else {
            $cart_items->prod_id = $prod_id;
            $cart_items->cart_id = $carts->id;
            $cart_items->quantity = $qty;
            $cart_items->status = 1;
            $cart_items->save();
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

    function generateInvoiceNumber()
    {
        $orders = new OrdersClient();

        // Tentukan format nomor invoice
        $format = 'INV{Y}{m}{num}';

        // Ambil informasi tanggal
        $year = date('Y');
        $month = date('m');

        // Ambil ID order terakhir
        $lastOrder = $orders->orderBy('id', 'desc')->first();
        $lastNumber = $lastOrder ? $lastOrder->id : 0;

        // Tingkatkan nomor urut
        $newNumber = $lastNumber + 1;

        // Buat nomor invoice
        $invoiceNumber = str_replace(['{Y}', '{m}', '{num}'], [$year, $month, $newNumber], $format);

        return $invoiceNumber;
    }

    /**
     * Display a listing group of the resource orders.
     */
    public function orders(Request $request)
    {
        $order_items = OrdersItemClient::join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('products', 'order_items.prod_id', '=', 'products.id')
            ->join('product_categories', 'products.cat_id', '=', 'product_categories.id')
            ->select('order_items.*', 'products.name', 'products.sell_price', 'products.discount_price', 'products.discount', 'products.thumbnail', 'product_categories.name AS category_name', 'orders.*')
            ->where('orders.user_id', auth()->user()->id)
            ->get();
        $orders = OrdersClient::where('user_id', auth()->user()->id)->get();

        return view('client.orders', compact('orders'));
    }

    public function checkout(Request $request)
    {
        $cart = CartClient::getUserCart(auth()->user()->id);
        $cart_items = CartItemClient::getCartItems($cart->id)->where('status', 1);
        $cart_id = $cart->id;
        $subtotal = 0; // Initialize $subtotal variable

        if (!count($cart_items)) return redirect('cart')->with('success', 'Silakan Checkout Cart Terlebih Dahulu');

        foreach ($cart_items as $item) {
            // Calculate subtotal
            if ($item->quantity) {
                if ($item->discount) {
                    $subtotal += $item->discount_price * $item->quantity;
                } else {
                    $subtotal += $item->sell_price * $item->quantity;
                }
            }
        }
        return view('client.checkout', compact(['cart_items', 'subtotal', 'cart_id']));
    }

    /**
     * Display a listing group of the resource orders.
     */
    public function createOrder(Request $request)
    {
        $order = new OrdersClient();

        $shipping_method = $request->shipping_method;
        $shipping_price = $request->shipping_price;
        $payment_method = $request->payment_method;
        $invoice = $this->generateInvoiceNumber();
        $status = "inprogress";

        $order->user_id = auth()->user()->id;
        $order->shipping_method = $shipping_method;
        $order->shipping_price = $shipping_price;
        $order->payment_method = $payment_method;
        $order->status = $status;
        $order->invoice = $invoice;

        $order->save();

        //  Panggil metode createOrderItems
        $cart_item = CartClient::getUserCart(auth()->user()->id);
        // menampilkan page pesanan admin
        $list_cart = CartItemClient::getCartItems($cart_item->id)->where('status', 1);

        foreach ($list_cart as $item) :
            $order_items = new OrdersItemClient();

            $order_items->order_id = $order->id;
            $order_items->prod_id = $item->prod_id;
            $order_items->quantity = $item->quantity;
            if ($item->discount) {
                $order_items->price = $item->discount_price * $item->quantity;
            } else {
                $order_items->price = $item->sell_price * $item->quantity;
            }
            $order_items->created_at = date('Y-m-d H:i:s');
            $order_items->save();

            $data = ProductClient::where('id', $item->prod_id)->first();
            $data->stock -= $item->quantity;
            $data->save();

            $cart_items = CartItemClient::find($item->id);

            $cart_items->quantity = 0;
            $cart_items->status = 0;
            $cart_items->save();
        endforeach;

        return redirect('success');
    }

    public function tracking(Request $request)
    {
        try {
            // $orders = OrdersClient::where('invoice', $request->invoice)->result();

            // $order_items = OrdersItemClient::join('orders', 'order_items.order_id', '=', 'orders.id')
            //     ->join('products', 'order_items.prod_id', '=', 'products.id')
            //     ->join('product_categories', 'products.cat_id', '=', 'product_categories.id')
            //     ->select('order_items.*', 'products.name', 'products.sell_price', 'products.discount_price', 'products.discount', 'products.thumbnail', 'product_categories.name AS category_name', 'orders.*')
            //     ->where('orders.user_id', auth()->user()->id)
            //     ->where('orders.invoice', $request->invoice)
            //     ->get();
            $orders = OrdersClient::where('invoice', $request->invoice)->get();

            // dd($orders);

            // return redirect()->route('tracking-order', compact('orders'));
            return view('client.tracking-order', compact('orders'));
        } catch (Exception $e) {
            return response()->json(['err' => $e]);
        }
    }
}
