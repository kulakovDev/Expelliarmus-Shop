<?php

declare(strict_types=1);

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Product\Http\Resources\CategoryResource;
use Modules\Product\Http\Resources\TreeCategoryResource;
use Modules\Product\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return TreeCategoryResource::collection(Category::getAllCategoriesInTree());
    }
}