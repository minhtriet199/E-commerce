<?php

namespace App\Http\Services\Product;

use App\Models\Menus;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class ProductAdminService
{
    public function create($request)
    {
        
    }

    public function update($request, $menus) 
    {   
       
    }
    
    public function destroy($request)
    {
        
    }
    public function get()
    {
        return Product::orderby('id')
            ->with('menu')
            ->paginate(15);
    }
}

