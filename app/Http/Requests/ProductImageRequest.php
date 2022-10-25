<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductImageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'file' => 'required|max:10240',
            'file.*' => 'image|mimes:jpeg,jpg,png,gif'
        ];
    }
    public function message(){
        return [
            'file.required' => 'Chưa chọn hình',
            'file.*.image' => 'Đây không phải là hình',
            'file.*.mimes' => 'Đây không phải là hình',
            'file.max' => 'File quá lớn, Phải dưới 10MB'
        ];
    }
}
