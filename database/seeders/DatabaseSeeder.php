<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\FamiliesTableSeeder;
use Database\Seeders\SubfamiliesTableSeeder;
use Database\Seeders\RatesTableSeeder;
use Database\Seeders\CustomerRateStatusesTableSeeder;
use Database\Seeders\CustomersTableSeeder;
use Database\Seeders\CustomerRatesTableSeeder;
use Database\Seeders\BranchesTableSeeder;
use Database\Seeders\ModalitiesTableSeeder;
use Database\Seeders\AppointmentStatusesTableSeeder;
use Database\Seeders\PaymentMethodsTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            RolesTableSeeder::class,
            FamiliesTableSeeder::class,
            SubfamiliesTableSeeder::class,
            RatesTableSeeder::class,
            CustomerRateStatusesTableSeeder::class,
            CustomersTableSeeder::class,
            BranchesTableSeeder::class,
            ModalitiesTableSeeder::class,
            AppointmentStatusesTableSeeder::class,
            PaymentMethodsTableSeeder::class,
        ]);
    }
}

