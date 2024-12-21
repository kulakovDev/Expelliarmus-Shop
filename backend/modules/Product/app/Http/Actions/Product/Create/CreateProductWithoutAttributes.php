<?php

declare(strict_types=1);

namespace Modules\Product\Http\Actions\Product\Create;

use Illuminate\Support\Facades\DB;
use Modules\Product\Http\DTO\CreateProductDto;
use Modules\Warehouse\DTO\CreateWarehouseDto;

class CreateProductWithoutAttributes implements CreateProductActionInterface
{

    public function __construct(
        private CreateProductDto $productDto,
        private CreateWarehouseDto $warehouseDto
    ) {
    }

    public function handle(CreateProduct $createProduct, CreateProductInWarehouse $createInWarehouse): void
    {
        DB::transaction(function () use ($createProduct, $createInWarehouse) {
            $product = $createProduct->handle($this->productDto);

            $createInWarehouse->handle($product, $this->warehouseDto);
        });
    }
}