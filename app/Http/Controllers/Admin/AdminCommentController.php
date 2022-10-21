<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Services\Product\ProductService;
use App\models\Comment;
use App\models\Product;

class AdminCommentController extends Controller
{

    protected $productServices;
    
    public function __contruct(ProductService $productService){
        $this->productService = $productService;
    }
    public function index(){
        return view('admin.comment.list',[
            'title' => 'Danh sách bình luận',
            'comments' => DB::table('comments')
            ->select('comments.product_id','products.name','products.thumb',DB::raw('count(comments.id) as total'))
            ->join('products','comments.product_id','=','products.id')
            ->groupBy('products.name')
            ->where('Comments.deleted_at',NULL)
            ->get(),
        ]);
    }
    public function show(Product $id){
        return view('admin.comment.product',[
            'title' => $id['name'], 
            'product' => $id,
            'comments' => DB::table('comments')
                ->select('comments.*','users.name')
                ->join('users','comments.user_id','=','users.id')
                ->where('comments.product_id',$id['id'])
                ->where('deleted_at',NULL)
                ->get(),
        ]);
    }
    public function edit(Request $request){
        $comment = DB::table('comments')->select('*')->where('id',$request->id)->first();
        if($comment->status == 0 )
            return Comment::where('id',$request->id)->update(['status' => '1']);
        else
            return Comment::where('id',$request->id)->update(['status' => '0']);
    }
    public function update(Request $request, $id){
        //
    }
    public function destroy(Request $request){
        Comment::where('id',$request->id)->delete();
    }
}
