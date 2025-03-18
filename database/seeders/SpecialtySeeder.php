<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialtySeeder extends Seeder
{
    public function run()
    {
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

        foreach ($specialties as $name) {
            Specialty::create(['name' => $name]);
        }
    }
}
