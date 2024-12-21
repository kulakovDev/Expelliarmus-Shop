<?php

declare(strict_types=1);

namespace Modules\Product\Http\DTO;

use Illuminate\Support\Collection;
use Modules\Product\Http\Requests\ProductCreateRequest;
use Spatie\LaravelData\Data;

class CreateProductAttributeCombinedVariationsDto extends Data
{
    public function __construct(
        public readonly string $skuName,
        public readonly int $quantity,
        /** @var Collection<int, AttributesForCombinedValueDto> */
        public readonly Collection $attributes,
        public readonly ?float $priceInCents = null,
    ) {
    }

    public static function fromRequest(ProductCreateRequest $request): Collection
    {
        if ($request->relation('product_variations_combinations')->isEmpty()) {
            return collect();
        }

        return $request->relation('product_variations_combinations')->map(function (array $variation) {
            return self::from([
                'skuName' => $variation['sku'],
                'quantity' => $variation['quantity'],
                'priceInCents' => $variation['price'] ?? null,
                'attributes' => AttributesForCombinedValueDto::collect($variation['attributes'])
            ]);
        });
    }
}