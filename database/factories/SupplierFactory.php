<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $suppliers = [
            'Nike',
            'Adidas',
            'Apple',
            'Samsung',
            'Sony',
            'LG',
            'Bose',
            'Canon',
            'Dell',
            'HP',
            'Lenovo',
            'Microsoft',
            'Asus',
            'Philips',
            'Panasonic',
            'Bose',
            'Fitbit',
            'Xiaomi',
            'Anker',
            'GoPro',
            'Seiko',
            'Casio',
            'Razer',
            'Fossil',
            'Tommy Hilfiger',
            'KitchenAid',
            'Cuisinart',
            'Breville',
            'Hamilton Beach',
            'Dyson'
        ];
        
        return [
            'name' => fake()->randomElement($suppliers),
            'address' => fake()->unique()->address(),
            'phone' => fake()->unique()->phoneNumber(),
            'email' => fake()->unique()->email(),
        ];
    }
}
