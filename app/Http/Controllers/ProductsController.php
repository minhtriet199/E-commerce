<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Services\Product\ProductService;
use App\Http\Services\CommentServices;
use App\Models\Product;
use App\Models\Menus;
use Carbon\carbon;
use Helper;

class ProductsController extends Controller
{
    protected $productServices;
    protected $commentServices;

    public function __construct(ProductService $productServices,CommentServices $commentServices){
        $this ->productServices = $productServices;
        $this ->commentServices = $commentServices;
    }
    public function index($slug){
        $product = $this->productServices->show($slug);       
        return view('products.detail',[
            'title' => $product->name,
            'products' =>$product,
            'more' => $this->productServices->more($slug),
            'comments' => $this->commentServices->get_with_user($product->id),
        ]);
    }

    // Using ajax to order by price
    // More in assest/js/main.js and find .orderby-price
    public function orderby(Request $request){
        $output= '';
        if($request->url == 'all'){
            $products = $this->productServices->orderBy($request);
        }
        else{
            $menu = Menus::where('slug',$request->url)->first();
            $products = Product::select('*')
            ->addSelect(DB::raw('if(price_sale=0,price, price_sale) AS current_price'))
            ->where('menu_id',$menu->id)
            ->orderby('current_price', $request->orderby)
            ->get();
            // $products = $this->productServices->orderBy($request);
            $products->where('menu_id',$menu->id);
        }
        foreach($products as $product){
            $output.= '
                <div class="col-lg-4 col-md-6 col-sm-6">
                    '. Helper::product($product,$product->price,$product->price_sale) .'
                </div>
            ';
        }
        return response()->json(['result'=>$output]);
    }

}
