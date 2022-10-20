<?php

namespace App\Http\Services;

use App\Models\Cart;
use App\Models\Cart_item;
use App\Models\Order_detail;

use Illuminate\Support\facades\Auth;
use Illuminate\Support\Facades\Session;


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
    
    public function userStore(){
        if(Auth::check()){
            $Cart = Cart::updateOrCreate([
                'user_id' => Auth::id(),
                'user_name' => Auth::user()->name,
            ]);
            if(Session::has('carts')){
                foreach(Session::get('carts') as $product_id => $details){
                    if(Cart_item::where('product_id',$details['product_id'])->first()){
                        Cart_item::where('product_id',$details['product_id'])
                            ->update([
                                'cart_id' => $Cart->id,
                                'product_id' => $details['product_id'],
                                'name' => $details['name'],
                                'thumb' => $details['thumb'],
                                'quantity' => $details['quantity'],
                                'price' => $details['price'],
                            ]);
                    }
                    else{
                        Cart_item::Create([
                            'cart_id' => $Cart->id,
                            'product_id' => $details['product_id'],
                            'name' => $details['name'],
                            'thumb' => $details['thumb'],
                            'quantity' => $details['quantity'],
                            'price' => $details['price'],
                        ]);
                    }
                }
            }
        }
    }
}
