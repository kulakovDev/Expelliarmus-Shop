<?php

declare(strict_types=1);

namespace Modules\Product\Http\DTO;

use Spatie\LaravelData\Data;

class ProductSpecsDto extends Data
{
    public function __construct(
        public readonly int $id,
        public readonly array $value
    ) {
    }
}