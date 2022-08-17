<?php

namespace App\Http\Requests\Menu;

use Illuminate\Foundation\Http\FormRequest;

class CreateFormRequest extends FormRequest
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
            'name' => 'required|unique:menuses',
            'description' => 'required',
            'content' => 'required',
            'active' => 'required','in:0,1'
        ];
    }

    public function messages() : array 
    {
        return [
            'name.required' => 'Vui lòng nhập tên danh mục',
            'name.unique' =>  'Danh mục đã tồn tại',
            'description.required' => 'Vui lòng nhập mô tả',
            'content.required' => 'Vui lòng nhập mô tả chi tiết',
        ];
    }
}
