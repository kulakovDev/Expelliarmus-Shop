<?php

declare(strict_types=1);

namespace Modules\Product\Http\DTO;

use Modules\Warehouse\Enums\ProductAttributeTypeEnum;
use Spatie\LaravelData\Data;

class AttributesForCombinedValueDto extends Data
{
    public function __construct(
        public readonly string $value,
        public readonly ?int $id = null,
        public readonly ?string $attributeName = null,
        public readonly ?ProductAttributeTypeEnum $type = null
    ) {
    }
}