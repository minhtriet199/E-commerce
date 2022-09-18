<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Slider\AdminSliderService;
use App\Http\Services\Product\ProductService;
use App\Http\Services\Menu\MenuService;

use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Cart_item;

class MainController extends Controller
{
    protected $sliderService;
    protected $product;
    protected $menus;

    public function __construct(AdminSliderService $sliderService,ProductService $product,MenuService $menus)
    {
        $this->sliderService = $sliderService;
        $this->product = $product;
        $this->menus = $menus;
    }

    public function index()
    {
        if(Auth::check()) $this->userStore();
        return view('block.home', [
            'title' => 'Lowkey | Shop bán quần áo',
            'sliders' => $this->sliderService->get(),
            'products' => $this->product->get(),
        ]);
    }
    public function loadProduct(Request $request)
    {
        $page = $request ->input('page',0);
        $result = $this->product->get($page);

        if(count($result) != 0){
            $html = view('products.list', ['products' => $result]) ->render();
            return response()->json(['html' => $html]);
        }
        return response()->json(['html' => '']);
    }

    public function userStore(){
        if(Auth::check()){
            $Cart = Cart::updateOrCreate([
                'user_id' => Auth::id(),
                'user_name' => Auth::user()->name,
            ]);
            if(Session::has('carts')){
                foreach(Session::get('carts') as $product_id => $details){
                    if(Cart_item::where('product_id',$details['product_id'])->first()){
                        Cart_item::where('product_id',$details['product_id'])
                            ->update([
                                'cart_id' => $Cart->id,
                                'product_id' => $details['product_id'],
                                'name' => $details['name'],
                                'thumb' => $details['thumb'],
                                'quantity' => $details['quantity'],
                                'price' => $details['price'],
                            ]);
                    }
                    else{
                        Cart_item::Create([
                            'cart_id' => $Cart->id,
                            'product_id' => $details['product_id'],
                            'name' => $details['name'],
                            'thumb' => $details['thumb'],
                            'quantity' => $details['quantity'],
                            'price' => $details['price'],
                        ]);
                    }
                }
            }
        }
    }

    public function search(Request $request){
        $data = $request->all();
        $output= '';
        $products = Product::where('name','Like','%'.$data['search'].'%')
                ->orWhere('slug','Like','%'.$data['search'].'%')->get();
        
        foreach($products as $product){
            $output.='
                <a href="/product/'.$product->slug.'">
                    <div class="row">
                        <div class="col-lg-4"> <img src="'.$product->thumb.'"></div>
                        <div class="col-lg-8"> <p>'.$product->name.'</p>  '.$product->price.'  </div>
                    </div>
                </a>
                ';
        }
        return response()->json(['result'=>$output]);
    }
}
