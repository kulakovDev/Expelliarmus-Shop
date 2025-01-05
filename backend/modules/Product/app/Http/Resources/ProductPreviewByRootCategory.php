<?php

declare(strict_types=1);

namespace Modules\Product\Http\Resources;

use Illuminate\Http\Request;
use TiMacDonald\JsonApi\JsonApiResource;

class ProductPreviewByRootCategory extends JsonApiResource
{
    // TODO: change
    public function toAttributes(Request $request): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'products' => [
                'products' => $this->products->items(),
                'links' => [
                    'current' => $this->products->url($this->products->currentPage()),
                    'last' => $this->products->url($this->products->lastPage()),
                    'next' => $this->products->nextPageUrl()
                ],
                'meta' => [
                    'total' => $this->products->total()
                ]
            ]
        ];
    }

    public function toId(Request $request): string
    {
        return (string)$this->category_id;
    }

    public function toType(Request $request): string
    {
        return 'products';
    }
}
