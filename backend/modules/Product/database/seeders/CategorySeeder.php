<?php

declare(strict_types=1);

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Product\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'name' => 'Clothes',
            'slug' => 'clothes',
            'children' => [
                [
                    'name' => 'Men\'s Clothes',
                    'slug' => 'mens-clothes',
                    'children' => [
                        ['name' => 'Sweatshirts'],
                        [
                            'name' => 'Shoes',
                            'children' => [
                                ['name' => 'Sneakers'],
                                ['name' => 'Boots']
                            ]
                        ],
                        ['name' => 'Jeans']
                    ]
                ],
                [
                    'name' => 'Women\'s Clothes',
                    'slug' => 'womens-clothes',
                    'children' => [
                        ['name' => 'Sweatshirts'],
                        [
                            'name' => 'Shoes',
                            'children' => [
                                ['name' => 'Sneakers'],
                                ['name' => 'Boots']
                            ]
                        ],
                    ]
                ]
            ],
        ];

        Category::create($categories);
    }
}