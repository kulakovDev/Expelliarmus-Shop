<?php

declare(strict_types=1);

namespace Modules\Product\Http\Actions\Product\Create;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Modules\Product\Http\DTO\AttributesForCombinedValueDto;
use Modules\Product\Http\DTO\CreateProductAttributeCombinedVariationsDto;
use Modules\Product\Http\DTO\CreateProductDto;
use Modules\Product\Http\Exceptions\FailedToCreateProductException;
use Modules\Product\Models\Product;
use Modules\Warehouse\DTO\CreateWarehouseDto;
use Modules\Warehouse\Models\ProductVariation;
use Modules\Warehouse\Models\Warehouse;
use Throwable;

class CreateProductWithCombinedAttributesAction implements CreateProductActionInterface
{
    public function __construct(
        private CreateProductDto $productDto,
        private CreateWarehouseDto $warehouseDto,
        /**@var Collection<int, CreateProductAttributeCombinedVariationsDto> */
        private Collection $combinedVariationsDto
    ) {
    }

    public function handle(CreateProduct $createProduct, CreateProductInWarehouse $createInWarehouse): void
    {
        DB::transaction(function () use ($createProduct, $createInWarehouse) {
            $product = $createProduct->handle($this->productDto);

            $warehouse = $createInWarehouse->handle($product, $this->warehouseDto);

            $this->handleCreatingCombinedAttributes($product, $warehouse);
        });
    }

    /**
     * @throws FailedToCreateProductException
     */
    private function handleCreatingCombinedAttributes(Product $product, Warehouse $warehouse)
    {
        if (! $this->combinedVariationsDto->isEmpty()) {
            try {
                $this->combinedVariationsDto->each(
                    function (CreateProductAttributeCombinedVariationsDto $dto) use ($product, $warehouse) {
                        $productVariation = $this->createVariation($product, $warehouse, $dto);

                        $this->linkValuesToVariationAttributes($productVariation, $dto->attributes);
                    }
                );
            } catch (Throwable $e) {
                throw new FailedToCreateProductException($e->getMessage(), $e);
            }
        }
    }

    private function createVariation(
        Product $product,
        Warehouse $warehouse,
        CreateProductAttributeCombinedVariationsDto $dto
    ) {
        return ProductVariation::query()->create([
            'product_id' => $product->id,
            'sku' => $dto->skuName,
            'quantity' => $dto->quantity,
            'price_in_cents' => $dto->priceInCents
                ? number_format($dto->priceInCents, 2)
                : $warehouse->price_per_unit_in_cents
        ]);
    }

    private function linkValuesToVariationAttributes(ProductVariation $productVariation, Collection $attributes): void
    {
        $productVariation->variationAttributeValue()->createMany(
            $attributes->map(function (AttributesForCombinedValueDto $dto) use ($productVariation) {
                return [
                    'variation_id' => $productVariation->id,
                    'attribute_id' => $dto->id,
                    'value' => $dto->value
                ];
            })
        );
    }
}