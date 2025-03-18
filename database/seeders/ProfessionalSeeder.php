<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Professional;
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

        $faker = Faker::create('es_ES'); // Usamos el locale español para datos en español

        // Lista de especialidades para elegir aleatoriamente
        $specialties = [
            'Medicina General',
            'Psicología',
            'Ingeniería',
            'Nutrición',
            'Dermatología',
            'Cardiología',
            'Odontología',
            'Fisioterapia',
            'Pediatría',
            'Ginecología'
        ];

        // Crear 20 profesionales
        for ($i = 1; $i <= 20; $i++) {
            // Crear usuario asociado al profesional
            $user = User::create([
                'name'     => $faker->name,
                'email'    => $faker->unique()->safeEmail,
                'password' => Hash::make('password'), // Contraseña de prueba
            ]);

            $user->assignRole('professional');

            // Seleccionar una especialidad aleatoria
            $specialty = $specialties[array_rand($specialties)];

            // Crear el profesional
            Professional::create([
                'user_id'     => $user->id,
                'name'        => $user->name, // Asignamos el nombre del usuario
                'specialty'   => $specialty,
                'image'       => "https://picsum.photos/seed/pro{$i}/300/300",
                'description' => $faker->sentence(10) // Descripción generada aleatoriamente
            ]);
        }
    }
}
