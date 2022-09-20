<?php

namespace App\Http\Services\Order;

use App\Http\Requests\order\UpdateRequest;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Product;
use Carbon\Carbon;

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
    
    public function update($request)
    {
        $order = Order::where('id',$request->input('id'))->first(); 
        if($order){
            $order = Order::where('id',$request->input('id'))
                ->increment('status',1);
            return true;
        }
        return false;
    }

    public function count_total(){ 
        return DB::table('Orders')
            ->whereMonth('created_at',Carbon::now()->month)
            ->sum('total');
    }
    public function daily_order_count(){
        return DB::table('Orders')
            ->whereDate('created_at', Carbon::today())
            ->count();
    }
    public function count_today_total(){ 
        return DB::table('Orders')
            ->whereDate('created_at', Carbon::today())
            ->sum('total');
    }
    public function count_pending(){
        return DB::table('Orders')
            ->where('status',0)
            ->count();
    }
    public function count_shipping_order(){
        return DB::table('Orders')
            ->where('status',1)
            ->count();
    }
    public function count_success_order(){
        return DB::table('Orders')
            ->where('status',2)
            ->count();
    }
    public function count_refund_order(){
        return DB::table('Orders')
            ->where('status',3)
            ->count();
    }

}

