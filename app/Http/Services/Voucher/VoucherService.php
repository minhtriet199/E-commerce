<?php

namespace App\Http\Services\Voucher;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Voucher;


class VoucherService
{
   public function insert($request){
        try{
            $request->except('_token');
            Voucher::create([
                'voucher_code' => Str::upper($request->input('voucher_code')),
                'discount' =>$request->input('discount'),
                'quantity' => $request->input('quantity'),
                'expire_date' =>$request->input('expire_date'),
                'active' => $request->input('active'),
            ]);

            Session::flash('success','Thêm Voucher thành công');
        } catch(\Exception $err){
            Session::flash('error','Thêm Voucher lỗi');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
   }
}