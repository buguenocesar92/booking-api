<?php

namespace App\Repositories;

use App\Repositories\Contracts\ProfessionalRepositoryInterface;
use App\Models\Professional;

class ProfessionalRepository implements ProfessionalRepositoryInterface
{

    public function getAll($search = null, $specialty = null, $perPage = 4)
    {
        $query = Professional::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                ->orWhere('specialty', 'LIKE', "%{$search}%");
            });
        }

        if ($specialty) {
            $query->where('specialty', $specialty);
        }

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
