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

    public function insert($request){
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

    public function get_all(){
        return User::with('profile')->get();
    }
}