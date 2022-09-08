<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\AdminMainController;
use App\Http\Controllers\Admin\MenusController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;

Route::get( 'admin/users/login', [LoginController::class, 'index'])->name('login');
Route::post( 'admin/users/login/store', [LoginController::class, 'store']);
Route::get('/logout',[AdminMainController::class,'logout'])->name('admin');
Route::post('select-delivery',[ShippingController::class,'select_delivery']);

Route::middleware(['auth'])->group(function (){
    Route::prefix('admin')->group(function(){
        Route::get( '/',[AdminMainController::class, 'index'] )->name('admin');
        Route::get( 'main',[AdminMainController::class, 'index'] )->name('admin');

        Route::get('create',[ShippingController::class,'shippinglist']);
        Route::post('select-delivery',[ShippingController::class,'select_delivery']);
        Route::post('insert-delivery',[ShippingController::class,'insert_delivery']);
        Route::get('shipping',[ShippingController::class,'index']);
        Route::post('update-fee',[ShippingController::class,'update_fee']);

       
        Route::prefix('voucher')->group(function(){
            Route::get('list',[VoucherController::class,'index']);
            Route::get('add',[VoucherController::class,'create']);
            Route::post('add',[VoucherController::class,'store']);
            Route::post('edit',[VoucherController::class,'update']);
        });
       

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

        Route::prefix('order')->group(function(){
            

        });
    }); 
});

Route::get('/',[MainController::class,'index']);
Route::post('/services/load-product',[MainController::class,'loadProduct']);

Route::get('user/signup',[UserController::class,'signup']);
Route::post('user/signup/create',[UserController::class,'create']);

Route::get('user/login',[UserController::class,'login']);
Route::post('user/login/store',[UserController::class,'store']);

//Đăng nhập google
Route::get('login/google', [App\Http\Controllers\Api\GoogleController::class, 'loginGoogle']);
Route::get('login/google/callback', [App\Http\Controllers\Api\GoogleController::class, 'loginCallback']);
//hết google
Route::get('/logouts',[UserController::class,'logouts']);

Route::get('shop/{slug}', [MenuController::class,'index']);
Route::get('shop',[MenuController::class,'show']);
Route::get('product/{slug}',[ProductsController::class,'index']);


Route::post('add-cart',[CartController::class,'insert']);
Route::get('view-cart',[CartController::class,'index']);
Route::patch('update-cart', [CartController::class, 'update']);
Route::delete('remove-cart', [CartController::class, 'remove']);
Route::get('checkout',[CartController::class,'checkout']);

Route::middleware(['auth'])->group(function (){
    Route::prefix('user')->group(function(){
        Route::prefix('account')->group(function(){
            Route::get('profile',[UserController::class,'index']);
            Route::post('profile/update',[UserController::class,'update']);
            Route::post('profile/update-password',[UserController::class,'updatepass']);
        });
        Route::get('view-cart',[CartController::class,'user_cart']);
        Route::get('cart',[CartController::class,'userStore']);

    });
});


