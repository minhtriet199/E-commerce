<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Order\OrderService;
use App\Models\Order;
use App\Models\order_detail;
use App\Jobs\sendMailOrder;

class AdminOrderController extends Controller
{

    protected $orderService;

    public function __construct(OrderService $orderService){
        $this->orderService = $orderService;
    }

    public function index($status)
    {
        if($status == 0){
            return view('admin.order.list',[
                'title' => 'Quản lý đơn hàng',
                'orders' => Order::paginate(10),
            ]);
        }
        else{
            return view('admin.order.list',[
                'title' => 'Quản lý đơn hàng',
                'orders' => Order::where('status',$status)->paginate(10),
            ]);
        }
       
    }
    public function show(Order $id){
        return view('admin.order.edit',[
            'title' => 'Quản lý đơn hàng',
            'orders' => $id,
            'details' => order_detail::where('order_id',$id->id)->get(),
        ]);
    }

    // Using ajax to update order status
    // More in public/assets/admin/main.js and find .btn-update-order
    public function update(Request $request){
        $result = $this->orderService->update($request);
        $order = $this->orderServices->getOrderId($request); 
        if($result){
            // Putting sending orderEmail to Queue
            // More in Jobs\SendMailOrder.php
            dispatch(new sendMailOrder($order));
            return response()->json([
                'error'=>false,
            ]);
        }
        return response()->json([
            'error' => true
        ]);
    }
}
