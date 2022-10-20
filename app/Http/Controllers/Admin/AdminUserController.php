<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Services\User\UserService;
use App\Models\User;
use App\Models\Cities;
use App\Models\District;
use App\Http\Requests\updateUser\UpdateUserRequest;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{

    protected $userServices;

    public function __construct(UserService $userServices){
        $this->userServices = $userServices;
    }
    public function index(){
        return view('admin.account.list',[
            'title' => 'Quản lý tài khoản',
            'accounts' => $this->userServices->get_all(),
        ]);
    }
    public function show($id){
        return view('admin.account.edit',[
            'title' => 'Cập nhật tài khoản',
            'account' => $this->userServices->get_user_id($id),
            'districts' => $this->userServices->user_district($id),
            'cities' => Cities::all(),
        ]);
    }
    public function update(UpdateUserRequest $request, $id){
        $this->userServices->updateUser($request,$id);
        return redirect('/admin/account/list');
    }

    public function destroy(Request $request){
        $carts = User::where('id' , $request->input('id'))->delete();
        return redirect()->back();
    }
}
