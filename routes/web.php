<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\Users\LoginController;
use \App\Http\Controllers\Admin\AdminMainController;
use \App\Http\Controllers\Admin\MenusController;
use \App\Http\Controllers\Admin\ProductController;
use \App\Http\Controllers\Admin\UploadController;
use \App\Http\Controllers\Admin\SliderController;
use \App\Http\Controllers\MainController;
use \App\Http\Controllers\MenuController;
use \App\Http\Controllers\ProductsController;
use \App\Http\Controllers\UserController;

Route::get( 'admin/users/login', [LoginController::class, 'index'])->name('login');
Route::post( 'admin/users/login/store', [LoginController::class, 'store']);
Route::get('/logout',[AdminMainController::class,'logout'])->name('admin');

Route::middleware(['auth'])->group(function (){
    Route::prefix('admin')->group(function(){
        Route::get( '/',[AdminMainController::class, 'index'] )->name('admin');
        Route::get( 'main',[AdminMainController::class, 'index'] )->name('admin');
       
        Route::prefix('menus')->group(function(){
            Route::get('list',[MenusController::class,'index']);

            Route::get('add',[MenusController::class,'create']);
            Route::post('add',[MenusController::class,'store']);
            Route::get('edit/{menus}',[MenusController::class,'show']);
            Route::post('edit/{menus}',[MenusController::class,'update']);
            Route::DELETE('destroy',[MenusController::class,'destroy']);
        });
        Route::prefix('products')->group(function(){
            Route::get('list',[ProductController::class,'index']);

            Route::get('add',[ProductController::class,'create']);
            Route::post('add',[ProductController::class,'store']);
            Route::get('edit/{product}',[ProductController::class,'show']);
            Route::post('edit/{product}',[ProductController::class,'update']);
            Route::DELETE('destroy',[ProductController::class,'destroy']);
        });
        Route::post('upload/services',[UploadController::class,'store']);
        Route::prefix('sliders')->group(function(){
            Route::get('list',[SliderController::class,'index']);

            Route::get('add',[SliderController::class,'create']);
            Route::post('add',[SliderController::class,'store']);
            Route::get('edit/{slider}',[SliderController::class,'show']);
            Route::post('edit/{slider}',[SliderController::class,'update']);
            Route::DELETE('destroy',[SliderController::class,'destroy']);
        });
    }); 
});

Route::get('/',[MainController::class,'index']);
Route::post('/services/load-product',[MainController::class,'loadProduct']);
 
Route::get('user/login',[UserController::class,'login']);
Route::post('user/login/store',[UserController::class,'store']);
Route::get('/logout',[UserController::class,'logout']);



//Đăng nhập google
Route::get('login/google', [\App\Http\Controllers\Api\GoogleController::class, 'loginGoogle']);
Route::get('login/google/callback', [\App\Http\Controllers\Api\GoogleController::class, 'loginCallback']);
//hết google

Route::middleware(['auth'])->group(function (){
    Route::prefix('user')->group(function(){
        Route::prefix('account')->group(function(){
            Route::get('profile',[UserController::class,'index']);
        });
    });
});


Route::get('shop/{slug}.html', [MenuController::class,'index']);
Route::get('shop',[MenuController::class,'show']);

Route::get('product/{slug}.html',[ProductsController::class,'index']);
