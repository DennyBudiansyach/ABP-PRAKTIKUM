<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $categories = ['Makanan', 'Minuman', 'Kebersihan', 'Elektronik', 'Pakaian'];
        $units = ['pcs', 'kg', 'liter', 'lusin', 'pack'];

        return [
            'name'        => fake()->words(3, true),
            'category'    => fake()->randomElement($categories),
            'description' => fake()->sentence(),
            'stock'       => fake()->numberBetween(1, 200),
            'price'       => fake()->numberBetween(1000, 500000),
            'unit'        => fake()->randomElement($units),
        ];
    }
}