<?php

namespace App\Repositories\Contracts;

interface WorkingHourRepositoryInterface
{
    public function getWorkingHourByProfessionalAndDay(int $professionalId, string $dayOfWeek);
}
