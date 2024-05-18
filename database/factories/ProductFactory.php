<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->name,
            'description' => fake()->text,
            'img_path' => 'ramen.png',
            'price' => fake()->numberBetween(5, 30),
            'weight' => fake()->numberBetween(100, 300),
            'is_active' => fake()->boolean(true),
            'category_id' => fake()->numberBetween(1,1),
            'product_attribute_id' => fake()->numberBetween(1,1),
        ];
    }
}
