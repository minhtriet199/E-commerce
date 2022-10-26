<?php

namespace App\Http\Requests\Slider;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
            'name'=>'required|unique:sliders',
            'url'=>'required',
            'file'=>'required|image|mimes:jpeg,jpg,png,gif|max:10240',
            'sort_by'=>'required',
            'active'=>'required',
        ];
    }
    public function messages() : array 
    {
        return [
            'name.required' => 'Vui lòng nhập tiêu đề',
            'name.unique' =>  'Tiêu đề bị trùng',
            'url.required' => 'Vui lòng đường dẫn',
            'sort_by' => 'Vui lòng nhập đường dẫn',
            'file.required' => 'Vui lòng chọn ảnh',
            'file.image' => 'Đây không phải là hình',
            'file.mimes' => 'Đây không phải là hình',
            'file.max' => 'File quá lớn, Phải dưới 10MB',
        ];
    }
}
