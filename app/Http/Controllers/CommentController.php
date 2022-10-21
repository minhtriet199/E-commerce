<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;
use App\Http\Requests\CommentRequest;
use App\Models\Product;
use App\Models\Comment;
use Helper; 

class CommentController extends Controller
{
    public function store(CommentRequest $request){
        $data = $request->all();
        $comment = Comment::create([
            'user_id' => Auth::id(),
            'product_id' => $data['product_id'],
            'Content' => $data['content'],
        ]);
        return response()->json();
    }
    // Using ajax to print out comment
    // More in views/products/detail.blade.php and find at the end page
    public function fetchcmt(Request $request){
        $product_id = $request->product_id;
        $output= '';
        $product = Product::where('id',$product_id)->first();
        $comments = Comment::where('product_id',$product_id)
        ->with('users')
        ->orderBy('created_at','desc')
        ->get();    
        foreach($comments as $comment){
            $output.= '
                <div class="product__details__tab__content">
                    <div class="row">
                        <div class="col-lg-1">
                            <img src="/assets/img/user.png" >
                        </div>
                        <div class="col-lg-11">
                            <div><span class="user_name">'. $comment->users->name.' </span> 
                            '. $comment->updated_at->diffForHumans().'
                            <div>
                                '.$comment->Content.'
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            ';
        }
        return response()->json(['result'=>$output]);
    }
}
