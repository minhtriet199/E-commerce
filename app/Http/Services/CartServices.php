<?php

namespace App\Http\Services;

use Illuminate\Support\Arr;
use Session;

class CartServices{
    
   public function insert($request){
        $qty = (int)$request->input('num_product');
        $product_id =(int)$request->input('id');

        if($qty <= 0){
            return false;
        }

        $carts = Session::get('carts');
        if(is_null($carts)){
            Session::put('carts',[
                $product_id => $qty
            ]);
            return true;
        }
        $exist = Arr::exists($carts, $product_id);
        if($exist){
            $qtyNew =$carts[$product_id] + $qty;
            Session::put('carts',[
                $product_id => $qtyNew
            ]);
            return true;
        }
        Session::put('carts',[
            $product_id => $qty
        ]);
        return true;
   }
}
