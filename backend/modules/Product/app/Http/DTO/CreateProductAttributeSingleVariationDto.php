<?php

declare(strict_types=1);

namespace Modules\Product\Http\DTO;

use Illuminate\Support\Collection;
use Modules\Product\Http\Requests\ProductCreateRequest;
use Modules\Warehouse\Enums\ProductAttributeTypeEnum;
use Spatie\LaravelData\Data;

class CreateProductAttributeSingleVariationDto extends Data
{
    public function __construct(
        /**@var Collection<int, AttributesForSingleValueDto> */
        public readonly Collection $attributes,
        public readonly ?int $attributeId = null,
        public readonly ?string $attributeName = null,
        public readonly ?ProductAttributeTypeEnum $attributeType = null
    ) {
    }

    public static function fromRequest(ProductCreateRequest $request): ?CreateProductAttributeSingleVariationDto
    {
        $attributes = $request->relation('product_variation');

        if ($attributes->isEmpty()) {
            return null;
        }

        return self::from([
            'attributes' => collect(AttributesForSingleValueDto::collect($attributes[0]['attributes'])),
            'attributeId' => $attributes[0]['attribute_id'],
            'attributeName' => $attributes[0]['attribute_name'],
            'attributeType' => ProductAttributeTypeEnum::tryFrom($attributes[0]['attribute_type'])
        ]);
    }
}