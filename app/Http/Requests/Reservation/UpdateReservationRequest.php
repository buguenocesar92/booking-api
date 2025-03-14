<?php

namespace App\Http\Requests\Reservation;

use App\Http\Requests\ApiFormRequest;

class UpdateReservationRequest extends ApiFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'nullable|boolean',
        ];
    }
}