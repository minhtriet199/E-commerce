<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;
use App\Models\whistlist;
use App\Http\Services\WishlistServices;

class WishlistController extends Controller
{
    protected $wishlistServices;

    public function __construct(WishlistServices $wishlistServices){
        $this->wishlistServices = $wishlistServices;
    }
    public function index(){
        return view('block.wishlist',[
            'title' => 'Danh sách ước',
            'list' => $this->wishlistServices->get(),
        ]);
    }
    public function insert_wishlist(Request $request){
        if(Auth::check()){
            $find = whistlist::where('user_id','=',Auth::id())
            ->where(['product_id','=', $request['product_id']])
                ->first();
            if($find){
                $quantityNew = $find['quantity'] + $request['quantity'];
                whistlist::where('user_id',Auth::id())
                ->update(['quantity', $quantityNew,]);
            }
            else{
                $whistlist = whistlist::create([
                    'user_id' => Auth::id(),
                    'product_id' => $request['product_id'],
                    'product_id' => $request['quantity'],
                ]);
            }
            return response()->json([
                'error' => true
            ]);
        }
        else{
            return response()->json([
                'error' => false
            ]);
        }
    }
}
