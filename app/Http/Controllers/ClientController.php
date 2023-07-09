<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource home.
     */
    public function index()
    {
        // menampilkan page home ecommerce
        return view('client.home');
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
        // menampilkan page products ecommerce
        return view('client.products');
    }

    /**
     * Display a listing of the resource product detail.
     */
    public function productDetail()
    {
        // menampilkan page detail product ecommerce
        return view('client.product-detail');
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
