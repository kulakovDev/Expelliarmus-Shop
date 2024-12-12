<?php

declare(strict_types=1);

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Product\Http\Actions\Product\Create\CreateProductAction;
use Modules\Product\Http\DTO\CreateProductDto;
use Modules\Product\Http\DTO\ProductAttributeVariationsDto;
use Modules\Product\Http\Exceptions\FailedToCreateProductException;
use Modules\Product\Http\Requests\ProductCreateRequest;
use Modules\Warehouse\DTO\CreateWarehouseDto;

class ProductController extends Controller
{
    /**
     * @throws FailedToCreateProductException
     */
    public function store(ProductCreateRequest $request, CreateProductAction $action): JsonResponse
    {
        $action->handle(
            CreateProductDto::fromRequest($request),
            ProductAttributeVariationsDto::fromRequest($request),
            CreateWarehouseDto::fromRequest($request)
        );

        return response()->json([
            'message' => 'Product successfully created.'
        ], 201);
    }
}