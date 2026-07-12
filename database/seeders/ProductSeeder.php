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
     Product::create([
    'name' => 'Coke',
    'price' => 25.00,
    'stock' => 100,
    'category_id' => 1,
]);
    }
}
