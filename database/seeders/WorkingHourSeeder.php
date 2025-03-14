<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WorkingHour;
use App\Models\Professional;

class WorkingHourSeeder extends Seeder
{
    public function run()
    {
        // Obtener todos los profesionales existentes
        $professionals = Professional::all();

        // Definir los días de la semana laborales
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

        // Asignar a cada profesional el mismo horario de trabajo para cada día
        foreach ($professionals as $professional) {
            foreach ($days as $day) {
                WorkingHour::create([
                    'professional_id' => $professional->id,
                    'day_of_week'     => $day,
                    'start_time'      => '09:00:00', // Formato de 24 horas
                    'end_time'        => '17:00:00',
                ]);
            }
        }
    }
}
