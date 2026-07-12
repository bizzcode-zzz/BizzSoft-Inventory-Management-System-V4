<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    \App\Models\Category::create([
        'category_name' => 'Beverages'
    ]);

    \App\Models\Category::create([
        'category_name' => 'Snacks'
    ]);

    \App\Models\Category::create([
        'category_name' => 'Noodles'
    ]);
}
}
