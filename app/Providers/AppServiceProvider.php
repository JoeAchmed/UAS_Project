<?php

namespace App\Providers;

use App\Models\ProductClient;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Menggunakan user di header -> global usage
        $options = [
            'user' => auth()->user(),
            'categories' => ProductClient::getCategoryProduct(), // Mendapatkan semua kategori
        ];
        
        View::composer('*', function ($view) use ($options) {
            $view->with($options);
        });
    }
}
