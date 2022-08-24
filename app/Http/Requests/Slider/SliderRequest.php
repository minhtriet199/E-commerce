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
            'thumb'=>'required',
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
            'thumb.required' => 'Vui lòng chọn ảnh',
        ];
    }
}
