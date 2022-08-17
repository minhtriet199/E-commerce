<?php

namespace App\Http\Services\Menu;
use App\Models\Menus;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class MenuService
{
    public function get_cata($parent_id = 1)
    {
        return Menus::
        when($parent_id == 0, function($query) use ($parent_id){
            $query->where('parent_id',$parent_id);
            $query->orderby('id');
        })
        ->get();
    }
    public function create($request)
    {
        try{
            Menus::create([
                'name' =>(string) $request->input('name'),
                'parent_id' =>(int) $request->input('parent_id'),
                'description' =>(string) $request->input('description'),
                'content' =>(string) $request->input('content'),
                'active' =>(int) $request->input('active'),
                'slug' =>Str::slug($request->input('name'),'-')
            ]);

            Session::flash('success','Tạo danh mục thành công');
        }
        catch(\Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return true;
    }
}

