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

        return $rootCategories->map(function (Category $category) {
            $products = $this->getProducts($category);
            return (object)[
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
                'products' => $products->getCollection(),
                'pagination' => (object)[
                    'next' => $products->nextPageUrl(),
                    'total' => $products->total()
                ],
            ];
        });
    }

    private function getProducts(Category $category): LengthAwarePaginator
    {
        $key = $this->cacheService->key(config('product.cache.products-by-category'), $category->id);

        return $this->cacheService->repository->remember(
            key: $key,
            ttl: now()->addWeek(),
            callback: function () use ($category) {
                $descendantCategoryIds = $category->descendants()->pluck('id');

                $products = $this->getProductsByCategories($descendantCategoryIds);

                $products->getCollection()->transform(function (Product $product) {
                    $product->preview_image = $this->imagesService->getResizedImage($product, new Size(300, 300));
                    return $product;
                });

                return $products;
            }
        );
    }

    private function getProductsByCategories(Collection $categories): LengthAwarePaginator
    {
        return Product::query()
            ->whereIn('category_id', $categories->toArray())
            ->paginate(10, [
                'id',
                'slug',
                'title',
                'images',
                'category_id',
                'created_at',
            ]);
    }
}
