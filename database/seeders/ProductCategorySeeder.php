<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductCategory::create([
            'name' => 'ALimentación',
            'description' => 'ALimentación',
        ]);

        ProductCategory::create([
            'name' => 'Electrodomésticos',
            'description' => 'Electrodomésticos'
        ]);

        ProductCategory::create([
            'name' => 'Hogar',
            'description' => 'Hogar'
        ]);

        ProductCategory::create([
            'name' => 'Tecnología',
            'description' => 'Tecnología'
        ]);
    }
}
