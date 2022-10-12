<?php

namespace App\Http\Services;

use App\Models\Cart;
use App\Models\Cart_item;
use App\Models\Order_detail;

use Illuminate\Support\facades\Auth;

class CartServices{

    public function get(){
        return Cart::where('user_id',Auth::id())
            ->with('cart_items')
            ->get();   
    }
    public function getCart(){
        return Cart::where('user_id',Auth::id())
        ->first();   
    }

    public function insert_cart_detail($order,$cart){
        return  order_detail::create([
            'order_id' => $order->id,
            'product_name' => $cart['name'],
            'thumb' => $cart['thumb'],
            'quantity'=> $cart['quantity'],
            'price' => $cart['price'],
        ]);
    }
    
}
