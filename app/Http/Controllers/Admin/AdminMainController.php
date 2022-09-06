<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AdminMainController extends Controller
{
    public function index()
    {
        return view('admin.users.main', [
            'title' => 'Trang quản trị Admin',
        ]);
    }
    public function logout()
    {   
        Auth::logout();
        return redirect('admin/users/login');
    }
    

}
