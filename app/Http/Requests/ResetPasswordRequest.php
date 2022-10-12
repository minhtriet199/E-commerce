<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'email' => 'required|email|exists:users,email'
        ];
    }
    public function messages(){
        return [
            'email.required' => 'Chưa nhập email',
            'email.exists' => 'Email này không tồn tại trong hệ thống'   
        ];
    }
}
