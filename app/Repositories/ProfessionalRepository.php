<?php

namespace App\Repositories;

use App\Repositories\Contracts\ProfessionalRepositoryInterface;
use App\Models\Professional;

class ProfessionalRepository implements ProfessionalRepositoryInterface
{

    public function getAll($search = null, $specialty = null, $perPage = 10)
    {
        // Iniciamos la consulta e incluimos la relación 'specialty'
        $query = Professional::query()->with('specialty')
                  ->leftJoin('specialties', 'professionals.specialty_id', '=', 'specialties.id');

        // Filtro general para el término de búsqueda, en nombre del profesional o en el nombre de la especialidad (LIKE)
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('professionals.name', 'LIKE', "%{$search}%")
                  ->orWhere('specialties.name', 'LIKE', "%{$search}%");
            });
        }

        // Filtro específico para la especialidad usando coincidencia exacta
        if ($specialty) {
            $query->where('specialties.name', $specialty);
        }

        // Seleccionamos únicamente las columnas de la tabla professionals para evitar ambigüedades
        $query->select('professionals.*');

        return $query->paginate($perPage);
    }



    public function findById(int $id)
    {
        return Professional::findOrFail($id);
    }

    public function create(array $data)
    {
        return Professional::create($data);
    }

    public function update(int $id, array $data)
    {
        $model = Professional::findOrFail($id);
        $model->update($data);
        return $model;
    }

    public function delete(int $id): void
    {
        $model = Professional::findOrFail($id);
        $model->delete();
    }
}
