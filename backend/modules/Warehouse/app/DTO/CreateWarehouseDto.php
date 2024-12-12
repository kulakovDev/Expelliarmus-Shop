<?php

declare(strict_types=1);

namespace Modules\Warehouse\DTO;

use Modules\Product\Http\Requests\ProductCreateRequest;
use Spatie\LaravelData\Dto;

class CreateWarehouseDto extends Dto
{
    public function __construct(
        public readonly string $productArticle,
        public readonly int $totalQuantity,
        public readonly float $price
    ) {
    }

    public static function fromRequest(ProductCreateRequest $request): CreateWarehouseDto
    {
        return new self(
            productArticle: $request->product_article,
            totalQuantity: (int)$request->total_quantity,
            price: $request->price
        );
    }
}