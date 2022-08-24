<?php

namespace App\Http\Services\Slider;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Slider;

class AdminSliderService
{
    public function get()
    {
        return Slider::orderby('id')
        ->where('active',1)
        ->get();
    }
    public function insert($request)
    {
        try{
            $request->except('_token');
            Slider::create($request->input());

            Session::flash('success','Thêm Slider thành công');
        } catch(\Exception $err){
            Session::flash('error','Thêm Slider lỗi');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    
    public function update($request, $slider){
        try{
            $slider->fill($request->input());
            $slider->save();
            Session::flash('success', 'Cập nhật thành công');
        }
        catch(\Exception $err){
            Session::flash('error','Có lỗi');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    public function delete($request){
        $slider = Slider::where('id' , $request->input('id'))->first();
        if($slider){
            $path = str_replace('storage','public',$slider->thumb);
            Storage::delete($path);
            $slider-> delete();
            return true;
        }
        return false;
    }
}