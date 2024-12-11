<?php

declare(strict_types=1);

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Product\Models\ProductSpecAttributes;

class ProductSpecsSeeder extends Seeder
{
    public function run(): void
    {
        ProductSpecAttributes::query()->insert([
                [
                    'spec_name' => 'Size',
                    'group_name' => null
                ],
                [
                    'spec_name' => 'Color',
                    'group_name' => null,
                ],
                [
                    'spec_name' => 'Clothes material',
                    'group_name' => null
                ]
            ]
        );
    }
}