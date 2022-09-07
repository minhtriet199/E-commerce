<?php

namespace App\Http\Requests\Shipping;

use Illuminate\Foundation\Http\FormRequest;

class ShippingRequest extends FormRequest
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
            'city_id' => 'required',
            'district_id' => 'required|unique:fees',
            'fee' => 'required'
        ];
    }
    public function messages() : array 
    {
        return [
            'city_id.required' => 'Chọn thành phố,tỉnh',
            'district_id.required' => 'Chọn quận,huyện',
            'district_id.unique' => 'Quận,huyện này đã tồn tại',
            'fee.required' => 'Chưa nhập mệnh giá'
        ];
    }
}
