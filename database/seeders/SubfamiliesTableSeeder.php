<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubfamiliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subfamilies')->insert([
            'family_id' => 1,
            'name' => 'Subfamilia 1',
            'is_enabled' => true,
            'required_admin_permission' => false,
        ]);
        DB::table('subfamilies')->insert([
            'family_id' => 1,
            'name' => 'Subfamilia 2',
            'is_enabled' => true,
            'required_admin_permission' => false,
        ]);
    }
}
