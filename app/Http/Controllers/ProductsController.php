<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Services\Product\ProductService;

class ProductsController extends Controller
{
    protected $productServices;

    public function __construct(ProductService $productServices){
        $this ->productServices = $productServices;
    }
    public function index($slug)
    {
        $product = $this->productServices->show($slug);
        $more = $this->productServices->more($slug);
        return view('products.detail',[
            'title' => $product->name,
            'products' =>$product,
            'more'=>$more
        ]);
    }
}
