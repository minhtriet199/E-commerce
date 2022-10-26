<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Order\OrderService;
use App\Mail\OrderMail;
use Session;

class OrderController extends Controller
{

    protected $orderServices;
    
    public function __construct(OrderService $orderService){
        $this->orderService = $orderService;
    }

    public function senOrderMail($order){
        Mail::to($order->email)->send(new OrderMail($order));
    }
    public function show($id){
        return view('block.purchase',[
            'title' => 'Thông tin đơn hàng',
            'order' => $this->orderService->getOrder($id),
            'details' => $this->orderService->getDetail($id),
        ]);
        
    }

}
