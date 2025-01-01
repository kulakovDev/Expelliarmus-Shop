<?php

declare(strict_types=1);

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Product\Http\Service\ProductImagesService;
use Modules\Product\Models\Product;

class ProductImagesController extends Controller
{
    public function __construct(
        private ProductImagesService $imagesService
    ) {
    }

    public function store(Request $request, Product $product): JsonResponse
    {
        $this->imagesService->upload($request->file('images'), $product);

        return response()->json(['message' => 'Images uploaded successfully']);
    }
}