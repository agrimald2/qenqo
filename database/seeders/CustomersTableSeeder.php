<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customers')->insert([
            'dni' => 77035606,
            'name' => "ALONSO",
            'lastname' => "GRIMALDO",
            'phone' => "51934094501",
            'token' => "1-2607",
            'birthdate' => "2002-07-26",
            'sex' => "M"
        ]);
    }
}
