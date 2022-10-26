<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;
use App\Http\Requests\CommentRequest;
use App\Http\Services\CommentServices;
use App\Models\Product;
use App\Models\Comment;
use Carbon\Carbon;
use Helper; 

class CommentController extends Controller
{
    protected $commentServies;

    public function __construct(CommentServices $commentServies){
        $this->commentServices = $commentServies;
    }
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
        $comments = $this->commentServices->get_with_user($product_id);    
        foreach($comments as $comment){
            $output.= '
                <div class="product__details__tab__content">
                    <div class="row">
                        <div class="col-lg-1">
                            <img src="/assets/img/user.png" >
                        </div>
                        <div class="col-lg-11">
                            <div><span class="user_name">'. $comment->name.' </span> 
                            '. Carbon::parse($comment->updated_at)->diffForHumans().'
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
