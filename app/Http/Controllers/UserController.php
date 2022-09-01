<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;


class UserController extends Controller
{
    public function index(){
        return view('user.account.profile',
        [
            'title'=> 'Tài khoản'
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
    public function logout()
    {   
        Auth::logout();
        return redirect(url('/'));
    }
}
