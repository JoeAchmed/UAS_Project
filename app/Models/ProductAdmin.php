<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductAdmin extends Model
{
    use HasFactory;

    protected $table = 'products';

    public $timestamps = false;

    protected $fillable = [
        "cat_id",
        "thumbnail",
        "sku", "name", "slug", "acq_price", "sell_price", "discount_price", "stock", "rating", "discount",
        "size", "weight", "manufacturer", "description"
    ];

    public static function getAllProduct()
    {
        $alldata = DB::table('products')->get();
        return $alldata;
    }

    public static function getCategoryProduct()
    {
        $alldata = DB::table('product_categories')->get();
        return $alldata;
    }
}
