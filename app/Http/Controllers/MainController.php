<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\Slider\AdminSliderService;
use App\Http\Services\Product\ProductService;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Cart_item;
use Session;


class MainController extends Controller
{
    protected $sliderService;
    protected $product;

    public function __construct(AdminSliderService $sliderService,ProductService $product)
    {
        $this->sliderService = $sliderService;
        $this->product = $product;
    }

    public function index()
    {
        return view('block.home', [
            'title' => 'Lowkey | Shop bán quần áo',
            'sliders' => $this->sliderService->get(),
            'products' => $this->product->get(),
        ]);
    }
    // Using ajax to load more product in main page
    // More in assets/js/main.js and find #loadmore
    public function loadProduct(Request $request){
        $page = $request ->input('page',0);
        $result = $this->product->get($page);

        if(count($result) != 0){
            $html = view('products.list', ['products' => $result]) ->render();
            return response()->json(['html' => $html]);
        }
        return response()->json(['html' => '']);
    }

    // Using ajax to load searching result 
    // More in assets/js/main.js and find #search-box
    public function search(Request $request){
        $data = $request->all();
        $output= '';
        $products = Product::where('name','Like','%'.$data['search'].'%')
                ->orWhere('slug','Like','%'.$data['search'].'%')
                ->limit(5)
                ->get();
        
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
    
    public function test(){
        $response = Http::get('https://eldenring.fanapis.com/api/bosses?name=melina');
        // $response = Http::get('http://127.0.0.1:8000/api/products/show/2');
        $get = json_decode($response->getBody());
        dd($get);
        // return view('block.test',[
        //     'title' => 'test',
        // ],compact('get'));
    }
}
