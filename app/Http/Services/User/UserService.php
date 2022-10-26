<?php

namespace App\Http\Services\User;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\User_attribute;
use App\Models\District;
use App\Models\Cities;
use Illuminate\Support\facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function get(){
        $id = Auth::id();
        $name = Auth::user()->name;
        return User::where('id',Auth::id())
            ->with('profile')
            ->first();
    }

    public function insert($request){
        try{
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

    public function get_user_id($id){
        return User::where('id',$id)->with('profile')->first();
    }
    public function updateUser($request,$id){
        $user= User::where('id',$id)->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
        ]);
        $detail = User_attribute::where('user_id',$id)->update([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'district' => $request->input('district'),
            'city' => $request->input('city'),
        ]);
    }
    public function user_district($id){
        $detail = User_attribute::where('user_id',$id)->first();
        if($detail['district'] == 0){
            return '0';
        }
        else{
            $UserCity =  Cities::where('id',$detail['city'])->first();
            return $UserDistrict =  District::where('city_id',$UserCity['id'])
            ->get();
        } 
    }
}