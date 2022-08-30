<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Services\Menu\MenuService;
use \App\Http\Services\Product\ProductAdminService;
class MenuController extends Controller
{
    protected $menuService;
    protected $productService;

    public function __construct(MenuService $menuService,ProductAdminService $productService){
        $this->menuService = $menuService;
        $this->productService =$productService;
    }

    public function index(Request $request, $slug)
    {
        $menu = $this->menuService->getSlug($slug);
        $products = $this->menuService->getProduct($menu,$request);

        return view('block.shop',[
            'title' => $menu->name,
            'products' =>$products,
            'menu' =>$menu,
            'menus' => $this->menuService->getChild()
        ]);
    }
    public function show(){
        return view('block.shop',[
            'title' =>'Cửa hàng',
            'menus'=>$this->menuService->getChild(),
            'products' =>$this->productService->get()
        ]);
    }
}
