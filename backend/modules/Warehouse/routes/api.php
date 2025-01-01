<?php

use Illuminate\Support\Facades\Route;
use Modules\Warehouse\Models\ProductAttribute;

Route::get('/management/available-product-attributes', function () {
    return ProductAttribute::query()->get(['id', 'name', 'type']);
});