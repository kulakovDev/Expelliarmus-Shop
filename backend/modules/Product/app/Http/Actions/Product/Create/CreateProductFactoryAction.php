<?php

declare(strict_types=1);

namespace Modules\Product\Http\Actions\Product\Create;

use Modules\Product\Http\DTO\CreateProductDto;
use Modules\Product\Http\Exceptions\FailedToCreateProductException;
use Modules\Product\Http\Requests\ProductCreateRequest;
use Modules\Warehouse\DTO\CreateProductAttributeCombinedVariationsDto;
use Modules\Warehouse\DTO\CreateProductAttributeSingleVariationDto;
use Modules\Warehouse\DTO\CreateWarehouseDto;
use Throwable;

class CreateProductFactoryAction
{
    public function createAction(ProductCreateRequest $request): CreateProductActionInterface
    {
        try {
            if (is_null($request->is_combined_attributes)) {
                return $this->createProductWithoutAttributes($request);
            }

            if ($request->is_combined_attributes === true) {
                return $this->createCombinedAttributeProduct($request);
            }

            return $this->createSingleAttributeProduct($request);
        } catch (Throwable $e) {
            throw new FailedToCreateProductException($e->getMessage(), $e);
        }
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