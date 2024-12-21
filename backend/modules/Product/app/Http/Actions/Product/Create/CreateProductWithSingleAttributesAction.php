<?php

declare(strict_types=1);

namespace Modules\Product\Http\Actions\Product\Create;

use Illuminate\Support\Facades\DB;
use Modules\Product\Http\DTO\CreateProductAttributeSingleVariationDto;
use Modules\Product\Http\DTO\CreateProductDto;
use Modules\Warehouse\DTO\CreateWarehouseDto;

class CreateProductWithSingleAttributesAction implements CreateProductActionInterface
{
    public function __construct(
        private CreateProductDto $productDto,
        private CreateWarehouseDto $warehouseDto,
        private CreateProductAttributeSingleVariationDto $singleVariationDto
    ) {
    }

    public function handle(CreateProduct $createProduct, CreateProductInWarehouse $createInWarehouse)
    {
        DB::transaction(function () use ($createProduct, $createInWarehouse) {
            $product = $createProduct->handle($this->productDto);

            $warehouse = $createInWarehouse->handle($product, $this->warehouseDto);
            // attributes
        });
    }
}