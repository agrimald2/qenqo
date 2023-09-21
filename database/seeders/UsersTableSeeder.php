<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Administrador',
            'lastname' => 'Sistema',
            'phone' => '51934094501',
            'email' => 'admin@qenqo.com',
            'password' => bcrypt('123456789'),
            'role_id' => 1,
            'is_enabled' => true
        ]);
        DB::table('users')->insert([
            'name' => 'Entrenador',
            'lastname' => 'Sistema',
            'phone' => '51934094502',
            'email' => 'entreador@qenqo.com',
            'password' => bcrypt('123456789'),
            'role_id' => 2,
            'is_enabled' => true
        ]);
        DB::table('users')->insert([
            'name' => 'Nutricionista',
            'lastname' => 'Qenqo',
            'phone' => '51934094503',
            'email' => 'nutri@qenqo.com',
            'password' => bcrypt('123456789'),
            'role_id' => 3,
            'is_enabled' => true
        ]);
    }
}
