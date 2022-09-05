<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Services\CartServices;
use App\Models\Product;
use Illuminate\Support\Arr;
use Session;

class CartController extends Controller
{
    protected $cartServices;
    
    public function __construct(CartServices $cartServices){
        $this->cartServices = $cartServices;
    }
    public function index(){
        return view('block.cart',[
            'title'=> 'Giỏ hàng'
        ]);
    }

    public function insert(Request $request){
        $product_id = $request->input('product_id');
        $product_name = $request->input('product_name');
        $product_price = $request->input('product_price');
        $product_quantity =(int) $request->input('product_quantity');

        $carts = Session::get('carts',[]);
        $exist = Arr::exists($carts,$product_id);
        if($exist){
            $quantityNew = $carts[$product_id]['product_quantity'] + $product_quantity;
            $carts[$product_id] =[
                'product_name'=> $product_name,
                'product_price' => $product_price,
                'product_quantity'  => $quantityNew,
            ];
        }else{
            $carts[$product_id] = [
                'product_name'=> $product_name,
                'product_price' => $product_price,
                'product_quantity' => $product_quantity,
            ];
        }
        
        $request ->session()->put('carts', $carts);
       
        $data = [];
        $data['carts'] = Arr::exists($carts,$product_id) ?  Session::get('carts') : [];
        return response()->json($data);

    }
}
