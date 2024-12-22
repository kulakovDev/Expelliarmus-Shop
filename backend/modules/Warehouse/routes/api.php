<?php

use Illuminate\Support\Facades\Route;
use Modules\Warehouse\Models\ProductAttribute;

Route::get('/available-product-attributes', function () {
    return ProductAttribute::query()->get(['id', 'name', 'type']);
});