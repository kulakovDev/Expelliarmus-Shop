<?php

declare(strict_types=1);

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Product\Http\Resources\TreeCategoryResource;
use Modules\Product\Models\Category;

class CategoryController extends Controller
{
    public function index(): JsonResponse|AnonymousResourceCollection
    {
        $categories = Category::getAllCategoriesInTree();

        if ($categories->isEmpty()) {
            return response()->json(['message' => 'Categories not found'], 404);
        }

        return TreeCategoryResource::collection(Category::getAllCategoriesInTree());
    }
}