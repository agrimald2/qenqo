<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('schedules')->insert([
            'user_id' => 2,
            'week_day' => 1,
            'start_time' => "09:00",
            'end_time' => "10:00",
            'modality_id' => 1,
            'branch_id' => 1,
        ]);
        DB::table('schedules')->insert([
            'user_id' => 2,
            'week_day' => 1,
            'start_time' => "12:00",
            'end_time' => "13:00",
            'modality_id' => 1,
            'branch_id' => 1,
        ]);
        DB::table('schedules')->insert([
            'user_id' => 2,
            'week_day' => 2,
            'start_time' => "09:00",
            'end_time' => "10:00",
            'modality_id' => 1,
            'branch_id' => 1,
        ]);
    }
}
