<?php

namespace App\Repositories;

use App\Repositories\Contracts\ProfessionalRepositoryInterface;
use App\Models\Professional;

class ProfessionalRepository implements ProfessionalRepositoryInterface
{
    public function getAll()
    {
        return Professional::all();
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
