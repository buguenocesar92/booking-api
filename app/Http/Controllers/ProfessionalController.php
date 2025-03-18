<?php

namespace App\Http\Controllers;

use App\Services\ProfessionalService;
use App\Http\Requests\Professional\StoreProfessionalRequest;
use App\Http\Requests\Professional\UpdateProfessionalRequest;
use Illuminate\Http\Request; // Asegúrate de importar Request


class ProfessionalController extends Controller
{
    protected ProfessionalService $professionalService;

    public function __construct(ProfessionalService $professionalService)
    {
        $this->professionalService = $professionalService;
    }

    public function index(Request $request)
    {
        $search = $request->query('search');
        $specialty = $request->query('specialty');
        $perPage = $request->query('per_page', 4); // Valor por defecto 10

        $data = $this->professionalService->getAll($search, $specialty, $perPage);
        return response()->json($data);
    }


/*     public function store(StoreProfessionalRequest $request)
    {
        $data = $this->professionalService->create($request->validated());
        return response()->json($data, 201);
    }
 */
    public function show($id)
    {
        $data = $this->professionalService->findById($id);
        return response()->json($data);
    }

/*     public function update(UpdateProfessionalRequest $request, $id)
    {
        $data = $this->professionalService->update($id, $request->validated());
        return response()->json($data);
    }

    public function destroy($id)
    {
        $this->professionalService->delete($id);
        return response()->json(['message' => 'Professional eliminado']);
    } */
}
