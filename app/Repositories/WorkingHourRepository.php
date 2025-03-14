<?php

namespace App\Repositories;

use App\Models\WorkingHour;
use App\Repositories\Contracts\WorkingHourRepositoryInterface;

class WorkingHourRepository implements WorkingHourRepositoryInterface
{
    public function getWorkingHourByProfessionalAndDay(int $professionalId, string $dayOfWeek)
    {
        return WorkingHour::where('professional_id', $professionalId)
                          ->where('day_of_week', $dayOfWeek)
                          ->first();
    }
}
