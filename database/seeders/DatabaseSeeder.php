<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function Pest\Laravel\call;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        User::factory()->create([
            'names' => 'Omar Lezcano',
            'username' => 'admin',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'names' => 'Usuario',
            'username' => 'usuario', 
            'role' => 'user',           
        ]);

        $this->call([
            PaymentMethodSeeder::class,
            ProductCategorySeeder::class,
            SupplierSeeder::class,
            ProductSeeder::class,
            PurchaseSeeder::class,
            SaleSeeder::class,
        ]);
        
    }
}
