<?php

namespace App\Http\Services\Order;

use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Product;
use Carbon\Carbon;
use Helper;

class OrderService
{
    public function getOrder($id){
        return Order::where('id',$id)->first();
    }
    public function getDetail($id){
        return Order_detail::where('order_id',$id)->get();
    }
    public function getOrderDetail(){
        return Order::where('id', session('order'))
        ->with('order_details')
        ->get();  
    }
    public function getOrderId($request){
        return Order::where('id',$request->input('id'))->first();
    }
    public function insertOrderDetail($order,$cart){
        return  order_detail::create([
            'order_id' => $order->id,
            'product_name' => $cart['name'],
            'thumb' => $cart['thumb'],
            'quantity'=> $cart['quantity'],
            'price' => $cart['price'],
        ]);
    }

    public function get(){
        return order::where('user_id',Auth::id())
            ->with('order_details')
            ->orderBy('id','desc')
            ->get();
    }
    
    public function update($request){
        $order = Order::where('id',$request->id)->first(); 
        if($order){
            $order = Order::where('id',$request->id)
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

    public function get_daily_order(){
        return DB::table('Orders')
            ->whereDate('created_at', Carbon::today());
    }

    public function count_order_byStatus($status){
        return DB::table('Orders')
            ->where('status',$status)
            ->count();
    }

    public function Top_selling_product(){
        return DB::table('order_details')
        ->select('*',DB::raw('sum(quantity) as total'))
        ->groupBy('product_name')
        ->orderBy('total','desc')
        ->limit(4)
        ->get();
    }

    public function decreaseAmount($detail){
        return Product::where('name',$detail->product_name)->decrement('amount',$detail->quantity);
    }
    public function get_month_order($month,$year){
        return Order::whereYear('created_at',$year)
        ->whereMonth('created_at',$month)
        ->paginate(6);
    }
    public function get_day_order($day,$month,$year){
        return Order::whereYear('created_at',$year)
        ->whereMonth('created_at',$month)
        ->whereDay('created_at',$day)
        ->paginate(6);
    }

    public function not_selling_product(){
        $item = Order_Detail::whereMonth('created_at',Carbon::now()->month)->pluck('product_name')->all();
        return Product::whereNotIn('name',$item)->get();
    }
}
