<?php

declare(strict_types=1);

namespace Modules\Product\Http\DTO;

use Spatie\LaravelData\Data;

class AttributeValueDto extends Data
{
    public function __construct(
        public readonly int $id,
        public readonly string $value
    ) {
    }
}