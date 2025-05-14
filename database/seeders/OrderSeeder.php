<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::insert([
            ['product_id' => 1, 'quantity' => 2, 'price' => 3.00, 'date' => now()],
            ['product_id' => 2, 'quantity' => 1, 'price' => 2.00, 'date' => now()],
            ['product_id' => 3, 'quantity' => 3, 'price' => 7.50, 'date' => now()],
        ]);
    }
}
