<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rates')->insert([
            'subfamily_id' => 1,
            'name' => 'Tarifa de Prueba',
            'description' => 'Incluye Dieta',
            'price' => '1000',
            'stock' => '20',
            'duration' => '30',
            'haveDiet' => true,
            'nutritional_assessments' => 2,
            'max_freeze_days' => 7,
        ]);
    }
}
