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
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\WishlistController;

Route::get( 'admin/users/login', [LoginController::class, 'index'])->name('login_admin')->middleware('admin');
Route::post( 'admin/users/login/store', [LoginController::class, 'store']);
Route::get('/logout',[AdminMainController::class,'logout']);
Route::post('select-delivery',[ShippingController::class,'select_delivery']);
Route::middleware(['auth_admin'])->group(function (){
    Route::group(['middleware' => ['CheckAdmin']],function (){
        Route::prefix('admin')->group(function(){
            Route::get( '/',[AdminMainController::class, 'index'] )->name('admin');
            Route::get( 'main',[AdminMainController::class, 'index'] )->name('admin');
            Route::get('create',[ShippingController::class,'shippinglist']);
            Route::post('select-delivery',[ShippingController::class,'select_delivery']);
            Route::post('insert-delivery',[ShippingController::class,'insert_delivery']);
            Route::get('shipping',[ShippingController::class,'index']);
            Route::post('update-fee',[ShippingController::class,'update_fee']);
            Route::get('search_product',[AdminMainController::class,'search_product']);//Working on it


            Route::prefix('revenue')->group(function(){
                Route::get('month',[RevenueController::class,'index']);
                Route::get('day',[RevenueController::class,'index2']);
                Route::post('store_dayly',[RevenueController::class,'store_dayly']);
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
            
            Route::group(['middleware' => ['CheckOwner']],function (){
                Route::prefix('sliders')->group(function(){
                    Route::get('list',[SliderController::class,'index']);
                    Route::get('add',[SliderController::class,'create']);
                    Route::post('add',[SliderController::class,'store']);
                    Route::get('edit/{id}',[SliderController::class,'show']);
                    Route::post('edit/{id}',[SliderController::class,'update']);
                    Route::DELETE('destroy',[SliderController::class,'destroy']);
                });
                Route::prefix('account')->group(function(){
                    Route::get('list',[AdminUserController::class,'index']);
                    Route::get('edit/{id}',[AdminUserController::class,'show']);
                    Route::post('edit/{id}',[AdminUserController::class,'update']);
                    Route::delete('destroy',[AdminUserController::class,'destroy']);

                });
            });
            Route::prefix('order')->group(function(){
                Route::get('list/{status}',[AdminOrderController::class,'index']);
                Route::get('edit/{id}',[AdminOrderController::class,'show']);
                Route::post('update',[AdminOrderController::class,'update']);
            });
        }); 
    });
});
//Home page
Route::get('/',[MainController::class,'index']);
Route::post('/services/load-product',[MainController::class,'loadProduct']);

//Search
Route::get('/search',[MainController::class,'search']);

//Sign up
Route::get('user/signup',[UserController::class,'signup']);
Route::post('user/signup/create',[UserController::class,'create']);

//Login
Route::get('user/login',[UserController::class,'login'])->name('login')->middleware('guest');
Route::post('user/login/store',[UserController::class,'store']);

//Forget pass 
Route::get('user/reset',[UserController::class,'reset']);
Route::post('user/link-reset',[UserController::class,'sendResetLink']);
//Change pass
Route::get('user/change_pass/{token}',[UserController::class,'passwordForm']);
Route::post('user/change_pass',[UserController::class,'change_pass']);

//Api login
Route::get('login/google', [UserController::class, 'loginGoogle']);
Route::get('login/google/callback', [UserController::class, 'googleCallback']);
Route::get('login/facebook',[UserController::class,'loginFacebook']);
Route::get('login/facebook/callback',[UserController::class,'facebookCallback']);

//Shop page
Route::get('shop/{slug}', [MenuController::class,'index']);
Route::post('/orderby',[ProductsController::class,'orderby']);

//Product detail page
Route::get('product/{slug}',[ProductsController::class,'index']);
Route::get('fetchcmt',[CommentController::class,'fetchcmt']);
Route::post('add-cart',[CartController::class,'insert']);


//whilist

//Cart page
Route::get('view-cart',[CartController::class,'index']);
Route::patch('update-cart', [CartController::class, 'update']);
Route::delete('remove-cart', [CartController::class, 'remove']);
Route::post('use-voucher',[CartController::class,'use_voucher']); // still a mess

//Check out
Route::get('checkout',[CartController::class,'checkout']);
Route::post('select-delivery',[ShippingController::class,'select_delivery']); // not working
Route::post('checkout',[CartController::class,'place_order']);
//View purchase
Route::get('finish',[OrderController::class,'show']);

//User login
Route::middleware(['auth'])->group(function (){
    Route::get('wishlist',[WishlistController::class,'index']);
    Route::post('add-wishlist',[WishlistController::class,'insert_wishlist']);

    Route::prefix('user')->group(function(){       
        Route::get('/logouts',[UserController::class,'logouts']);
        Route::get('cart',[CartController::class,'userStore']);
        Route::patch('update-carts',[CartController::class,'cart_update']);
        Route::post('comment',[CommentController::class,'store']);
        //User profile
        Route::prefix('account')->group(function(){
            Route::get('profile',[UserController::class,'index']);
            Route::post('profile/update',[UserController::class,'update']);
        });
    });
});