<?php

declare(strict_types=1);

namespace Modules\Warehouse\Http\Actions;

use Modules\Product\Http\Exceptions\FailedToCreateProductException;
use Modules\Product\Models\Product;
use Modules\Warehouse\DTO\CreateWarehouseDto;
use Modules\Warehouse\Models\Warehouse;
use Throwable;

class CreateProductInWarehouse
{
    /**
     * @throws FailedToCreateProductException
     */
    public function handle(Product $product, CreateWarehouseDto $dto): Warehouse
    {
        try {
            return Warehouse::query()->create([
                'product_id' => $product->id,
                'product_article' => $dto->productArticle,
                'total_quantity' => $dto->totalQuantity,
                'price_per_unit_in_cents' => $dto->price ? number_format($dto->price, 2) : null
            ]);
        } catch (Throwable $e) {
            throw new FailedToCreateProductException($e->getMessage(), $e);
        }
    }
}