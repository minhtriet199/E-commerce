<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\models\Comment;
use App\models\Product;

class CommentServices{

    public function get_with_product(){
        return DB::table('comments')
            ->select('comments.product_id','products.name','products.thumb',DB::raw('count(comments.id) as total'))
            ->join('products','comments.product_id','=','products.id')
            ->groupBy('products.name')
            ->where('Comments.deleted_at',NULL)
            ->get();
    }
    public function get_with_user($product_id){
        return DB::table('comments')
                ->select('comments.*','users.name')
                ->join('users','comments.user_id','=','users.id')
                ->where('comments.product_id',$product_id)
                ->where('status',1)
                ->where('deleted_at',NULL)
                ->get();
    }
    public function get_pending_comment(){
        return DB::table('comments')
        ->select('comments.*','products.name','products.thumb')
        ->join('products','comments.user_id','=','products.id')
        ->where('status',0)
        ->get();
    }
    public function update_comment($request,$status){
        return Comment::where('id',$request->id)->update(['status' => $status]);
    }
    public function destroy_comment($request){
        return  Comment::where('id',$request->id)->delete();
    }
}

