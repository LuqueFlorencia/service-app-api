<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Obtener la lista de subcategorías.
     */
    public function index()
    {
        return response()->json(Subcategory::select('id','category_id','name')->get(), 200);
    }

    /**
     * Crear una nueva subcategoría.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:subcategories,name',
            'category_id' => 'required|exists:categories,id',
        ]);

        $subcategory = Subcategory::create($validated);

        return response()->json($subcategory, 201);
    }

    /**
     * Obtener una subcategoría específica por su ID, junto con su categoría.
     */
    public function show(string $id)
    {
        $subcategory = Subcategory::select('id','category_id','name')->with('category:id,name')->find($id);

        if (!$subcategory) {
            return response()->json(['message' => 'Subcategoría no encontrada'], 404);
        }

        return response()->json($subcategory);
    }

    /**
     * Modificar la información de una subcategoría existente.
     */
    public function update(Request $request, string $id)
    {
        $subcategory = Subcategory::find($id);

        if (!$subcategory) {
            return response()->json(['message' => 'Subcategoría no encontrada'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:subcategories,name,'
        ]);

        $validated['name'] = trim($validated['name']);

        $subcategory->update($validated);

        return response()->json($subcategory, 200);
    }

    /**
     * Eliminar una subcategoría existente.
     */
    public function destroy(string $id)
    {
        $subcategory = Subcategory::find($id);

        if (!$subcategory) {
            return response()->json(['message' => 'Subcategoría no encontrada'], 404);
        }

        $subcategory->delete();

        return response()->json(['message' => 'Subcategoría eliminada correctamente'], 200);
    }
}
