<?php

namespace App\Http\Services;

use App\Models\Cart;
use App\Models\Cart_item;
use Illuminate\Support\facades\Auth;

class CartServices{

    public function get(){
        return Cart::where('user_id',Auth::id())
            ->with('cart_items')
            ->get();   

    }

}
