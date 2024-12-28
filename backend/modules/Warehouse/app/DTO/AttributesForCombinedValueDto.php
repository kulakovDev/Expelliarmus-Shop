<?php

declare(strict_types=1);

namespace Modules\Warehouse\DTO;

use Illuminate\Contracts\Pagination\CursorPaginator as CursorPaginatorContract;
use Illuminate\Contracts\Pagination\Paginator as PaginatorContract;
use Illuminate\Pagination\AbstractCursorPaginator;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Enumerable;
use Illuminate\Support\LazyCollection;
use Modules\Warehouse\Enums\ProductAttributeTypeEnum;
use Modules\Warehouse\Models\ProductAttribute;
use Spatie\LaravelData\CursorPaginatedDataCollection;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\PaginatedDataCollection;

class AttributesForCombinedValueDto extends Data
{
    public function __construct(
        public readonly string $value,
        public readonly ?int $id = null,
        public readonly ?string $attributeName = null,
        public readonly ?ProductAttributeTypeEnum $type = null
    ) {
    }

    public static function collect(
        mixed $items,
        ?string $into = null
    ): array|DataCollection|PaginatedDataCollection|CursorPaginatedDataCollection|Enumerable|AbstractPaginator|PaginatorContract|AbstractCursorPaginator|CursorPaginatorContract|LazyCollection|Collection {
        $newItems = collect($items)->map(function ($item) {
            if (! array_key_exists('id', $item) || $item['id'] === null) {
                $attribute = ProductAttribute::query()->firstOrCreate(
                    ['name' => strtolower($item['name'])],
                    ['name' => $item['name'], 'type' => $item['type']]
                );

                return [
                    'id' => $attribute->id,
                    'value' => $item['value']
                ];
            }
            return $item;
        });

        return $newItems->map(function ($items) {
            return new self(
                value: $items['value'],
                id: $items['id']
            );
        });
    }
}