<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\BrandsController;
use Modules\Product\Http\Controllers\ProductController;

//TODO: guards

Route::post('/management/product/create', [ProductController::class, 'store']);

//показать сначало 25 брендов если нужного бренда в списке нет, проверить остались ли еще бренды,
// если остались сделать новый запрос на выбор всех брендов, которых не было
Route::get('/management/brands', [BrandsController::class, 'getPaginated']);
