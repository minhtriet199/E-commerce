<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\userController;
use App\Http\Controllers\Api\productController;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware(['throttle:api'])->group(function () {
    Route::post('login',[AuthController::class,'login']);
    Route::get('products', [productController::class,'index']);
    Route::post('products/create',[productController::class,'store']);
    Route::get('products/show/{id}', [productController::class,'show']);
    Route::put('products/update/{id}',[productController::class,'update']);
    Route::delete('products/delete/{id}',[productController::class,'destroy']);
});


