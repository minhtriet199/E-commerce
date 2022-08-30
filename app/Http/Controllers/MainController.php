<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Services\Slider\AdminSliderService;
use \App\Http\Services\Product\ProductService;
use \App\Http\Services\Menu\MenuService;

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
        return view('block.home', [
            'title' => 'Lowkey | Shop bán quần áo',
            'sliders' => $this->sliderService->get(),
            'products' => $this->product->get(),
            'menus' => $this->menus->get()
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
}
