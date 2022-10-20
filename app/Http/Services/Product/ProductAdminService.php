<?php

namespace App\Http\Services\Product;

use App\Models\Menus;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class ProductAdminService
{
    public function getMenu(){
        return Menus::where('active',1) ->get();
    }
    public function get(){
        return Product::orderby('id')
            ->with('menus')
            ->paginate(9);
    }

    protected function isValidPrice($request){
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

    public function insert($request){
        $isValidPrice =$this->isValidPrice($request);
        if($isValidPrice === false) return false;

        $thumb = '/storage/uploads/'.date("Y/m/d").'/'.time().'.png';
        try{
            $request->except('_token');
            Product::create([
                'name' => $request->input('name'),
                'menu_id' =>$request->input('menu_id'),
                'price' => $request->input('price'),
                'price_sale' =>$request->input('price_sale'),
                'amount' => $request->input('amount'),
                'thumb' => $thumb,
                'description' => $request->input('description'),
                'content' =>$request->input('content'),
                'active' => $request->input('active'),
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

    public function update($request, $product){
        $isValidPrice =$this->isValidPrice($request);
        if($isValidPrice === false) return false;


        try{
            $product->fill($request->input());
            $product->save();
            Session::flash('success', 'Cập nhật thành công');
        }
        catch(\Exception $err){
            Session::flash('error','Có lỗi');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function delete($product){
        if($product){
            $product -> delete();
            return true;
        }
        return false;
    }
    
}

