<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductClient extends Model
{
    use HasFactory;

    protected $table = 'products';

    public $timestamps = false;

    // tentuin kolom2 yang bisa diisi
    protected $fillable = [
        "cat_id",
        "thumbnail",
        "sku", "name", "slug", "acq_price", "sell_price", "discount_price", "stock", "rating", "discount",
        "size", "weight", "manufacturer", "description"
    ];

    // Buat fungsi untuk menampilkan data produk
    public static function getAllProduct()
    {
        // Bikin Query nampilin nama kategori
        $alldata = DB::table('products')
            ->get();
        return $alldata;
    }

    // Buat fungsi untuk menampilkan data kategori produk
    public static function getCategoryProduct()
    {
        // Bikin Query nampilin nama kategori
        $alldata = DB::table('product_categories')
            ->get();
        return $alldata;
    }
}
