<?php

declare(strict_types=1);

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Product\Http\Actions\Product\Create\CreateProduct;
use Modules\Product\Http\Actions\Product\Create\CreateProductFactoryAction;
use Modules\Product\Http\Actions\Product\Create\CreateProductInWarehouse;
use Modules\Product\Http\Exceptions\FailedToCreateProductException;
use Modules\Product\Http\Requests\ProductCreateRequest;
use Throwable;

class ProductController extends Controller
{
    /**
     * @throws FailedToCreateProductException
     */
    public function store(ProductCreateRequest $request, CreateProductFactoryAction $factory): JsonResponse
    {
        try {
            $factory->createAction($request)->handle(
                new CreateProduct(),
                new CreateProductInWarehouse()
            );
        } catch (Throwable $e) {
            dd($e->getMessage());
        }
        return response()->json([
            'message' => 'Product successfully created.'
        ], 201);
    }
}