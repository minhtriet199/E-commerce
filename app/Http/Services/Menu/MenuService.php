<?php

namespace App\Http\Services\Menu;
use App\Models\Menus;
use App\Http\Requests\Menu\UpdateRequest;
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

    public function update($request, $menus) : bool
    {   
        if ($request->input('parent_id') != $menus->id){
            $menus->parent_id = (int) $request->input('parent_id');
        }
        $menus->name = (string) $request->input('name');
        $menus->description = (string) $request->input('description');
        $menus->content = (string) $request->input('content');
        $menus->active = (int) $request->input('active');
        $menus->slug = Str::slug($request->input('name'),'-');
        $menus->save();
        
        Session::flash('success','Sửa danh mục thành công');
        return true;
    }
    
    public function destroy($request)
    {
        $id= (int) $request->input('id');
        $menu = Menus::where('id',$request->input('id'))->first();

        if($menu){
            return Menus::where('id',$id)->orWhere('parent_id',$id)->delete(); 
        }
        return false;
    }
}

