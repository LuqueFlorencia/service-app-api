<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'subcategory_id' => 'required|exists:subcategories,id',
            'user_id' => 'required|exists:users,id',
            'price' => 'nullable|numeric|min:0',
        ]);

        $validated['name'] = trim($validated['name']);
        if (isset($validated['description'])) {
            $validated['description'] = trim($validated['description']);
        }

        $service = Service::create($validated);

        return response()->json($service, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $service = Service::select('id','user_id','subcategory_id','name','description','price')->with([
            'subcategory:id,name',
            'professional:id,email',
            'professional.profile:id,user_id,full_name'
            ])->find($id);
        if (!$service)
            return response()->json(['message' => 'Servicio no encontrado'], 404);

        return response()->json($service);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $service = Service::find($id);
        if (!$service)
            return response()->json(['message' => 'Servicio no encontrado'], 404);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
        ]);

        $service->update($validated);

        return response()->json($service);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::find($id);
        
        if (!$service)
            return response()->json(['message' => 'Servicio no encontrado'], 404);

        $service->delete();

        return response()->json(['message' => 'Servicio eliminado correctamente']);
    }
}
