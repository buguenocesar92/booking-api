<?php

namespace App\Http\Requests\Reservation;

use App\Http\Requests\ApiFormRequest;

class StoreReservationRequest extends ApiFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'professional_id' => 'required|exists:professionals,id',
            'name' => 'required|string',
            'email' => 'required|email',
            'date'  => 'required|date|after_or_equal:today',
            'time' => 'required|string',
            'message' => 'nullable|string',
        ];
    }

}
