<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Http\Services\Order\OrderService;
use Carbon\Carbon;
use App\Charts\RevenueChart;
use Illuminate\Support\Facades\DB;

use Auth;

class AdminMainController extends Controller
{
    public function __construct(OrderService $orderService){
        $this->orderService = $orderService;
    }
    public function index(){
        $month = ['1','2','3','4','5','6','7','8','9','10','11','12'];
        $order_chart = [];
        foreach ($month as $key => $value) {
            $order_chart[] = Order::select('*')
        ->whereMonth('created_at',$value)
        ->count();
        }

        // $revenue = Order::select(DB::raw("sum(total) as earnings,date_format(created_at, '%m') as month"))
        // ->groupBy('created_at')
        // ->get();
        
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
        ])->with('month',$month)->with('order_chart',$order_chart);
    }
    public function logout(){   
        Auth::logout();
        return redirect('admin/users/login');
    }
}
