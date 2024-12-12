<?php

declare(strict_types=1);

namespace Modules\Product\Http\Actions\Product\Create;

use Modules\Warehouse\DTO\CreateWarehouseDto;
use Modules\Warehouse\Models\Warehouse;

class CreateProductInWarehouse
{
    public function handle(int $productId, CreateWarehouseDto $dto): void
    {
        Warehouse::query()->create([
            'product_id' => $productId,
            'product_article' => $dto->productArticle,
            'total_quantity' => $dto->totalQuantity,
            'price_per_unit_in_cents' => $dto->price
        ]);
    }
}