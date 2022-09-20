<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Http\Services\Order\OrderService;
use Carbon\Carbon;
use Auth;

class AdminMainController extends Controller
{
    public function __construct(OrderService $orderService){
        $this->orderService = $orderService;
    }
    public function index()
    {
        return view('admin.users.home', [
            'title' => 'Dashboard',
            'orders' => Order::whereDate('created_at', Carbon::today())->get(),
            'order_total' => Order::count(),
            'month_total' => $this->orderService->count_total(),
            'today_total' => $this->orderService->count_today_total(),
            'user_total' => User::count(),
            'pending_order' => $this->orderService->count_pending(),
            'shipping_order' => $this->orderService->count_shipping_order(),
            'success_order' => $this->orderService->count_success_order(),
            'refund_order' => $this->orderService->count_refund_order(),
        ]);
    }
    public function logout()
    {   
        Auth::logout();
        return redirect('admin/users/login');
    }
    

}
