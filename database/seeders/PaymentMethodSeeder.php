<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentMethod::create([
            'name' => 'Efectivo',
            'description' => 'Pago en efectivo',
        ]);

        PaymentMethod::create([
            'name' => 'Tarjeta de crédito',
            'description' => 'Pago con tarjeta de crédito',
        ]);

        PaymentMethod::create([
            'name' => 'Tarjeta de débito',
            'description' => 'Pago con tarjeta de débito',
        ]);

        PaymentMethod::create([
            'name' => 'Transferencia bancaria',
            'description' => 'Pago por transferencia bancaria',
        ]);
    }
}
