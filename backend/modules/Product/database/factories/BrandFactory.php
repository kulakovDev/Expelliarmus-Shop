<?php

declare(strict_types=1);

namespace Modules\Product\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{

    public function definition()
    {
        return [
            'name' => fake()->company(),
            'description' => fake()->paragraph()
        ];
    }
}