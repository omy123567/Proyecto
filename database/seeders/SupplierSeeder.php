<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                'name' => 'Proveedor 1',
                'email' => 'proveedor1@gmail.com',
                'phone' => '3704111222',
                'address' => 'Dirección del proveedor 1',
                'observations' => 'Observaciones del proveedor 1, si las hubiera',
            ],
            [
                'name' => 'Proveedor 2',
                'email' => 'proveedor2@gmail.com',
                'phone' => '3704111333',
                'address' => 'Dirección del proveedor 2',
                'observations' => 'Observaciones del proveedor 2, si las hubiera',
            ],
            [
                'name' => 'Proveedor 3',
                'email' => 'proveedor3@gmail.com',
                'phone' => '3704111444',
                'address' => 'Dirección del proveedor 3',
                'observations' => 'Observaciones del proveedor 3, si las hubiera',
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
