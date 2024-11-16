<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'Electronics',
            'Home Appliances',
            'Furniture',
            'Sports & Outdoors',
            'Fashion',
            'Beauty & Personal Care',
            'Health & Wellness',
            'Automotive',
            'Toys & Games',
            'Books',
            'Groceries',
            'Kitchenware',
            'Gardening & Outdoor',
            'Pet Supplies',
            'Baby Products',
            'Fitness & Exercise',
            'Office Supplies',
            'Tools & Home Improvement',
            'Travel & Luggage',
            'Smart Home',
            'Music & Instruments',
            'Video Games & Consoles',
            'Photography & Cameras',
            'Food & Beverages',
            'Stationery & Crafts',
            'Seasonal & Holiday',
            'Cell Phones & Accessories',
            'Computer & Tech',
            'Cleaning Supplies',
            'Party & Occasions'
        ];
        
        return [
            'name' => fake()->randomElement($categories),
            'description' => fake()->text(100),
        ];
    }
}
