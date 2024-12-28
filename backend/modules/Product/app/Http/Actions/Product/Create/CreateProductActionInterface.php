<?php

namespace Modules\Product\Http\Actions\Product\Create;

use Modules\Warehouse\Http\Actions\CreateProductInWarehouse;

interface CreateProductActionInterface
{
    public function handle(CreateProduct $createProduct, CreateProductInWarehouse $createInWarehouse);
}