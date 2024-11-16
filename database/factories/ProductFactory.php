<?php

namespace Database\Factories;

use App\Models\Supplier;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Validation\Rules\Unique;

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
        $productNames = [
            'UltraBoost Running Shoes',
            'Ergonomic Office Chair',
            'Bluetooth Noise-Cancelling Headphones',
            'Smart Thermostat',
            '4K Ultra HD Television',
            'Organic Green Tea',
            'Wireless Gaming Mouse',
            'Portable Power Bank',
            'Stainless Steel Water Bottle',
            'Adjustable Standing Desk',
            'Anti-Glare Computer Screen',
            'Memory Foam Mattress',
            'Smartphone Gimbal Stabilizer',
            'Electric Pressure Cooker',
            'Travel Backpack with USB Port',
            'Indoor Plant Set',
            'LED Desk Lamp',
            'Portable Air Purifier',
            'Coffee Grinder',
            'Stainless Steel Cookware Set',
            'Noise-Isolating Earbuds',
            'Cordless Vacuum Cleaner',
            'Foldable Yoga Mat',
            'Gaming Keyboard with RGB Lights',
            'Wireless Earbuds with Charging Case',
            'Automatic Pet Feeder',
            'Solar-Powered Garden Lights',
            'Mini Projector',
            'Compact Hair Dryer',
            'Multi-Port USB Charger',
            'Electric Kettle',
            'Water-Resistant Bluetooth Speaker',
            'Home Security Camera System',
            'Smart Doorbell',
            'Adjustable Dumbbell Set',
            'Digital Air Fryer',
            'Portable Camping Stove',
            'Rechargeable LED Flashlight',
            'Magnetic Phone Car Mount',
            'Noise-Cancelling Sleeping Mask',
            'Touchscreen Laptop',
            'Weighted Blanket',
            'Cordless Electric Drill',
            'Bamboo Cutlery Set',
            'Portable Laptop Stand',
            'Essential Oil Diffuser',
            'Compact Toaster Oven',
            'Heavy-Duty Bike Lock',
            'Foldable Treadmill',
            'Wi-Fi Range Extender',
            'Ergonomic Wrist Rest',
            'Wireless Charging Pad',
            'Car Phone Holder',
            'UV Sanitizing Box',
            'Ceramic Knife Set',
            'Adjustable Tablet Stand',
            'BPA-Free Baby Bottle',
            'Glass Food Storage Containers',
            'Collapsible Laundry Basket',
            'Smart LED Light Bulbs',
            'Infrared Thermometer',
            'Massage Gun',
            'Bluetooth Fitness Tracker',
            'Non-Stick Frying Pan',
            'Bamboo Bath Caddy Tray',
            'Portable Blender',
            'Rechargeable Hand Warmer',
            'Pet Hair Remover Roller',
            'Electric Toothbrush',
            'Floating Pool Lounge Chair',
            'Vacuum Sealer Machine',
            'Stainless Steel Insulated Mug',
            'Wi-Fi Smart Plug',
            'Programmable Coffee Maker',
            'Anti-Theft Travel Bag',
            'Noise-Reducing Window Film',
            'Outdoor String Lights',
            'Fireproof Document Bag',
            'Electric Grill',
            'Laptop Cooling Pad',
            'Reusable Silicone Food Bags',
            'Portable Neck Massager',
            'Smart Water Bottle with Tracker',
            'Multi-Functional Tool Kit',
            'Electric Salt and Pepper Grinder',
            'Wireless Door/Window Sensor',
            'Noise-Isolating Wall Panels',
            'Car Dash Camera',
            'Eco-Friendly Dish Soap',
            'Inflatable Air Sofa',
            'Garden Hose with Sprayer',
            'Electric Milk Frother',
            'Memory Foam Travel Pillow',
            'Baby Monitor with Video',
            'Automatic Soap Dispenser',
            'Smart Body Weight Scale',
            'Solar Phone Charger',
            'Magnetic Screen Door',
            'Cordless Steam Iron',
            'Pop-Up Beach Tent',
            'Rolling Storage Cart',
            'Stainless Steel Travel Mug',
            'Expandable Garden Hose'
        ];
        

        return [
            'category_id' => Category::Factory(),
            'supplier_id' => Supplier::Factory(),
            'name' => fake()->unique()->randomElement($productNames),
            'sku' => fake()->unique()->numberBetween(1, 1000),
            'description' => fake()->text(100),
            'purchase_price' => fake()->numberBetween(50,500),
            'selling_price' => fake()->numberBetween(500, 1000),
            'stock' => fake()->numberBetween(1, 100),
        ];
    }
}
