<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\Users\LoginController;
use \App\Http\Controllers\Admin\MainController;
use \App\Http\Controllers\Admin\MenusController;

Route::get( 'admin/users/login', [LoginController::class, 'index'])->name('login');
Route::post( 'admin/users/login/store', [LoginController::class, 'store']);


Route::middleware(['auth'])->group(function (){
    Route::prefix('admin')->group(function(){
        Route::get( '/',[MainController::class, 'index'] )->name('admin');
        Route::get( 'main',[MainController::class, 'index'] )->name('admin');
       
        Route::prefix('menus')->group(function(){
            Route::get('list',[MenusController::class,'index']);

            Route::get('add',[MenusController::class,'create']);
            Route::post('add',[MenusController::class,'store']);
        });
    }); 
});