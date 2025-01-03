<?php

declare(strict_types=1);

namespace Modules\Product\Http\Actions\Product\Retrieve;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Product\Models\Category;
use Modules\Product\Models\Product;

class GetProductsByRootCategoryAction
{
    public function handle(Category $category): LengthAwarePaginator
    {
        $categories = $category->descendants()
            ->whereDoesntHave('children')
            ->pluck('id');

        return Product::query()
            ->whereIn('category_id', $categories)
            ->paginate(15, [
                'id',
                'slug',
                'title',
                'images',
                'category_id',
                'created_at'
            ]);
    }
}