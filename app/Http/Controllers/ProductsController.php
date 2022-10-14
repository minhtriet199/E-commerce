<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Product\ProductService;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Menus;
use Carbon\carbon;

class ProductsController extends Controller
{
    protected $productServices;
    protected $commentController;

    public function __construct(ProductService $productServices,CommentController $commentController){
        $this ->productServices = $productServices;
        $this ->commentController = $commentController;
    }
    public function index($slug){
        Carbon::setLocale('vi');
        $more = $this->productServices->more($slug);
        $product = $this->productServices->show($slug);
        
        return view('products.detail',[
            'title' => $product->name,
            'products' =>$product,
            'more'=>$more,
        ]);
    }
    public function orderby(Request $request){
        $output= '';
        if($request->url == 'all'){
            $products = Product::select('*')
            ->addSelect(DB::raw('if(price_sale=0,price, price_sale) AS current_price'))
            ->orderby('current_price', $request->orderby)
            ->get();
        }
        else{
            $menu = Menus::where('slug',$request->url)->first();
            $products = Product::select('*')
            ->addSelect(DB::raw('if(price_sale=0,price, price_sale) AS current_price'))
            ->where('menu_id',$menu->id)
            ->orderby('current_price', $request->orderby)
            ->get();
        }
        foreach($products as $product){
            $output.= '
                <div class="col-lg-4 col-md-6 col-sm-6">
                    '. \App\Helpers\Helper::product($product,$product->price,$product->price_sale) .'
                </div>
            ';
        }
        return response()->json(['result'=>$output]);
    }

}
