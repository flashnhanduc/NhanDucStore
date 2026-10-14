<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\CardController;

Route::get('/', [CategoryController::class, 'index']);
Route::get('/product/{id}', [CategoryController::class, 'show_product']);
Route::post('/cart/add', [CardController::class, 'add_cart']);
Route::get('/cart', [CardController::class, 'show_cart']);
Route::get('/cart/delete/{id}', [CardController::class, 'delete_cart']);
Route::post('/cart/update', [CardController::class, 'update_cart']);
Route::post('/cart/send', [CardController::class, 'send_order']);
Route::get('/order/confirm', function () {
    return view('order.confirm');
});

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.home');
    })->name('home');
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create'); 
        Route::post('/store', [ProductController::class, 'store'])->name('store'); 
        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit'); 
        Route::put('/{id}/update', [ProductController::class, 'update'])->name('update'); 
        Route::delete('/{id}/destroy', [ProductController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('orders')->name('orders.')->group(function(){
        Route::get('/',[OrderController::class,'index'])->name('index');
        Route::get('/{id}', [OrderController::class, 'show'])->name('show');
        Route::delete('/{id}/destroy', [OrderController::class, 'destroy'])->name('destroy');
    });
    
});

require __DIR__ . '/auth.php';
