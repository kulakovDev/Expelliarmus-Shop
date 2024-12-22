<?php

declare(strict_types=1);

namespace Modules\Product\Http\Actions\Product\Create;

use CreateProductInWarehouse;
use Illuminate\Support\Facades\DB;
use Modules\Product\Http\DTO\CreateProductDto;
use Modules\Product\Http\Exceptions\FailedToCreateProductException;
use Modules\Product\Models\Product;
use Modules\Warehouse\DTO\AttributesForSingleValueDto;
use Modules\Warehouse\DTO\CreateProductAttributeSingleVariationDto;
use Modules\Warehouse\DTO\CreateWarehouseDto;
use Modules\Warehouse\Models\ProductAttributeValue;
use Modules\Warehouse\Models\Warehouse;
use Throwable;

class CreateProductWithSingleAttributesAction implements CreateProductActionInterface
{
    public function __construct(
        private CreateProductDto $productDto,
        private CreateWarehouseDto $warehouseDto,
        private CreateProductAttributeSingleVariationDto $singleVariationDto
    ) {
    }

    public function handle(CreateProduct $createProduct, CreateProductInWarehouse $createInWarehouse): void
    {
        DB::transaction(function () use ($createProduct, $createInWarehouse) {
            $product = $createProduct->handle($this->productDto);

            $warehouse = $createInWarehouse->handle($product, $this->warehouseDto);

            $this->handleSingleAttributeCreation($product, $warehouse);
        });
    }

    private function handleSingleAttributeCreation(Product $product, Warehouse $warehouse): void
    {
        try {
            $attributes = $this->singleVariationDto->attributes->map(
                function (AttributesForSingleValueDto $dto) use ($product, $warehouse) {
                    return [
                        'product_id' => $product->id,
                        'attribute_id' => $this->singleVariationDto->attributeId,
                        'value' => $dto->value,
                        'quantity' => $dto->quantity,
                        'price_in_cents' => $dto->price ? number_format($dto->price, 2) : $warehouse->pricePerUnit(),
                        'created_at' => now(),
                    ];
                }
            );

            ProductAttributeValue::query()->insert($attributes->toArray());
        } catch (Throwable $e) {
            throw new FailedToCreateProductException($e->getMessage(), $e);
        }
    }
}