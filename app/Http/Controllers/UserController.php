<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;
use App\Http\Services\User\UserService;
use App\Models\User;
use App\Models\User_attribute;


class UserController extends Controller
{

    protected $userServices;
    public function __construct(UserService $userServices){
        $this ->userServices = $userServices;
    }

    public function index(){
        return view('user.account.profile',
        [
            'title'=> 'Tài khoản',
            'users' => $this->userServices->get()
        ]);
    }
    
    public function login()
    {
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
        return redirect(url('/'));
    }

    public function update(Request $request){
        $User_attribute = User_attribute::find($request->user_id);
        $User_attribute->update($request->input());
        return response()->json($User_attribute);
    }
}
