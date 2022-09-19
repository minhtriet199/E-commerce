<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Order\OrderService;
use App\Http\Services\MailServices;
use App\Models\Order;
use App\Models\order_detail;

class AdminOrderController extends Controller
{

    protected $orderService;

    public function __construct(OrderService $orderService,MailServices $mailServices){
        $this->orderService = $orderService;
        $this->mailServices =$mailServices;
    }

    public function index()
    {
        return view('admin.order.list',[
            'title' => 'Quản lý đơn hàng',
            'orders' => Order::orderBy('created_at','desc')
            ->paginate(9),
        ]);
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
            $this->mailServices->sendOrderMail($order);
            return response()->json([
                'error'=>false,
            ]);
        }
        return response()->json([
            'error' => true
        ]);
    }
    public function list_status($status){
        return view('admin.order.show',[
            'title' => 'Quản lý đơn hàng',
            'orders' => Order::where('status',$status)->paginate(10),
        ]);
    }
}
