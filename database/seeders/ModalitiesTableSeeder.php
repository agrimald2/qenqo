<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModalitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('modalities')->insert([
            'name' => 'Presencial',
            'description' => 'En una de las sucursales de Qenqo',
            'is_enabled' => true,
            'required_admin_permission' => false,
        ]);
        DB::table('modalities')->insert([
            'name' => 'Online',
            'description' => 'Por medio de Zoom',
            'is_enabled' => true,
            'required_admin_permission' => false,
        ]);
        DB::table('modalities')->insert([
            'name' => 'A domicilio',
            'description' => 'Visita a domicilio',
            'is_enabled' => true,
            'required_admin_permission' => false,
        ]);
    }
}
