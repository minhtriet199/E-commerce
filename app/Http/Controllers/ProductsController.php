<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Services\Product\ProductService;
use App\Http\Controllers\CommentController;
use App\Models\Product;
use Carbon\carbon;

class ProductsController extends Controller
{
    protected $productServices;
    protected $commentController;

    public function __construct(ProductService $productServices,CommentController $commentController){
        $this ->productServices = $productServices;
        $this ->commentController = $commentController;
    }
    public function index($slug)
    {
        Carbon::setLocale('vi');
        $product = $this->productServices->show($slug);
        $comment =$this->commentController->index($slug);
        $more = $this->productServices->more($slug);
        return view('products.detail',[
            'title' => $product->name,
            'products' =>$product,
            'comments' =>$comment,
            'more'=>$more,
        ]);
    }
}
