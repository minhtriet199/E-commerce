<?php

namespace App\Http\Services\Menu;
use App\Models\Menus;
use App\Models\Product;
use App\Http\Requests\Menu\UpdateRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class MenuService
{
    public function get()
    {
        // return Menus::withTrashed()->get();
        return Menus::all();
    }
    public function create($request)
    {
        try{
            Menus::create([
                'name' =>(string) $request->input('name'),
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
        $menus->name = (string) $request->input('name');
        $menus->active = (int) $request->input('active');
        $menus->slug = Str::slug($request->input('name'),'-');
        $menus->save();
        
        Session::flash('success','Cập nhật danh mục thành công');
        return true;
    }
    
    public function destroy($request)
    {
        $menu = Menus::where('id',$request->input('id'))->first(); 
        if($menu){
            $menu -> delete();
            return true;
        }
        return false;
    }

    public function getSlug($slug)
    {
        return Menus::where('slug',$slug)->firstOrFail();
    }

    public function getProduct($menu, $request)
    {
        $query = $menu->products()
            ->select('id', 'name','slug' , 'thumb','price', 'price_sale')
            ->where('active', 1);
        if($request->input('price')){
            $query->orderBy('price',$request->input('price'));
        }
        return $query
            ->orderByDesc('id')
            ->paginate(8);
      
    }
}

