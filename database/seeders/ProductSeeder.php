<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $productCategories = ProductCategory::all();

        $products = [
            [
                'name' => 'Product 1',
                 'description' => 'Description of product 1',
                 'price' => 100,
                 'stock' => 10,
                 'product_category_id' => $productCategories->random()->id,
                 'min_stock' => 5,
            ],
            [
                'name' => 'Product 2',
                'description' => 'Description of product 2',
                'price' => 200,
                'stock' => 20,
                'product_category_id' => $productCategories->random()->id,
                'min_stock' => 10,
            ],
            [
                'name' => 'Product 3',
                'description' => 'Description of product 3',
                'price' => 300,
                'stock' => 30,
                'product_category_id' => $productCategories->random()->id,
                'min_stock' => 15,
            ],
            [
                'name' => 'Product 4',
                'description' => 'Description of product 4',
                'price' => 400,
                'stock' => 40,
                'product_category_id' => $productCategories->random()->id,
                'min_stock' => 20,
            ],
            [
                'name' => 'Product 5',
                'description' => 'Description of product 5',
                'price' => 500,
                'stock' => 50,
                'product_category_id' => $productCategories->random()->id,
                'min_stock' => 25,
            ],
            
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

    }
}
