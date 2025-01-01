<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\BrandsController;
use Modules\Product\Http\Controllers\CategoryController;
use Modules\Product\Http\Controllers\ProductController;
use Modules\Product\Http\Controllers\ProductImagesController;

//TODO: guards

Route::prefix('management')->group(function () {
    Route::post('/product', [ProductController::class, 'store']);

    Route::get('/brands', [BrandsController::class, 'getPaginated']);

    Route::resource('categories', CategoryController::class)
        ->only('index');

    Route::post('/product/{product}/images', [ProductImagesController::class, 'store']);
});