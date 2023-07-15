<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CartItemClient extends Model
{
    use HasFactory;

    protected $table = 'cart_items';

    public $timestamps = false;

    protected $fillable = [
        "cart_id",
        "prod_id",
        "quantity",
        "price",
    ];

    public function products() {
        return $this->belongsTo(ProductClient::class);
    }

    public static function getCartItems($cart_id)
    {
        $alldata = DB::table('cart_items')
        ->join('products', 'cart_items.prod_id', '=', 'products.id')
        ->select('products.*', 'cart_items.*')
        ->where('cart_items.cart_id', '=', $cart_id)
        ->get();
        return $alldata;
    }
}
