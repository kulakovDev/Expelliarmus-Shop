<?php

declare(strict_types=1);

namespace Modules\Warehouse\DTO;

use Illuminate\Support\Collection;
use Modules\Product\Http\Requests\ProductCreateRequest;
use Modules\Warehouse\Models\ProductAttribute;
use Spatie\LaravelData\Data;

class CreateProductAttributeSingleVariationDto extends Data
{
    public function __construct(
        /**@var Collection<int, AttributesForSingleValueDto> */
        public readonly Collection $attributes,
        public readonly ?int $attributeId = null,
    ) {
    }

    public static function fromRequest(ProductCreateRequest $request): ?CreateProductAttributeSingleVariationDto
    {
        $attributes = $request->relation('product_variation');

        if ($attributes->isEmpty()) {
            return null;
        }

        if (! array_key_exists('attribute_id', $attributes[0]) || $attributes[0]['attribute_id'] === null) {
            $newAttribute = ProductAttribute::query()->firstOrCreate([
                'name' => strtolower($attributes[0]['attribute_name']),
            ], [
                'name' => $attributes[0]['attribute_name'],
                'type' => $attributes[0]['attribute_type']
            ]);

            return self::from([
                'attributes' => collect(AttributesForSingleValueDto::collect($attributes[0]['attributes'])),
                'attributeId' => $newAttribute->id,
            ]);
        }

        return self::from([
            'attributes' => collect(AttributesForSingleValueDto::collect($attributes[0]['attributes'])),
            'attributeId' => $attributes[0]['attribute_id'],
        ]);
    }
}