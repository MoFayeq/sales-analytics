<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::insert([
            ['name' => 'Coca-Cola', 'description' => 'Soft drink', 'price' => 1.50, 'stock' => 100],
            ['name' => 'Coffee', 'description' => 'Hot drink', 'price' => 2.00, 'stock' => 50],
            ['name' => 'Orange Juice', 'description' => 'Fresh juice', 'price' => 2.50, 'stock' => 70],
        ]);
    }
}
