<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payment_methods')->insert([
            'name' => 'Efectivo',
            'description' => '',
            'is_enabled' => true,
            'required_admin_permission' => false,
        ]);
        DB::table('payment_methods')->insert([
            'name' => 'On-line',
            'description' => 'Pasarela de pagos OpenPay',
            'is_enabled' => true,
            'required_admin_permission' => false,
        ]);
        DB::table('payment_methods')->insert([
            'name' => 'Transferencia BCP',
            'description' => 'CC: 0000111122223333',
            'is_enabled' => true,
            'required_admin_permission' => true,
        ]);
    }
}
