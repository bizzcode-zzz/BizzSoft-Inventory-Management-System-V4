<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::firstOrCreate([
            'category_name' => 'Beverages',
        ]);

        Category::firstOrCreate([
            'category_name' => 'Snacks',
        ]);

        Category::firstOrCreate([
            'category_name' => 'Noodles',
        ]);
    }
}