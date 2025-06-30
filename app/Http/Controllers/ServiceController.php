<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Obtener la lista de servicios, acompañados de sus subcategorías y profesionales.
     */
    public function index()
    {
        return response()->json(Service::select('id','user_id','subcategory_id','name','description','price')->with([
            'subcategory:id,name',
            'professional:id,email',
            'professional.profile:id,user_id,full_name'
        ])->get(), 200);
    }

    /**
     * Crear un nuevo servicio (solo los profesionales).
     */
    public function store(Request $request)
    {
        $user = $request->user();
        if ($user->role !== 'professional') {
            return response()->json(['message' => 'Solo los profesionales pueden crear servicios.'], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'subcategory_id' => 'required|exists:subcategories,id',
            'price' => 'nullable|numeric|min:0',
        ]);

        $validated['user_id'] = $user->id;
        $validated['name'] = trim($validated['name']);

        if (isset($validated['description'])) {
            $validated['description'] = trim($validated['description']);
        }

        $service = Service::create($validated);

        return response()->json($service, 201);
    }

    /**
     * Obtener un servicio específico por su ID, junto con su subcategoría y profesional.
     */
    public function show(string $id)
    {
        $service = Service::select('id','user_id','subcategory_id','name','description','price')->with([
            'subcategory:id,name',
            'professional:id,email',
            'professional.profile:id,user_id,full_name'
            ])->find($id);

        if (!$service) {
            return response()->json(['message' => 'Servicio no encontrado'], 404);
        }

        return response()->json($service);
    }

    /**
     * Actualizar un servicio existente (solo los profesionales).
     */
    public function update(Request $request, string $id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json(['message' => 'Servicio no encontrado'], 404);
        }

        if ($request->user()->role !== 'professional' || $request->user()->id !== $service->user_id) {
            return response()->json(['message' => 'No autorizado para modificar este servicio.'], 403);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
        ]);

        $service->update($validated);

        return response()->json($service);
    }

    /**
     * Eliminar un servicio (solo los profesionales).
     */
    public function destroy(Request $request, string $id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['message' => 'Servicio no encontrado'], 404);
        }

        if (
            $request->user()->role !== 'professional' ||
            $request->user()->id !== $service->user_id
        ) {
            return response()->json(['message' => 'No autorizado para eliminar este servicio.'], 403);
        }

        $service->delete();

        return response()->json(['message' => 'Servicio eliminado correctamente']);
    }
}
