<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiFormRequest;

class RegisterRequest extends ApiFormRequest
{
    /**
     * Determina si el usuario está autorizado a hacer esta solicitud.
     */
    public function authorize(): bool
    {
        return true; // Cambia a 'false' si quieres restringir el acceso.
    }

    /**
     * Obtiene las reglas de validación que se aplican a la solicitud.
     */
    public function rules(): array
    {
        return [
            'name'            => 'required|string|max:255',
            'email'           => 'required|string|email|max:255|unique:users',
            'password'        => 'required|string|min:8',
            'is_professional' => 'sometimes|boolean',  // Agregado para aceptar el campo
            // Si es profesional, valida los campos adicionales:
            'specialty'       => 'nullable|string|max:255',
            'image'           => 'nullable|string',
            'description'     => 'nullable|string',
        ];
    }

}
