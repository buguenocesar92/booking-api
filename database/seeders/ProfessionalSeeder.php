<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Professional;
use App\Models\Specialty;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ProfessionalSeeder extends Seeder
{
    public function run()
    {
        // Asegúrate de que exista el rol "professional" para el guard "api"
        if (!Role::where('name', 'professional')->where('guard_name', 'api')->exists()) {
            Role::create(['name' => 'professional', 'guard_name' => 'api']);
        }

        // Obtener todas las especialidades disponibles
        $specialties = Specialty::all();

        // Datos predefinidos de los profesionales
        $professionals = [
            [
                'name'        => 'Juan Pérez',
                'email'       => 'juan.perez@example.com',
                'description' => 'Experto en salud y bienestar.',
            ],
            [
                'name'        => 'María Gómez',
                'email'       => 'maria.gomez@example.com',
                'description' => 'Especialista en nutrición y dietética.',
            ],
            [
                'name'        => 'Carlos Sánchez',
                'email'       => 'carlos.sanchez@example.com',
                'description' => 'Profesional en terapias alternativas.',
            ],
            [
                'name'        => 'Laura Rodríguez',
                'email'       => 'laura.rodriguez@example.com',
                'description' => 'Experta en medicina deportiva.',
            ],
            [
                'name'        => 'Ana Martínez',
                'email'       => 'ana.martinez@example.com',
                'description' => 'Especialista en fisioterapia y rehabilitación.',
            ],
            [
                'name'        => 'Miguel López',
                'email'       => 'miguel.lopez@example.com',
                'description' => 'Consultor en salud mental.',
            ],
        ];

        // Crear 6 profesionales
        foreach ($professionals as $index => $data) {
            // Crear usuario asociado al profesional
            $user = User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => Hash::make('password'),
            ]);

            $user->assignRole('professional');

            // Elegir una especialidad aleatoriamente
            $specialty = $specialties->random();

            // Crear el profesional
            Professional::create([
                'user_id'      => $user->id,
                'name'         => $data['name'],
                'specialty_id' => $specialty->id,
                'image'        => "https://picsum.photos/seed/pro" . ($index + 1) . "/300/300",
                'description'  => $data['description'],
            ]);
        }
    }
}
