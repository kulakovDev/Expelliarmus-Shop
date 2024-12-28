<?php

declare(strict_types=1);

namespace Modules\Product\Http\Actions\Product\Create;

use Illuminate\Support\Collection;
use Modules\Product\Http\DTO\CreateProductDto;
use Modules\Product\Http\DTO\ProductSpecsDto;
use Modules\Product\Http\Exceptions\FailedToCreateProductException;
use Modules\Product\Models\Product;
use Throwable;

class CreateProduct
{
    /**
     * @throws FailedToCreateProductException
     */
    public function handle(CreateProductDto $dto): Product
    {
        try {
            $product = $this->createProduct($dto);

            $this->linkSpecsToProduct($product, $dto->productSpecs);

            return $product;
        } catch (Throwable $e) {
            throw new FailedToCreateProductException($e->getMessage(), $e);
        }
    }

    private function createProduct(CreateProductDto $dto): Product
    {
        return Product::query()->create([
            'title' => $dto->title,
            'title_description' => $dto->titleDesc,
            'main_description_markdown' => $dto->mainDesc,
            'category_id' => $dto->categoryId,
            'brand_id' => $dto->brandId,
            'images' => $dto->images
        ]);
    }

    private function linkSpecsToProduct(Product $product, Collection $productSpecs): void
    {
        $product->productSpecs()->createMany(
            $productSpecs->map(function (ProductSpecsDto $item) use ($product) {
                return [
                    'product_id' => $product->id,
                    'attribute_id' => $item->id,
                    'value' => $item->value
                ];
            })
        );
    }
}