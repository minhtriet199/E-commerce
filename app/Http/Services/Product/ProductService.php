<?php


namespace App\Http\Services\Product;

use Illuminate\Support\Facades\DB;

use App\Models\Product;

class ProductService
{
    const LIMIT = 12;

    public function get($page = null)   {
        return Product::select('id', 'name','slug', 'price', 'price_sale', 'thumb')
            ->when($page != null, function($query) use ($page){
                $query->offset($page * self::LIMIT);
            })
            ->where('active',1)
            ->limit(self::LIMIT)
            ->get();
    }
    public function show($slug){
        return Product::where('slug',$slug)
            ->with('menus')
            ->with('product_image')
            ->firstOrFail();
    }
    public function more($slug){
        $product = Product::where('slug',$slug)->first();
        return $products=Product::inRandomOrder()
        ->where('id','!=',$product->id)
        ->limit(4)
        ->get();
    }

    public function orderBy($request){
        return Product::select('*')
            ->addSelect(DB::raw('if(price_sale=0,price, price_sale) AS current_price'))
            ->orderby('current_price', $request->orderby)
            ->get();
    }
}
