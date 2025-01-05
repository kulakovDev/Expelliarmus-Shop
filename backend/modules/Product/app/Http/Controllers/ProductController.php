<?php

declare(strict_types=1);

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Product\Http\Actions\Product\Create\CreateProduct;
use Modules\Product\Http\Actions\Product\Create\CreateProductFactoryAction;
use Modules\Product\Http\Actions\Product\Retrieve\GetProductsByRootCategoryAction as RootCategoryProducts;
use Modules\Product\Http\Exceptions\FailedToCreateProductException;
use Modules\Product\Http\Requests\ProductCreateRequest;
use Modules\Product\Http\Resources\ProductPreviewByRootCategory;
use Modules\Warehouse\Http\Actions\CreateProductInWarehouse;
use TiMacDonald\JsonApi\JsonApiResourceCollection;

class ProductController extends Controller
{

    public function getProductsByRootCategory(Request $request, RootCategoryProducts $action): JsonApiResourceCollection
    {
        $products = $action->handle();

        return ProductPreviewByRootCategory::collection($products);
    }

    /**
     * @throws FailedToCreateProductException
     */
    public function store(ProductCreateRequest $request, CreateProductFactoryAction $factory): JsonResponse
    {
        $product = $factory->createAction($request)->handle(
            new CreateProduct(),
            new CreateProductInWarehouse()
        );

        return response()->json([
            'message' => 'Product successfully created.',
            'data' => [
                'id' => $product->id,
                'type' => 'products',
            ]
        ], 201);
    }
}