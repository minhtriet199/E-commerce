<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\userController;
use App\Http\Controllers\Api\productController;
use App\Http\Controllers\Api\AuthController;

Route::middleware(['throttle:api'])->group(function () {

    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });    

    //  Route::resource('products',[productController::class])->middleware('auth:api');
    Route::post('login',[AuthController::class,'login']);
    Route::get('products', [productController::class,'index']);
    Route::post('products/create',[productController::class,'store']);
    Route::get('products/show/{id}', [productController::class,'show']);
    Route::put('products/update/{id}',[productController::class,'update']);
    Route::delete('products/delete/{id}',[productController::class,'destroy']);
});


