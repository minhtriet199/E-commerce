<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Services\User\UserService;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{

    protected $userServices;

    public function __construct(UserService $userServices){
        $this->userServices = $userServices;
    }
    public function index()
    {
        return view('admin.account.list',[
            'title' => 'Quản lý tài khoản',
            'accounts' => $this->userServices->get_all(),
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
