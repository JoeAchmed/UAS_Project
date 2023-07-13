<?php

namespace App\Providers;

use App\Models\CartClient;
use App\Models\CartItemClient;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CartItemsComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        View::composer('client.layout.header', function ($view) {
            $cart = null;
            $cartItemsCount = 0;
            if (auth()->check()) {
                $cart = CartClient::where('user_id', auth()->user()->id)->first();
            }
            if ($cart) {
                $cartItemsCount = CartItemClient::distinct('prod_id')->where('cart_id', $cart->id)->where('status', 1)->count();
            }

            $view->with('cartItemsCount', $cartItemsCount);
        });
    }
}
