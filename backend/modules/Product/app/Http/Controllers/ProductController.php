<?php

declare(strict_types=1);

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use CreateProductInWarehouse;
use Illuminate\Http\JsonResponse;
use Modules\Product\Http\Actions\Product\Create\CreateProduct;
use Modules\Product\Http\Actions\Product\Create\CreateProductFactoryAction;
use Modules\Product\Http\Exceptions\FailedToCreateProductException;
use Modules\Product\Http\Requests\ProductCreateRequest;

class ProductController extends Controller
{
    /**
     * @throws FailedToCreateProductException
     */
    public function store(ProductCreateRequest $request, CreateProductFactoryAction $factory): JsonResponse
    {
        $factory->createAction($request)->handle(
            new CreateProduct(),
            new CreateProductInWarehouse()
        );

        return response()->json([
            'message' => 'Product successfully created.'
        ], 201);
    }
}