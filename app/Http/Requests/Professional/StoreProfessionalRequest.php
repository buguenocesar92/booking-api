<?php

namespace App\Http\Requests\Professional;

use App\Http\Requests\ApiFormRequest;

class StoreProfessionalRequest extends ApiFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'nullable|boolean',
        ];
    }
}