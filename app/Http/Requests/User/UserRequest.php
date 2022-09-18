<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'email'=>'required|unique:Users',
            'password'=>'required|confirmed',
            'password_confirmation' => 'required',
        ];
    }
    public function messages() : array 
    {
        return [
            'name.required' => 'Chưa nhập họ tên',
            'email.required' => 'Chưa nhập email',
            'email.unique' => 'Email bị trùng',
            'password.required' =>'Chưa nhập mật khẩu',
            'password.confirmed' =>'2 mật khẩu không trùng nhau',
            'password_confirmation.required' => 'Chưa xác nhận mật khẩu',
        ];
    }
}
