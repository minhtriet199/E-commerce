<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index($slug){
        $product = Product::where('slug',$slug)->first();
        return Comment::where('product_id',$product->id)
        ->with('users')
        ->get();
    }
}
