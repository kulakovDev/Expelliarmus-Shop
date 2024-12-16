<?php

declare(strict_types=1);

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Product\Http\Resources\BrandsPaginatedResource;
use Modules\Product\Models\Brand;
use Spatie\QueryBuilder\QueryBuilder;
use TiMacDonald\JsonApi\JsonApiResourceCollection;

class BrandsController extends Controller
{
    public function getPaginated(): JsonApiResourceCollection|JsonResponse
    {
        $brands = QueryBuilder::for(Brand::class)
            ->paginate(config('product.max_brands_show_number'), ['id', 'name']);

        if ($brands->isEmpty()) {
            return response()->json(['message' => 'Brands not found'], 404);
        }

        return BrandsPaginatedResource::collection($brands->items())
            ->additional([
                'links' => [
                    'current' => $brands->url($brands->currentPage()),
                    'first' => $brands->url(1),
                    'last' => $brands->url($brands->lastPage()),
                    'next' => $brands->nextPageUrl()
                ],
                'meta' => [
                    'total' => $brands->total()
                ]
            ]);
    }
}