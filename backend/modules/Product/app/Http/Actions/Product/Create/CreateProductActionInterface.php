<?php

namespace Modules\Product\Http\Actions\Product\Create;

interface CreateProductActionInterface
{
    public function handle(CreateProduct $createProduct, CreateProductInWarehouse $createInWarehouse);
}