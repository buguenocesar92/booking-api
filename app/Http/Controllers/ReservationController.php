<?php

namespace App\Http\Controllers;

use App\Events\NewReservationEvent;
use App\Services\ReservationService;
use App\Http\Requests\Reservation\StoreReservationRequest;
/* use App\Http\Requests\Reservation\UpdateReservationRequest; */
use App\Http\Requests\Reservation\AvailableSlotsRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    protected ReservationService $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

/*     public function index()
    {
        $data = $this->reservationService->getAll();
        return response()->json($data);
    } */

    public function store(StoreReservationRequest $request): JsonResponse
    {
        $data = $request->validated();
        $reservation = $this->reservationService->create($data);

        // Emitir el evento en tiempo real para el profesional
        broadcast(new NewReservationEvent($reservation, $reservation->professional_id));

        return response()->json($reservation, 201);
    }

  /*   public function show($id)
    {
        $data = $this->reservationService->findById($id);
        return response()->json($data);
    }

    public function update(UpdateReservationRequest $request, $id)
    {
        $data = $this->reservationService->update($id, $request->validated());
        return response()->json($data);
    }

    public function destroy($id)
    {
        $this->reservationService->delete($id);
        return response()->json(['message' => 'Reservation eliminado']);
    } */

    // Método para obtener los horarios disponibles para un profesional en una fecha
    public function availableSlots(AvailableSlotsRequest $request, int $id): JsonResponse
    {
        // 'date' se valida en el AvailableSlotsRequest
        $date = $request->validated()['date'];
        $slots = $this->reservationService->availableSlots($id, $date);
        return response()->json($slots);
    }

        /**
     * Devuelve las reservas del profesional autenticado.
     */
    public function professionalReservations(Request $request): JsonResponse
    {
        $user = $request->user();

        if (!$user || !$user->professional) {
            return response()->json(['message' => 'No autorizado o el usuario no es un profesional.'], 403);
        }
        $professionalId = $user->professional->id;
        $reservations = $this->reservationService->getReservationsForProfessional($professionalId);
        return response()->json($reservations);
    }
}
