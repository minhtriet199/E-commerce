<?php

namespace App\Http\Services\Order;

use App\Http\Requests\Menu\UpdateRequest;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderService
{
    public function getOrder(){
        return Order::where('id',session('order'))->first();
    }
    public function getDetail(){
        return Order_detail::where('order_id',session('order'))->get();
    }
    public function getOrderDetail(){
        return Order::where('id', session('order'))
        ->with('order_details')
        ->get();  
    }

    public function get(){
        return order::where('user_id',Auth::id())
            ->with('order_details')
            ->orderBy('id','desc')
            ->get();
    }
}

