<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Services\User\UserService;
use App\Http\Services\Order\OrderService;
use App\Http\Services\Voucher\VoucherService;
use App\Models\User;
use App\Models\User_attribute;
use App\Models\Cities;
use App\Models\District;
use App\Models\Cart;
use App\Http\Requests\User\UserRequest;



class UserController extends Controller
{

    protected $userServices;

    public function __construct(UserService $userServices,OrderService $orderService,VoucherService $voucherService){
        $this ->userServices = $userServices;
        $this ->orderService =$orderService;
        $this ->voucherService = $voucherService;
    }

    public function index(){
        $city = Cities::all();
        return view('user.account.profile',
        [
            'title'=> 'Tài khoản',
            'users' => $this->userServices->get(),
            'citys' => $city,
            'orders' => $this->orderService->order(),
            'vouchers' => $this->voucherService->get(),
        ]);
    }

    public function signup(){
        return view('user.signup',[
            'title' => 'Đăng ký'
        ]);
    }

    public function create(UserRequest $request){
        $result = $this->userServices->insert($request);
        if($result) return redirect('/user/login')->withInput();
        else return redirect()->back()->withInput();
    }

    public function login(){
        return view('user.login',[
            'title' => 'Đăng nhập'
        ]);
    }
    
    public function store(Request $request){
        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required'
        ]);

        if(Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input( 'password'),
        ])){
            return redirect(url('/'));
        }
        Session()->flash( 'error','Email hoặc password không đúng');
        return redirect()->back();
    }
    public function logouts()
    {   
        Auth::logout();
        Session::flush();
        return redirect(url('/'));
    }

    public function update(Request $request){
        $User_attribute = User_attribute::find($request->user_id);
        $User_attribute->update($request->input());
        return response()->json($User_attribute);
    }

    public function updatepass(Request $request){
        $User = User::find($request->id);
        $User->update($request->input());
        return response()->json($User);
    }

}
