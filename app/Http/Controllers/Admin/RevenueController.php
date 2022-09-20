<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MonthRevenue;
use App\Models\DailyRevenue;

class RevenueController extends Controller
{
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
}
