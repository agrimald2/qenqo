<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerRateStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customer_rate_statuses')->insert([
            ['name' => 'En Proceos'],
            ['name' => 'Terminado'],
            ['name' => 'Abandonado'],
            ['name' => 'Anulado'],
        ]);
    }
}
