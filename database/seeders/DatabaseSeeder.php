<?php

namespace Database\Seeders;

use App\Models\AppSettings;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@stockify.com',
            'role' => 'admin'
        ]);
        User::factory()->create([
            'name' => 'Manager',
            'email' => 'manager@stockify.com',
            'role' => 'manajer_gudang'
        ]);
        User::factory()->create([
            'name' => 'Staff',
            'email' => 'staff@stockify.com',
            'role' => 'staff_gudang'
        ]);

        Product::factory()->count(50)->create();

        AppSettings::factory()->create();
    }
}
