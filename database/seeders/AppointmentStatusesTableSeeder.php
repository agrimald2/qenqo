<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppointmentStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('appointment_statuses')->insert([
            'name' => 'Confirmada',
            'name' => 'Cancelada',
            'name' => 'Asistió',
            'name' => 'No Asistió',
        ]);
    }
}
