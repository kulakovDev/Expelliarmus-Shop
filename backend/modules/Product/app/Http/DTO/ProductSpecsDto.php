<?php

declare(strict_types=1);

namespace Modules\Product\Http\DTO;

use Illuminate\Contracts\Pagination\CursorPaginator as CursorPaginatorContract;
use Illuminate\Contracts\Pagination\Paginator as PaginatorContract;
use Illuminate\Pagination\AbstractCursorPaginator;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Enumerable;
use Illuminate\Support\LazyCollection;
use Modules\Product\Models\ProductSpecAttributes;
use Spatie\LaravelData\CursorPaginatedDataCollection;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\PaginatedDataCollection;

class ProductSpecsDto extends Data
{
    public function __construct(
        public readonly int $id,
        public readonly array $value,
    ) {
    }

    public static function collect(
        mixed $items,
        ?string $into = null
    ): array|DataCollection|PaginatedDataCollection|CursorPaginatedDataCollection|Enumerable|AbstractPaginator|PaginatorContract|AbstractCursorPaginator|CursorPaginatorContract|LazyCollection|Collection {
        $newItems = collect($items)->map(function ($item) {
            if (! array_key_exists('id', $item) || $item['id'] === null) {
                $spec = ProductSpecAttributes::query()->firstOrCreate(
                    ['spec_name' => strtolower($item['spec_name'])],
                    ['spec_name' => $item['spec_name'], 'group_name' => $item['group'] ?? null]
                );

                return [
                    'id' => $spec->id,
                    'value' => $item['value'],
                ];
            }
            return $item;
        });

        return $newItems->map(function ($item) {
            return new self(
                id: $item['id'],
                value: $item['value'],
            );
        });
    }
}