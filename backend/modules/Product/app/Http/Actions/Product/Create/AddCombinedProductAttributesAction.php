<?php

declare(strict_types=1);

namespace Modules\Product\Http\Actions\Product\Create;

use Illuminate\Support\Collection;
use Modules\Product\Http\DTO\AttributesForCombinedValueDto;
use Modules\Product\Http\DTO\ProductAttributeCombinedVariationsDto;
use Modules\Warehouse\Models\ProductVariation;

class AddCombinedProductAttributesAction
{
    /**
     * @param  Collection<int, ProductAttributeCombinedVariationsDto>  $variationsDto
     */
    public function handle(int $productId, Collection $variationsDto): void
    {
        if (! $variationsDto->isEmpty()) {
            return;
        }

        $variationsDto->each(function (ProductAttributeCombinedVariationsDto $dto) use ($productId) {
            $productVariation = $this->createVariation($productId, $dto);

            $this->linkValuesToVariationAttributes($productVariation, $dto->attributes);
        });
    }

    private function createVariation(int $productId, ProductAttributeCombinedVariationsDto $dto)
    {
        return ProductVariation::query()->create([
            'product_id' => $productId,
            'sku' => $dto->skuName,
            'quantity' => $dto->quantity,
            'price_in_cents' => number_format($dto->priceInCents, 2),
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