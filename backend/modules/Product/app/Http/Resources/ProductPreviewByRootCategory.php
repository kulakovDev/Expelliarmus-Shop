<?php

declare(strict_types=1);

namespace Modules\Product\Http\Resources;

use Illuminate\Http\Request;
use TiMacDonald\JsonApi\JsonApiResource;
use TiMacDonald\JsonApi\Link;

class ProductPreviewByRootCategory extends JsonApiResource
{
    public function toAttributes(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
        ];
    }

    public function toRelationships(Request $request): array
    {
        return [
            'products' => fn() => ProductResource::collection($this->products)
        ];
    }

    public function toLinks(Request $request): array
    {
        return $this->pagination->next ? [Link::self($this->pagination->next)] : [];
    }

    public function toMeta(Request $request): array
    {
        return [
            'total' => $this->pagination->total,
        ];
    }

    public function toId(Request $request): string
    {
        return (string)$this->id;
    }

    public function toType(Request $request): string
    {
        return 'categories';
    }
}

