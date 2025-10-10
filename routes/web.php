<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\TransaksiPenjualanController;
use App\Http\Controllers\DashboardController;
Route::get('/', function () {
    return view('welcome');
});

// Route resource utama
Route::resource('suppliers', SupplierController::class);
Route::resource('products', ProductController::class);
Route::resource('categories', ProductCategoryController::class);
Route::resource('transaksi', TransaksiPenjualanController::class);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');