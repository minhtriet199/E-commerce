<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserInfomationRequest extends FormRequest
{
    public function authorize(){
        return true;
    }
    public function rules(){
        return [
            'user_name' => 'required',
            'email' => 'required' ,
            'address' => 'required',
            'city' => 'required',
            'district' => 'required',
            'phone' => 'required',
        ];
    }
    public function messages() : array 
    {
        return [
            'user_name.required' => 'Chưa nhập họ và tên',
            'email.required' => 'Chưa nhập email',
            'address.required' => 'Chưa nhập địa chỉ',
            'district.required' => 'Chưa chọn Quận',
            'city.required' => 'Chưa chọn Thành phố',
            'phone.required' => 'Chưa nhập số điện thoại',
        ];
    }
}
