<?php

namespace App\Http\Requests\updateUser;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'district' => 'required',
        ];
    }
    public function messages() : array 
    {
        return [
            'name.required' => 'Chưa nhập họ tên',
            'email.required' => 'Chưa nhập email',
            'phone.required' => 'Chưa nhập số điện thoại',
            'address.required' => 'Chưa nhập địa chỉ',
            'city.required' => 'Chưa chọn thành phố',
            'district.required' =>'Chưa chọn quận',
        ];
    }
}
