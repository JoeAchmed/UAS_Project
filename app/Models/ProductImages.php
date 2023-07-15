<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductImages extends Model
{
    use HasFactory;

    protected $table = 'product_images';

    public $timestamps = false;

    protected $fillable = [
        "prod_id",
        "path",
    ];

    public static function getProductImages()
    {
        $alldata = DB::table('product_images')->get();

        return $alldata;
    }
}
