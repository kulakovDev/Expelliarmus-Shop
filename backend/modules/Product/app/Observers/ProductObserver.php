<?php

namespace Modules\Product\Observers;

use App\Services\Cache\CacheService;
use Modules\Product\Models\Product;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        CacheService::forgetKey(config('product.cache.products-by-category', $product->category_id));
    }

    public function saving(Product $product): void
    {
        $product->fill([
            'main_description_html' => str($product->main_description_markdown)->markdown([
                'html_input' => 'strip',
                'allow_unsafe_links' => false,
                'max_nesting_level' => 5
            ])
        ]);
    }

    /**
     * Handle the ProductObserver "updated" event.
     */
    public function updated(Product $product): void
    {
        CacheService::forgetKey(config('product.cache.products-by-category', $product->category_id));
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
