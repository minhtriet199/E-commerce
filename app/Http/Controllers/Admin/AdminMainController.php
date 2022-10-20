<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Http\Services\Order\OrderService;
use App\Http\Services\NotificationServices;
use Carbon\Carbon;
use App\Charts\RevenueChart;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;

use Auth;

class AdminMainController extends Controller
{
    protected $notificationServices;
    protected $orderService;
    public function __construct(OrderService $orderService,NotificationServices $notificationServices){
        $this->orderService = $orderService;
        $this->notificationServices = $notificationServices;
    }
    public function index(){
        $month = ['1','2','3','4','5','6','7','8','9','10','11','12'];
        $revenue_chart = [];
        foreach ($month as $key => $value) {
            $revenue_chart[] =  DB::table('Orders')
            ->whereMonth('created_at',$value)
            ->sum('total');
        }
        

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
            'top_sell' => $this->orderService->top_selling_product(),
        ])->with('month',$month)->with('revenue_chart',$revenue_chart);
    }
    public function logout(){   
        Auth::logout();
        return redirect('admin/users/login');
    }
    public function check_notify(){
        return Notification::where('active',0)
            ->update(['active' => '1']);
    }
}
