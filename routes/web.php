<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WardsController;
use Illuminate\Support\Facades\Route;




// routes/web.php
Route::get('/api/wards', [WardsController::class, 'getWards']);

//login
Route::get('/login',[LoginController::class,'show_login']) -> name('login');
Route::post('/check_login',[LoginController::class,'check_login']) -> name('check_login');
Route::get('/register', [App\Http\Controllers\RegisterController::class, 'show_register'])->name('register');



//admin
Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', function () {
            return view('admin.home');
        });
    Route::get('/product/list', [ProductController::class, 'list_product']);
    Route::get('/product/create', [ProductController::class, 'add_product']);
    Route::post('/product/add', [ProductController::class, 'insert_product']);
    Route::get('/product/delete/{id}', [ProductController::class, 'delete_product']);
    Route::get('/product/edit/{id}', [ProductController::class, 'edit_product']);
    Route::post('/product/edit/{id}', [ProductController::class, 'update_product']);
    });
});
   

    




Route::get('/admin/orders/list',[OrderController::class ,'list_order'] );
Route::get('/admin/orders/detail/{order_detail}',[OrderController::class ,'detail_order'] );
Route::post('/upload',[UploadController::class,'uploadImage']);

Route::post('/uploads',[UploadController::class,'uploadImages']);


Route::get('/', [CategoryController::class,'index']);
Route::get('/product/{id}',[CategoryController::class, 'show_product'] );
Route::get('/cart', [CardController::class ,'show_cart']);
Route::get('/order/confirm', function () {
    return view('order.confirm');
});
Route::get('/order/success', function () {
    return view('order.sucess');
});
Route::post('/cart/add',[CardController::class,'add_cart']);
Route::get('/cart/delete/{id}', [CardController::class, 'delete_cart']);
Route::post('/cart/update', [CardController::class, 'update_cart']);
Route::post('/cart/send', [CardController::class, 'send_order']);

