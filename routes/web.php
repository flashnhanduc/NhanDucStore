<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;


Route::get('/', [CategoryController::class, 'index']);

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
    
});

require __DIR__ . '/auth.php';
