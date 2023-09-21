<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerRatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customer_rates')->insert([
            'customer_id' => 1,
            'rate_name' => 'Tarifa de Prueba',
            'rate_description' => 'Incluye Dieta',
            'rate_total_price' => 1000,
            'rate_total_sessions' => 20,
            'nutritional_assessment_total' => 2,
            'max_freeze_days' => 7,
            'start_day' => '2023-09-19',
            'end_day' => '2023-10-19',
            'added_by' => 'Cliente',
        ]);
    }
}
