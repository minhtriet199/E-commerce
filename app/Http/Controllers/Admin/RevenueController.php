<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Order\OrderService;
use App\Models\MonthRevenue;
use App\Models\DailyRevenue;

class RevenueController extends Controller
{

    protected $orderServices;

    public function __construct(OrderService $orderServices){
        $this->orderServices = $orderServices;
    }
    public function index(){
        return view('admin.revenue.month',[
            'title' => 'Doanh thu hàng tháng',
            'revenues' => MonthRevenue::all(),
        ]);
    }
    public function index2(){
        return view('admin.revenue.day',[
            'title' => 'Doanh thu mỗi ngày',
            'revenues' => DailyRevenue::all(),
        ]);
    }
    public function store_daily(){
        $day_total = $this->orderServices->get_daily_order()->sum('total');;
        DailyRevenue::create('revenue',$day_total);
        return redirect()->back();
    }
}
