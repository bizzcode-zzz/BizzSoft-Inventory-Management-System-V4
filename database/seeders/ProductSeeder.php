<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::firstOrCreate(
            [
                'name' => 'Coke',
            ],
            [
                'price' => 25.00,
                'stock' => 100,
                'category_id' => 1,
            ]
        );
    }
}