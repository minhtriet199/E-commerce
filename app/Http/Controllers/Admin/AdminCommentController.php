<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Services\Product\ProductService;
use App\Http\Services\CommentServices;
use App\models\Comment;
use App\models\Product;

class AdminCommentController extends Controller
{
    protected $productServices;
    protected $commentServices;

    public function __construct(ProductService $productService,CommentServices $commentServices){
        $this->productService = $productService;
        $this->commentServices = $commentServices;
    }
    public function index(){
        return view('admin.comment.list',[
            'title' => 'Danh sách bình luận',
            'comments' => $this->commentServices->get_with_product(),
        ]);
    }
    public function show(Product $id){
        $product_id = $id['id'];
        return view('admin.comment.product',[
            'title' => 'Bình luận của '.$id['name'], 
            'product' => $id,
            'comments' => $this->commentServices->get_with_user($product_id),
        ]);
    }
    public function update(Request $request){
        $comment = DB::table('comments')->select('*')->where('id',$request->id)->first();
        if($comment->status == 0 )
            return $this->commentServices->update_comment($request,1);
        else
            return $this->commentServices->update_comment($request,0);
    }
    public function destroy(Request $request){
        return $this->commentServices->destroyComment($request);
    }
}
