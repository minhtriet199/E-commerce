<?php


namespace App\Http\Services\Product;


use App\Models\Product;

class ProductService
{
    const LIMIT = 8;

    public function get($page = null)   
    {
        return Product::select('id', 'name','slug', 'price', 'price_sale', 'thumb')
            ->when($page != null, function($query) use ($page){
                $query->offset($page * self::LIMIT);
            })
            ->limit(self::LIMIT)
            ->get();
    }
    public function show($slug)
    {
        return Product::where('slug',$slug)
            ->with('menus')
            ->with('product_image')
            ->firstOrFail();
    }
    public function more($slug)
    {
        $product = Product::where('slug',$slug)->first();
        $products=Product::inRandomOrder()
        ->where('menu_id','!=',$product->menu_id)
        ->limit(4)
        ->get();
        return $products;
    }
}
