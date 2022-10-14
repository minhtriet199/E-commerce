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

        $order = [];
        foreach ($month as $key => $value) {
            $order[] = DB::table('orders')
        ->whereMonth('created_at',$value)
        ->whereYear('created_at',2022)
        ->count();
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
        ])->with('month',json_encode($month,JSON_NUMERIC_CHECK))->with('order',json_encode($order,JSON_NUMERIC_CHECK));
    }
    public function logout(){   
        Auth::logout();
        return redirect('admin/users/login');
    }
    
    public function search_product(Request $request){
        $data = $request->all();
        $output= '';
        $products = Product::where('name','Like','%'.$data['search'].'%')
                ->orWhere('slug','Like','%'.$data['search'].'%')->get();
        foreach($products as $product){
            $output.='

            ';
        }
        return response()->json(['result'=>$output]);

    }


}
