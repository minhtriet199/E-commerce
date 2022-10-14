<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class commentRequest extends FormRequest
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
    public function rules()
    {
        return [
           'content' => 'required',
        ];
    }
    public function message(){
        return [
            'content.required' => 'Chưa nhập commnet',
        ];
    }
}
