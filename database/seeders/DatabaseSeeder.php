<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            SpecialtySeeder::class,
            ProfessionalSeeder::class,
            WorkingHourSeeder::class,
            ReservationSeeder::class,
            RolesAndPermissionsSeeder::class,
            AdminUserSeeder::class,
        ]);
    }
}
