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
}
