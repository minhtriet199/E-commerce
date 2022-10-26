<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class loginRequest extends FormRequest
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
            'email' => 'required|email:rfc,dns',
            'password' => 'required',
        ];
    }
    public function message(){
        return[
            'email.required' => 'Chưa nhập email',
            'password.required' => 'Chưa nhập password', 
            'email.email' => ' Không phải là mail',
        ];
    }
}
