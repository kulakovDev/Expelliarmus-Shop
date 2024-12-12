<?php

declare(strict_types=1);

namespace Modules\Product\Http\Actions\Product\Create;

use Illuminate\Support\Collection;
use Modules\Product\Http\DTO\AttributeValueDto;
use Modules\Product\Http\DTO\ProductAttributeVariationsDto;
use Modules\Warehouse\Models\ProductVariation;

class AddProductVariationsAttributesAction
{
    /**
     * @param  Collection<int, ProductAttributeVariationsDto>  $variationsDto
     */
    public function handle(Collection $variationsDto, int $productId): void
    {
        if (! $variationsDto->isEmpty()) {
            return;
        }

        $variationsDto->each(function (ProductAttributeVariationsDto $dto) use ($productId) {
            $productVariation = $this->createVariation($productId, $dto);

            $this->linkValuesToVariationAttributes($productVariation, $dto->attributes);
        });
    }

    private function createVariation(int $productId, ProductAttributeVariationsDto $dto)
    {
        return ProductVariation::query()->create([
            'product_id' => $productId,
            'sku' => $dto->skuName,
            'quantity' => $dto->quantity,
            'price_in_cents' => $dto->priceInCents,
        ]);
    }

    private function linkValuesToVariationAttributes(ProductVariation $productVariation, Collection $attributes): void
    {
        $productVariation->variationAttributeValue()->createMany(
            $attributes->map(function (AttributeValueDto $dto) use ($productVariation) {
                return [
                    'variation_id' => $productVariation->id,
                    'attribute_id' => $dto->id,
                    'value' => $dto->value
                ];
            })
        );
    }
}