<?php

declare(strict_types=1);

namespace Modules\Warehouse\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Warehouse\Enums\ProductAttributeTypeEnum;
use Modules\Warehouse\Models\ProductAttribute;

class ProductAttributeSeeder extends Seeder
{
    public function run(): void
    {
        ProductAttribute::query()->create([
            'name' => 'Size',
            'type' => ProductAttributeTypeEnum::STRING,
        ]);
        ProductAttribute::query()->create([
            'name' => 'Color',
            'type' => ProductAttributeTypeEnum::COLOR
        ]);
    }
}