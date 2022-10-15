<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Order\OrderService;
use App\Jobs\sendMailOrder;
use App\Models\Order;
use App\Models\order_detail;

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

    public function update(Request $request){
        $result = $this->orderService->update($request);
        $order = Order::where('id',$request->input('id'))->first(); 
        if($result){
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
