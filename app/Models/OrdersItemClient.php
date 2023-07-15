<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrdersItemClient extends Model
{
    use HasFactory;

    protected $table = 'order_items';

    public $timestamps = false;

    // tentuin kolom2 yang bisa diisi
    protected $fillable = [
        "order_id",
        "cart_item_id",
        "quantity",
        "price",
        "created_at",
    ];

    public static function getOrderItems() {
        $alldata = DB::table('order_items')->get();

        return $alldata;
    }

}
