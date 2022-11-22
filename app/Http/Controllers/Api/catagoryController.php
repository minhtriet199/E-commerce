<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CatagoryResource;
use App\Models\Menus;
use Illuminate\Http\Request;

class catagoryController extends Controller
{

    public function index()
    {
        $catagory = Menus::all();
        return response()->json($catagory);
    }


}
