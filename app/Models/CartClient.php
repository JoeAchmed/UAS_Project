<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CartClient extends Model
{
    use HasFactory;

    protected $table = 'carts';

    public $timestamps = false;

    protected $fillable = [
        "user_id",
    ];

    public static function getUserCart($userId)
    {
        $cart = DB::table('carts')->where('user_id', $userId)->first();
        return $cart;
    }
}
