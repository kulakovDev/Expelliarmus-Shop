<?php

declare(strict_types=1);

namespace Modules\Product\Http\DTO;

use Illuminate\Support\Collection;
use Modules\Product\Http\Requests\ProductCreateRequest;
use Spatie\LaravelData\Data;

class ProductAttributeVariationsDto extends Data
{
    public function __construct(
        public readonly string $skuName,
        public readonly int $quantity,
        /** @var Collection<int, AttributeValueDto> */
        public readonly Collection $attributes,
        public readonly ?float $priceInCents = null,
    ) {
    }

    public static function fromRequest(ProductCreateRequest $request): Collection
    {
        if ($request->relation('product_variations')->isEmpty()) {
            return collect();
        }

        return $request->relation('product_variations')->map(function (array $variation) {
            return self::from([
                'skuName' => $variation['sku'],
                'quantity' => $variation['quantity'],
                'priceInCents' => $variation['price_in_cents'] ?? null,
                'attributes' => AttributeValueDto::collect($variation['attributes'])
            ]);
        });
    }
}