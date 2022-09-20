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
        $this->middleware('auth');
    }

    public function index()
    {
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
