<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;

class LoginController extends Controller
{ 
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['getLogout', 'getRegister']]);
    }
    public function index()
    {
        return view('admin.users.login', [
            'title' => 'Đăng nhập hệ thống'
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
            'level' => 1
        ],$request->input('remember'))) {
            return redirect()->route('admin');
        }
        Session()->flash( 'error','Email hoặc password không đúng');
        return redirect()->back();
    }
}
