<?php

declare(strict_types=1);

namespace Modules\Product\Http\Actions\Product\Create;

use Modules\Product\Http\DTO\CreateProductAttributeCombinedVariationsDto;
use Modules\Product\Http\DTO\CreateProductAttributeSingleVariationDto;
use Modules\Product\Http\DTO\CreateProductDto;
use Modules\Product\Http\Requests\ProductCreateRequest;
use Modules\Warehouse\DTO\CreateWarehouseDto;

class CreateProductFactoryAction
{
    public function createAction(ProductCreateRequest $request): CreateProductActionInterface
    {
        if (is_null($request->is_combined_attributes)) {
            return $this->createProductWithoutAttributes($request);
        }

        if ($request->is_combined_attributes === true) {
            return $this->createCombinedAttributeProduct($request);
        }

        return $this->createSingleAttributeProduct($request);
    }

    private function createSingleAttributeProduct(ProductCreateRequest $request): CreateProductActionInterface
    {
        return new CreateProductWithSingleAttributesAction(
            productDto: CreateProductDto::fromRequest($request),
            warehouseDto: CreateWarehouseDto::fromRequest($request),
            singleVariationDto: CreateProductAttributeSingleVariationDto::fromRequest($request)
        );
    }

    private function createCombinedAttributeProduct(ProductCreateRequest $request): CreateProductActionInterface
    {
        return new CreateProductWithCombinedAttributesAction(
            productDto: CreateProductDto::fromRequest($request),
            warehouseDto: CreateWarehouseDto::fromRequest($request),
            combinedVariationsDto: CreateProductAttributeCombinedVariationsDto::fromRequest($request)
        );
    }

    private function createProductWithoutAttributes(ProductCreateRequest $request): CreateProductActionInterface
    {
        return new CreateProductWithoutAttributes(
            productDto: CreateProductDto::fromRequest($request),
            warehouseDto: CreateWarehouseDto::fromRequest($request)
        );
    }
}