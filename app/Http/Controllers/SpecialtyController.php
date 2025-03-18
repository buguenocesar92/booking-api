<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    public function index()
    {
        $specialties = Specialty::all();

        // Retorna un JSON con las especialidades
        return response()->json($specialties);
    }
}
