<?php

namespace Modules\Product\Http\Actions\Product\Create;

use CreateProductInWarehouse;

interface CreateProductActionInterface
{
    public function handle(CreateProduct $createProduct, CreateProductInWarehouse $createInWarehouse);
}