<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;
use App\Models\Product;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index($slug){
        $product = Product::where('slug',$slug)->first();
        return Comment::where('product_id',$product->id)
        ->with('users')
        ->orderBy('created_at','desc')
        ->get();
    }
    public function store(Request $request){
        $data = $request->all();
        $output= '';
        $comment = Comment::create([
            'user_id' => Auth::id(),
            'product_id' => $data['product_id'],
            'Content' => $data['content'],
        ]);
        
        $output.='
            <div class="product__details__tab__content">
                <div class="row">
                    <div class="col-lg-1">
                        <img src="/assets/img/user.png" >
                    </div>
                    <div class="col-lg-11">
                        <div><span class="user_name">'. $comment->users->name.' </span> 
                        '. $comment->updated_at->diffForHumans().'
                        <div>
                            '. $comment->Content .'
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        ';
        return response()->json(['result'=>$output]);
    }
    public function fetch_comment($slug){
        $product = Product::where('slug',$slug)->first();
        $comment = Comment::where('product_id',$product->id)
        ->with('users')
        ->get();
        return response()->json([
            'comment' => $comment,
        ]);
    }
}
