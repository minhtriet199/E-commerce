<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required|unique',
            'description'=>'required',
            'file'=>'required',
            'content'=>'required',
            'menu_id'=>'required',
            'price'=>'required',
            'active'=>'required',
            'amount'=>'required',
        ];
    }
    public function messages() : array 
    {
        return [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'name.unique' =>  'Tên sản phảm bị trùng',
            'description.required' => 'Vui lòng nhập mô tả',
            'content.required' => 'Vui lòng nhập mô tả chi tiết',
            'file.required'=>'Vui lòng chọn ảnh',
            'menu_id.required'=>'Vui lòng chọn danh mục',
            'price.required'=>'Chưa nhập giá',
            'amount.required'=>'Chưa nhập số lượng',
        ];
    }
}
