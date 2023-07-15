<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategoryAdmin extends Model
{
    use HasFactory;

    protected $table = 'product_categories';

    public $timestamps = false;

    // tentuin kolom2 yang bisa diisi
    protected $fillable = ["name", "slug", "image_url"];

    // public static function getAllProduct()
    // {
    //     $alldata = DB::table('products')
    //         ->get();
    //     return $alldata;
    // }

    // public static function getCategoryProduct()
    // {
    //     $alldata = DB::table('product_categories')->get();
    //     return $alldata;
    // }
}
