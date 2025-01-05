<?php

declare(strict_types=1);

namespace Modules\Product\Http\Actions\Product\Retrieve;

use App\Services\Cache\CacheService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Modules\Product\Http\Service\ProductImagesService;
use Modules\Product\Models\Category;
use Modules\Product\Models\Product;
use Modules\Product\Storages\ProductImages\Size;

class GetProductsByRootCategoryAction
{
    public function __construct(
        private ProductImagesService $imagesService,
        private CacheService $cacheService
    ) {
    }

    public function handle(): Collection
    {
        $rootCategories = Category::query()
            ->whereNull('parent_id')
            ->get();

        $lastChildCategories = $this->getAllChildCategoriesRelatedToRootCategories($rootCategories);

        return $rootCategories->map(function (Category $category) use ($lastChildCategories) {
            return (object)[
                'category_id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
                'products' => $this->getProducts($category, $lastChildCategories)
            ];
        });
    }

    private function getAllChildCategoriesRelatedToRootCategories(Collection $rootCategories): Collection
    {
        return $rootCategories->mapWithKeys(function (Category $category) {
            return [
                $category->id => $category->descendants()
                    ->whereDoesntHave('children')
                    ->pluck('id')
                    ->toArray()
            ];
        });
    }

    private function getAllProductsByCategories(array $categories): LengthAwarePaginator
    {
        return Product::query()
            ->whereIn('category_id', $categories)
            ->paginate(10, [
                'id',
                'slug',
                'title',
                'images',
                'category_id',
                'created_at'
            ]);
    }

    private function getProducts(Category $category, Collection $lastChildCategories): LengthAwarePaginator
    {
        $key = $this->cacheService->key(config('product.cache.products-by-category'), $category->id);

        return $this->cacheService->repository->remember(
            key: $key,
            ttl: now()->addWeek(),
            callback: function () use ($lastChildCategories, $category) {
                $childCategoryIds = $lastChildCategories[$category->id] ?? [];

                $products = $this->getAllProductsByCategories($childCategoryIds);

                $products->getCollection()->transform(function (Product $product) {
                    $product->preview_image = $this->imagesService->getResizedImage($product, new Size(300, 300));
                    return $product;
                });

                return $products;
            }
        );
    }
}