<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

use App\Http\Controllers\OrderController;

Route::resource('products', ProductController::class);

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::resource('orders', OrderController::class);

Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');