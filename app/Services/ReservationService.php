<?php

namespace App\Services;

use App\Models\Reservation;
use App\Models\WorkingHour;
use App\Repositories\Contracts\ReservationRepositoryInterface;
use App\Repositories\Contracts\WorkingHourRepositoryInterface;
use Carbon\Carbon;
use Exception;

class ReservationService
{
    private ReservationRepositoryInterface $reservationRepo;
    private WorkingHourRepositoryInterface $workingHourRepo;

    public function __construct(
        ReservationRepositoryInterface $reservationRepo,
        WorkingHourRepositoryInterface $workingHourRepo
    ) {
        $this->reservationRepo = $reservationRepo;
        $this->workingHourRepo = $workingHourRepo;
    }

/*     public function getAll()
    {
        return $this->repository->getAll();
    }

    public function findById(int $id)
    {
        return $this->repository->findById($id);
    }
 */
    public function create(array $data)
    {
        $professionalId = $data['professional_id'];
        $date = $data['date'];
        $time = $data['time'];
        $duration = 60; // duración en minutos

        // Combina la fecha y la hora solicitada
        $requestedStart = Carbon::createFromFormat('Y-m-d h:i A', $date . ' ' . $time);
        $requestedEnd = $requestedStart->copy()->addMinutes($duration);

        // Obtener las reservas ya existentes para ese profesional y fecha a través del repository
        $reservedSlots = $this->reservationRepo->getReservationsByProfessionalAndDate($professionalId, $date);

        // Validar superposición de horarios
        foreach ($reservedSlots as $reservedTime) {
            // Convertir el horario reservado al mismo formato
            $existingStart = Carbon::createFromFormat('h:i A', $reservedTime);
            $existingEnd = $existingStart->copy()->addMinutes($duration);
            if ($requestedStart->lt($existingEnd) && $requestedEnd->gt($existingStart)) {
                throw new Exception('El horario seleccionado ya está ocupado.');
            }
        }

        return $this->reservationRepo->create($data);
    }

/*     public function update(int $id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete(int $id): void
    {
        $this->repository->delete($id);
    } */

    public function availableSlots(int $professionalId, string $date)
    {
        // Convertir la fecha a Carbon para obtener el día de la semana
        $carbonDate = Carbon::parse($date);
        $dayOfWeek = $carbonDate->format('l'); // Ejemplo: Monday, Tuesday, etc.

        // Obtener el horario laboral para el profesional y el día de la semana usando el WorkingHourRepository
        $workingHour = $this->workingHourRepo->getWorkingHourByProfessionalAndDay($professionalId, $dayOfWeek);

        if (!$workingHour) {
            return [];
        }

        // Convertir el horario laboral a objetos Carbon
        $startTime = Carbon::parse($workingHour->start_time);
        $endTime = Carbon::parse($workingHour->end_time);
        $interval = 60; // minutos

        $slots = [];
        for ($time = $startTime->copy(); $time->lte($endTime); $time->addMinutes($interval)) {
            $slots[] = $time->format('h:i A');
        }

        // Obtener los slots ya reservados a través del repository
        $reservedSlots = $this->reservationRepo->getReservationsByProfessionalAndDate($professionalId, $date);
        $availableSlots = array_values(array_diff($slots, $reservedSlots));

        return $availableSlots;
    }

    public function getReservationsForProfessional(int $professionalId)
    {
        return $this->reservationRepo->getReservationsByProfessional($professionalId);
    }
}
