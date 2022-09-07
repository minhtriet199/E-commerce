<?php

namespace App\Http\Requests\Voucher;

use Illuminate\Foundation\Http\FormRequest;

class VoucherRequest extends FormRequest
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
            'voucher_code' => 'required|unique:vouchers|alpha_dash',
            'discount' => 'required',
            'quantity' => 'required',
            'expire_date' => 'required',
        ];
    }
    public function messages() : array 
    {
        return [
            'voucher_code.required' => 'Chưa nhập mã',
            'voucher_code.unique' =>  'Voucher đã tồn tại',
            'voucher_code.alpha-dash' => 'Không được để ô trống',
            'discount.required' => 'Chưa nhập giá giảm',
            'quantity.required' => 'Chưa nhập số lượng',
            'exprire_date.required' => 'Chưa chọn ngày hết hạn',
        ];
    }
}
