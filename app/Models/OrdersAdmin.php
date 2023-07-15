<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrdersAdmin extends Model
{
    use HasFactory;

    protected $table = 'orders';

    public $timestamps = false;

    // tentuin kolom2 yang bisa diisi
    protected $fillable = [
        "user_id",
        "shipping_method",
        "shipping_price",
        "payment_method",
        "status",
        "invoice",
        "created_at",
    ];

    public static function getOrders() {
        $alldata = DB::table('orders')->get();

        return $alldata;
    }

    public static function getTotalSales() {
        $total = DB::table('orders')->sum('shipping_price');
        return $total;
    }    
}
