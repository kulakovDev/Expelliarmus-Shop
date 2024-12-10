<?php

declare(strict_types=1);

namespace Modules\Product\Http\DTO;

use Nwidart\Modules\Collection;
use Spatie\LaravelData\Data;

class ProductAttributeVariationsDto extends Data
{
    public function __construct(
        public readonly string $skuName,
        public readonly int $quantity,
        /** @var Collection<int, AttributeValueDto> */
        public readonly Collection $attributes
    ) {
    }
}