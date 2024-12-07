<?php

declare(strict_types=1);

namespace Modules\Product\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => fake()->title(),
            'title_description' => fake()->paragraph(4),
            'main_description' => fake()->paragraph(20)
        ];
    }
}