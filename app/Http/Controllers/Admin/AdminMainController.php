<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Order\OrderService;
use App\Http\Services\CommentServices;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Notification;
use App\Models\Comment;
use App\Charts\RevenueChart;
use Carbon\Carbon;
use Auth;

class AdminMainController extends Controller
{
    protected $notificationServices;
    protected $orderService;
    protected $commentServices;
    public function __construct(OrderService $orderService,CommentServices $commentServices){
        $this->orderService = $orderService;
        $this->commentServices = $commentServices;
    }
    public function index(){
        $month = ['1','2','3','4','5','6','7','8','9','10','11','12'];
        $revenue_chart = [];
        foreach ($month as $key => $value) {
            $revenue_chart[] =  DB::table('Orders')
            ->whereMonth('created_at',$value)
            ->sum('total');
        }
        // dd($this->orderService->not_selling_product());
        return view('admin.users.home', [
            'title' => 'Dashboard',
            'orders' => Order::whereDate('created_at', Carbon::today())->get(),
            'order_total' => Order::count(),
            'month_total' => $this->orderService->count_total(),
            'today_total' => $this->orderService->get_daily_order()->sum('total'),
            'user_total' => $this->orderService->get_daily_order()->count(),
            'pending_order' => $this->orderService->count_order_byStatus(1), 
            'shipping_order' => $this->orderService->count_order_byStatus(2),
            'success_order' => $this->orderService->count_order_byStatus(3),
            'refund_order' => $this->orderService->count_order_byStatus(4),
            'top_sell' => $this->orderService->top_selling_product(),
            'not_sell' => $this->orderService->not_selling_product(),
            'pending_comments' => $this->commentServices->get_pending_comment(),
            'month' => $month,
            'revenue_chart' => $revenue_chart,
        ]);
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
