<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;

class Cart_item extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'id',
        'cart_id',
        'product_id',
        'name',
        'thumb',
        'quantity',
        'price',       
    ];

    public function carts(){
        return $this->belongsto(Cart::class,'id', 'cart_id' );
    }
}
