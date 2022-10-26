<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;
use App\Http\Requests\loginRequest;

class LoginController extends Controller
{ 
    public function index()
    {
        return view('admin.users.login', [
            'title' => 'Đăng nhập hệ thống'
        ]);
    }

    public function store(loginRequest $request){
        if(Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input( 'password'),
        ],$request->input('remember'))) {
            return redirect()->route('admin');
        }
        Session()->flash( 'error','Email hoặc password không đúng');
        return redirect()->back();
    }
}
