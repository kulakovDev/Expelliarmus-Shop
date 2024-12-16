<?php

declare(strict_types=1);

namespace Modules\Product\Http\Resources;

use Illuminate\Http\Request;
use TiMacDonald\JsonApi\JsonApiResource;

class TreeCategoryResource extends JsonApiResource
{
    public function toAttributes(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'last' => $this->children->isEmpty(),
            'children' => $this->isRoot() ? null : self::collection($this->children)
        ];
    }

    public function toRelationships(Request $request)
    {
        return [
            'children' => fn() => TreeCategoryResource::collection($this->children)
        ];
    }
}