<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->words(3, true);
        return [
            'name' => ucwords($name),
            'slug' => \Illuminate\Support\Str::slug($name) . '-' . fake()->unique()->numberBetween(1000, 9999),
            'description' => fake()->paragraph(3),
            'price' => fake()->randomFloat(2, 10000, 5000000),
            'stock' => fake()->numberBetween(0, 500),
            'image' => 'https://picsum.photos/seed/' . fake()->unique()->numberBetween(1, 1000) . '/400/300',
            'category_id' => \App\Models\Category::factory(),
        ];
    }
}