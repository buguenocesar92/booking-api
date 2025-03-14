<?php

namespace App\Http\Requests\Professional;

use App\Http\Requests\ApiFormRequest;

class UpdateProfessionalRequest extends ApiFormRequest
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