<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('branches')->insert([
            'name' => 'Surco',
            'address' => 'Manuel Olguín 394',
            'reference' => 'Atrás del tambo',
            'maps_link' => 'https://maps.app.goo.gl/zZgUXRvEy3owKjU48',
        ]);
    }
}
