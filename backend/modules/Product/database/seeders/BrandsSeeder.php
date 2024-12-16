<?php

declare(strict_types=1);

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Product\Models\Brand;

class BrandsSeeder extends Seeder
{
    public function run(): void
    {
        Brand::factory(100)->create();
    }
}