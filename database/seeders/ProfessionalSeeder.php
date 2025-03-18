<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Professional;
use App\Models\Specialty;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Faker\Factory as Faker;

class ProfessionalSeeder extends Seeder
{
    public function run()
    {
        // Asegúrate de que exista el rol "professional" para el guard "api"
        if (!Role::where('name', 'professional')->where('guard_name', 'api')->exists()) {
            Role::create(['name' => 'professional', 'guard_name' => 'api']);
        }

        $faker = Faker::create('es_ES');

        // Obtener todas las especialidades disponibles
        $specialties = Specialty::all();

        // Crear 20 profesionales
        for ($i = 1; $i <= 20; $i++) {
            // Crear usuario asociado al profesional
            $user = User::create([
                'name'     => $faker->name,
                'email'    => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
            ]);

            $user->assignRole('professional');

            // Elegir una especialidad aleatoriamente de la tabla specialties
            $specialty = $specialties->random();

            // Crear el profesional
            Professional::create([
                'user_id'     => $user->id,
                'name'        => $user->name,
                'specialty_id'=> $specialty->id,
                'image'       => "https://picsum.photos/seed/pro{$i}/300/300",
                'description' => $faker->sentence(10),
            ]);
        }
    }
}
