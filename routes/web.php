<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

Route::resource('products', ProductController::class);

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');