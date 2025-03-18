<?php

namespace App\Services;

use App\Repositories\Contracts\ProfessionalRepositoryInterface;

class ProfessionalService
{
    private ProfessionalRepositoryInterface $repository;

    public function __construct(ProfessionalRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll($search = null, $specialty = null, $perPage = 4)
    {
        return $this->repository->getAll($search, $specialty, $perPage);
    }


    public function findById(int $id)
    {
        return $this->repository->findById($id);
    }
/*
    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete(int $id): void
    {
        $this->repository->delete($id);
    } */
}
