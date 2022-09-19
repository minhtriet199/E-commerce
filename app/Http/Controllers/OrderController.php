<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Order\OrderService;

use App\Mail\OrderMail;

class OrderController extends Controller
{

    protected $orderServices;
    
    public function __construct(OrderService $orderService){
        $this->orderService = $orderService;
    }

    public function senOrderMail($order){
        Mail::to($order->email)->send(new OrderMail($order));
    }
    public function show(){
        return view('block.finish',[
            'title' => 'Thông tin đơn hàng',
            'order' => $this->orderService->getOrder(),
            'details' => $this->orderService->getOrderDetail(),
        ]);
    }

}
