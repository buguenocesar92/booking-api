<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Professional;
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

        // Profesional 1: Dra. Pérez
        $user1 = User::create([
            'name'     => 'Dra. Pérez',
            'email'    => 'perez@example.com',
            'password' => Hash::make('password'), // contraseña de prueba
        ]);
        $user1->assignRole('professional');

        Professional::create([
            'user_id'     => $user1->id,
            'name'        => $user1->name, // asigna el nombre del usuario
            'specialty'   => 'Médica',
            'image'       => 'https://picsum.photos/seed/pro1/300/300',
            'description' => 'Especialista en medicina general.',
        ]);

        // Profesional 2: Lic. Gómez
        $user2 = User::create([
            'name'     => 'Lic. Gómez',
            'email'    => 'gomez@example.com',
            'password' => Hash::make('password'),
        ]);
        $user2->assignRole('professional');

        Professional::create([
            'user_id'     => $user2->id,
            'name'        => $user2->name, // asigna el nombre del usuario
            'specialty'   => 'Psicólogo',
            'image'       => 'https://picsum.photos/seed/pro2/300/300',
            'description' => 'Experto en salud mental y terapias de pareja.',
        ]);

        // Profesional 3: Ing. López
        $user3 = User::create([
            'name'     => 'Ing. López',
            'email'    => 'lopez@example.com',
            'password' => Hash::make('password'),
        ]);
        $user3->assignRole('professional');

        Professional::create([
            'user_id'     => $user3->id,
            'name'        => $user3->name, // asigna el nombre del usuario
            'specialty'   => 'Consultor',
            'image'       => 'https://picsum.photos/seed/pro3/300/300',
            'description' => 'Consultor en ingeniería y tecnología.',
        ]);
    }
}
