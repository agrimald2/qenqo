<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FamiliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('families')->insert([
            'name' => 'Familia 1',
            'is_enabled' => true,
            'required_admin_permission' => false,
        ]);
    }
}
