<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FacebookController;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\AdminMainController;
use App\Http\Controllers\Admin\MenusController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Admin\RevenueController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CommentController;

Route::get( 'admin/users/login', [LoginController::class, 'index']);
Route::post( 'admin/users/login/store', [LoginController::class, 'store']);
Route::get('/logout',[AdminMainController::class,'logout']);
Route::post('select-delivery',[ShippingController::class,'select_delivery']);
Route::group(['middleware' => ['CheckAdmin']],function (){
    Route::prefix('admin')->group(function(){
        Route::get( '/',[AdminMainController::class, 'index'] )->name('admin');
        Route::get( 'main',[AdminMainController::class, 'index'] )->name('admin');
        Route::get('create',[ShippingController::class,'shippinglist']);
        Route::post('select-delivery',[ShippingController::class,'select_delivery']);
        Route::post('insert-delivery',[ShippingController::class,'insert_delivery']);
        Route::get('shipping',[ShippingController::class,'index']);
        Route::post('update-fee',[ShippingController::class,'update_fee']);
        
        Route::prefix('revenue')->group(function(){
            Route::get('month',[RevenueController::class,'index']);
            Route::get('day',[RevenueController::class,'index2']);
        });
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
            Route::get('edit/{id}',[MenusController::class,'show']);
            Route::post('edit/{id}',[MenusController::class,'update']);
            Route::DELETE('destroy',[MenusController::class,'destroy']);
        });
        Route::prefix('products')->group(function(){
            Route::get('list',[ProductController::class,'index']);
            Route::get('add',[ProductController::class,'create']);
            Route::post('add',[ProductController::class,'store']);
            Route::get('image',[ProductController::class,'products_image']);
            Route::get('image/{id}',[ProductController::class,'product_image']);

            Route::get('edit/{id}',[ProductController::class,'show']);
            Route::post('edit/{id}',[ProductController::class,'update']);
            Route::DELETE('destroy',[ProductController::class,'destroy']);
        });
        Route::post('upload/services',[UploadController::class,'store']);
        Route::prefix('sliders')->group(function(){
            Route::get('list',[SliderController::class,'index']);
            Route::get('add',[SliderController::class,'create']);
            Route::post('add',[SliderController::class,'store']);
            Route::get('edit/{id}',[SliderController::class,'show']);
            Route::post('edit/{id}',[SliderController::class,'update']);
            Route::DELETE('destroy',[SliderController::class,'destroy']);
        });
        Route::prefix('order')->group(function(){
            Route::get('list',[AdminOrderController::class,'index']);

            Route::get('fetchorder',[AdminOrderController::class,'fetchorder']);

            Route::get('list/{status}',[AdminOrderController::class,'list_status']);
            Route::get('edit/{id}',[AdminOrderController::class,'show']);
            Route::post('update',[AdminOrderController::class,'update']);
        });
    }); 
});


Route::get('/',[MainController::class,'index']);
Route::get('/search',[MainController::class,'search']);
Route::post('/services/load-product',[MainController::class,'loadProduct']);
Route::get('user/signup',[UserController::class,'signup']);
Route::post('user/signup/create',[UserController::class,'create']);
Route::get('user/login',[UserController::class,'login']);
Route::post('user/login/store',[UserController::class,'store']);
Route::get('user/reset',[UserController::class,'reset']);
Route::post('user/link-reset',[UserController::class,'sendResetLink']);
Route::get('user/change_pass/{token}',[UserController::class,'passwordForm']);
Route::post('user/change_pass',[UserController::class,'change_pass']);
//Đăng nhập google
Route::get('login/google', [UserController::class, 'loginGoogle']);
Route::get('login/google/callback', [UserController::class, 'googleCallback']);
//hết google
//Đăng nhập facebook
Route::get('login/facebook',[UserController::class,'loginFacebook']);
Route::get('login/facebook/callback',[UserController::class,'facebookCallback']);
//Hết facebook
Route::get('shop/{slug}', [MenuController::class,'index']);
Route::get('shop',[MenuController::class,'show']);
Route::get('product/{slug}',[ProductsController::class,'index']);

Route::get('fetchcmt',[CommentController::class,'fetchcmt']);

Route::post('add-cart',[CartController::class,'insert']);

Route::get('view-cart',[CartController::class,'index']);

Route::patch('update-cart', [CartController::class, 'update']);
Route::delete('remove-cart', [CartController::class, 'remove']);

Route::post('use-voucher',[CartController::class,'use_voucher']);

Route::get('checkout',[CartController::class,'checkout']);
Route::post('select-delivery',[ShippingController::class,'select_delivery']);

Route::post('checkout',[CartController::class,'place_order']);
Route::get('finish',[OrderController::class,'show']);

Route::middleware(['auth'])->group(function (){
    Route::prefix('user')->group(function(){       
        Route::get('/logouts',[UserController::class,'logouts']);
        Route::get('cart',[CartController::class,'userStore']);
        Route::patch('update-carts',[CartController::class,'cart_update']);
        Route::post('comment',[CommentController::class,'store']);
        Route::prefix('account')->group(function(){
            Route::get('profile',[UserController::class,'index']);
            Route::post('profile/update',[UserController::class,'update']);
        });
    });
});


