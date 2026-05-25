<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::get('/', [ProductController::class, 'index'])->name('index');

Route::post('/products', [ProductController::class, 'store'])->name('products.store');

Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
