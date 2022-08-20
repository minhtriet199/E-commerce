<?php

namespace App\Http\Services\Product;

use App\Models\Menus;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class ProductAdminService
{
    public function getMenu()
    {
        return Menus::where('active',1)->get();
    }
    public function get()
    {
        return Product::orderby('id')
            ->with('menu')
            ->paginate(15);
    }

    protected function isValidPrice($request)
    {
        if($request->input('prices_sale') >= $request->input('price')
        ){
            Session::flash('error','Giá giảm phải nhỏ hơn giá gốc');
            return false;
        }

        if($request->input('price_sale') !=0 && (int)$request->input('price')==0)
        {
            Session::flash('error','Vui lòng nhập giá gốc');
            return false;
        }
        return true;
    }

    public function insert($request)
    {
        $isValidPrice =$this->isValidPrice($request);
        if($isValidPrice === false) return false;

        try{
            $request->except('_token');
            Product::create([
                'name' =>(string) $request->input('name'),
                'menu_id' =>(int) $request->input('menu_id'),
                'price' =>(int) $request->input('price'),
                'price_sale' =>(int) $request->input('price_sale'),
                'amount' =>(int) $request->input('amount'),
                'thumb' =>(string) $request->input('thumb'),
                'description' =>(string) $request->input('description'),
                'content' =>(string) $request->input('content'),
                'active' =>(int) $request->input('active'),
                'slug' =>Str::slug($request->input('name'),'-')
            ]);

            Session::flash('success','Thêm sản phẩm thành công');
        } catch(\Exception $err){
            Session::flash('error','Thêm sản phẩm lỗi');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }
}

