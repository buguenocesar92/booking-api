<?php

namespace Database\Seeders;

use App\Models\Professional;
use App\Models\Reservation;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    public function run()
    {
        // Obtiene el primer profesional disponible
        $professional = Professional::first();

        if (!$professional) {
            $this->command->info('No hay profesionales disponibles para asociar reservas.');
            return;
        }

        Reservation::create([
            'professional_id' => $professional->id, // Usa el ID del profesional encontrado
            'name'            => 'Juan Pérez',
            'email'           => 'juan@example.com',
            'date'            => '2023-04-01',
            'time'            => '10:00 AM',
            'message'         => 'Necesito una consulta general.',
        ]);
    }
}
