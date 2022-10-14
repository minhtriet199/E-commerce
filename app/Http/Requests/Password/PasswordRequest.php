<?php

namespace App\Http\Requests\Password;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ];
    }
    public function messages(): array 
    {
        return[
            'password.required' => 'Chưa nhập mật khẩu',
            'password.confirmed' => 'Hai mật khẩu không giống nhau',
            'password_confirmation.required' => 'Chưa nhập lại mật khẩu',
        ];
    }
}
