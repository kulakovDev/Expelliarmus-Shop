<?php

declare(strict_types=1);

namespace Modules\Product\Http\Actions\Product\Create;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Modules\Product\Http\DTO\CreateProductDto;
use Modules\Product\Http\DTO\ProductAttributeVariationsDto;
use Modules\Product\Http\DTO\ProductSpecsDto;
use Modules\Product\Http\Exceptions\FailedToCreateProductException;
use Modules\Product\Models\Product;
use Modules\Warehouse\DTO\CreateWarehouseDto;
use Throwable;

class CreateProductAction
{
    public function __construct(
        private readonly AddProductVariationsAttributesAction $addVariations,
        private readonly CreateProductInWarehouse $createProductInWarehouse
    ) {
    }

    /**
     * @param  Collection<int, ProductAttributeVariationsDto>  $variationsDto
     * @throws FailedToCreateProductException
     */
    public function handle(CreateProductDto $dto, Collection $variationsDto, CreateWarehouseDto $warehouseDto): void
    {
        try {
            DB::transaction(function () use ($dto, $variationsDto, $warehouseDto) {
                $product = $this->createProduct($dto);

                $this->createProductInWarehouse->handle($product->id, $warehouseDto);

                $this->linkAttributesToProduct($product, $dto->productSpecs);

                $this->addVariations->handle($variationsDto, $product->id);
            });
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

    private function linkAttributesToProduct(Product $product, Collection $productSpecs): void
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