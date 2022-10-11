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
        return response()->json([
            "success" => true,
            "message" => "Product List",
            "data" => $product
            ]);
    }

    public function store(Request $request)
    {

    }

    public function show(product $product)
    {
        //
    }
    public function update(Request $request, product $product)
    {
        //
    }
    public function destroy(product $product)
    {
        //
    }
}
