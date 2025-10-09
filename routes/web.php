<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductCategoryController;

use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\SupplierController;


Route::get('/', function () {
    return view('welcome');
});

Route::resource('suppliers', SupplierController::class);

//route resource for products
Route::resource('/products', \App\Http\Controllers\ProductController::class);
Route::resource('categories', ProductCategoryController::class);
//route resource for transaksi
Route::resource('/transaksi', TransaksiController::class);