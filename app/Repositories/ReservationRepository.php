<?php

namespace App\Repositories;

use App\Repositories\Contracts\ReservationRepositoryInterface;
use App\Models\Reservation;
use Carbon\Carbon;

class ReservationRepository implements ReservationRepositoryInterface
{
/*     public function getAll()
    {
        return Reservation::all();
    }

    public function findById(int $id)
    {
        return Reservation::findOrFail($id);
    }
 */
    public function create(array $data)
    {
        return Reservation::create($data);
    }

/*     public function update(int $id, array $data)
    {
        $model = Reservation::findOrFail($id);
        $model->update($data);
        return $model;
    }

    public function delete(int $id): void
    {
        $model = Reservation::findOrFail($id);
        $model->delete();
    } */

    public function getReservationsByProfessionalAndDate(int $professionalId, string $date)
    {
        // Obtiene los horarios reservados para un profesional en una fecha dada
        return Reservation::where('professional_id', $professionalId)
            ->where('date', $date)
            ->get()
            ->map(function ($reservation) {
                // Convierte la hora almacenada a formato 'h:i A' para que coincida con $allSlots
                return Carbon::parse($reservation->time)->format('h:i A');
            })->toArray();
    }

    public function getReservationsByProfessional(int $professionalId)
    {
        return Reservation::where('professional_id', $professionalId)->get();
    }
}
