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
        ->get();
    }
    public function store(Request $request){
        $data = $request->all();
        $comment = Comment::create([
            'user_id' => Auth::id(),
            'product_id' => $data['product_id'],
            'Content' => $data['content'],
        ]);
        return response()->json($comment);
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
