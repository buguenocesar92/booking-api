<?php

namespace App\Repositories\Contracts;

interface ReservationRepositoryInterface
{
/*     public function getAll();
    public function findById(int $id); */
    public function create(array $data);
/*     public function update(int $id, array $data);
    public function delete(int $id); */
    public function getReservationsByProfessionalAndDate(int $professionalId, string $date);
    public function getReservationsByProfessional(int $professionalId);
}
