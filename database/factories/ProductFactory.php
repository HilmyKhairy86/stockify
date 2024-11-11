<?php

namespace Database\Factories;

use App\Models\Supplier;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
            'category_id' => Category::Factory(),
            'supplier_id' => Supplier::Factory(),
            'name' => fake()->unique()->word(),
            'sku' => fake()->unique()->numberBetween(1, 40),
            'description' => fake()->text(100),
            'purchase_price' => fake()->numberBetween(50,1000),
            'selling_price' => fake()->numberBetween(100, 2000),
        ];
    }
}
