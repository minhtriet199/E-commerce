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
    //not working
    
    public function fetchorder(){
        $output= '';
        $orders = Order::orderBy('created_at','desc')
        ->get();
        foreach($orders as $order){
            $output.= '
                <tr>
                    <th><a href="/admin/order/edit/'.$order->id.' ">'. $order->id .'</a></th>
                    <th>'.$order->created_at->format('d/m/y') .'</th>
                    <th>'. $order->username .'</th>
                    <th>0'. $order->phone .'</th>
                    <th> '. number_format($order->total,0,',','.') .' đ</th>
                    <th>'. \App\Helpers\Helper::orderStatus($order->status) .'</th>
                    <th> '. \App\Helpers\Helper::order_button($order,$order->status) .' </th>
                </tr>
            ';
        }
        return response()->json(['result'=> $output]);
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
}
