<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\productResource;
use App\Models\Product;
use Illuminate\Http\Request;

class productController extends Controller
{

    public function index()
    {
        $product = product::all();
        return response()->json($product);
    }

    public function store(Request $request)
    {
        $product = product::create($request->all());
        return response()->json($product,201);
    }

    public function show($id)
    {
        $product =product::Where('id',$id)->first();
        return response()->json($product);
    }
    public function update(Request $request, $id)
    {
        $product = product::findorFail($id);
        $product->update($request->all());
        $product->save();

        return response()->json($product);
    }
    public function destroy( $id)
    {
        $product = product::findorFail($id);
        $product->delete();
        return response()->json($product);
    }
}
