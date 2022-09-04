<?php

namespace App\Http\Services\User;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\User_attribute;
use Illuminate\Support\facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function get(){
        $id = Auth::id();
        $name = Auth::user()->name;
        return User::where('id',$id)
            ->with('profile')
            ->firstOrFail();
       
    }

    protected function isValidatePassword($request){
        if($request->input('password-confirm') != $request->input('password')
        ){
            Session::flash('error','Hai mật khẩu không giống nhau');
            return false;
        }
        return true;
    }
    public function insert($request){
        $isValidatePassword =$this->isValidatePassword($request);
        if($isValidatePassword === false) return false;

        try{
            $request->except('_token');
            $user =User::create([
                'name' =>$request->input('name'),
                'email' =>$request->input('email'),
                'password' =>Hash::make($request->input('password')),
            ]);
            User_attribute::create([
                'id' => $user->id,
                'user_id' => $user->id,
            ]);
        } catch(\Exception $err){
            Session::flash('error','Đăng ký lỗi');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }
}