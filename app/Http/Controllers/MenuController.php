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
        if($slug == 'all'){
            return view('block.shop',[
                'title' =>'Cửa hàng',
                'menus'=>$this->menuService->get(),
                'products' =>$this->productService->get()
            ]);
        }
        else{
            $menu = $this->menuService->getSlug($slug);
            return view('block.shop',[
                'title' => $menu->name,
                'products' =>$this->menuService->getProduct($menu,$request),
                'menu' =>$menu,
                'menus' => $this->menuService->get()
            ]);
        }
    }
}
