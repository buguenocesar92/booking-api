<?php

namespace App\Http\Requests\Reservation;

use App\Http\Requests\ApiFormRequest;

class AvailableSlotsRequest extends ApiFormRequest
{
    public function authorize(): bool
    {
        // Puedes agregar lógica de autorización si es necesario.
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => 'required|date'
        ];
    }
}
