<?php

declare(strict_types=1);

namespace Modules\Product\Http\DTO;

use Illuminate\Support\Collection;
use Modules\Product\Http\Requests\ProductCreateRequest;
use Modules\Warehouse\Enums\ProductAttributeTypeEnum;
use Spatie\LaravelData\Data;

class ProductAttributeSingleVariationDto extends Data
{
    public function __construct(
        /**@var Collection<int, AttributesForSingleValueDto> */
        public readonly Collection $attributes,
        public readonly ?int $attributeId = null,
        public readonly ?string $attributeName = null,
        public readonly ?ProductAttributeTypeEnum $attributeType = null
    ) {
    }

    public static function fromRequest(ProductCreateRequest $request)
    {
        if ($request->relation('product_variation')->isEmpty()) {
            return collect();
        }

        return self::from([

        ])
    }
}