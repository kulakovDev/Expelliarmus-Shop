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
            [
                'name' => 'Food',
                'slug' => 'food',
                'children' => [
                    [
                        'name' => 'Drinks',
                        'slug' => 'drinks',
                        'children' => [
                            [
                                'name' => 'Alcohol',
                                'slug' => 'alcohol'
                            ],
                            [
                                'name' => 'Soda',
                                'slug' => 'soda'
                            ],
                            [
                                'name' => 'Juice',
                                'slug' => 'juices'
                            ]
                        ]
                    ]
                ]
            ],
            [

                'name' => 'Clothes',
                'slug' => 'clothes',
                'children' => [
                    [
                        'name' => 'Men\'s Clothes',
                        'slug' => 'mens-clothes',
                        'children' => [
                            [
                                'name' => 'Sweatshirts',
                                'slug' => 'mens-sweatshirts',
                            ],
                            [
                                'name' => 'Shoes',
                                'slug' => 'mens-shoes',
                                'children' => [
                                    [
                                        'name' => 'Sneakers',
                                        'slug' => 'mens-sneakers'
                                    ],
                                    [
                                        'name' => 'Boots',
                                        'slug' => 'mens-boots'
                                    ]
                                ]
                            ],
                            [
                                'name' => 'Jeans',
                                'slug' => 'mens-jeans'
                            ]
                        ]
                    ],
                    [
                        'name' => 'Women\'s Clothes',
                        'slug' => 'womens-clothes',
                        'children' => [
                            [
                                'name' => 'Sweatshirts',
                                'slug' => 'womens-sweatshirts'
                            ],
                            [
                                'name' => 'Shoes',
                                'slug' => 'womens-shoes',
                                'children' => [
                                    [
                                        'name' => 'Sneakers',
                                        'slug' => 'womens-sneakers'
                                    ],
                                    [
                                        'name' => 'Boots',
                                        'slug' => 'womens-boots'
                                    ]
                                ]
                            ],
                        ]
                    ],
                ],
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}