<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductColor extends Model
{
    use HasFactory;

    protected $table = 'product_colors';

    public $timestamps = false;

    protected $fillable = [
        "prod_id",
        "color",
    ];

    public static function getProductColor()
    {
        $alldata = DB::table('product_colors')->get();

        return $alldata;
    }
}
