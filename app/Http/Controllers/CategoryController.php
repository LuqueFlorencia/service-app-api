<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Obtener la lista de categorías, junto con sus subcategorías.
     */
    public function index()
    {
        return response()->json(Category::select('id','name')->with('subcategories:id,category_id,name')->get(), 200);
    }

    /**
     * Crear una nueva categoría.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        $validated['name'] = trim($validated['name']);

        $category = Category::create($validated);

        return response()->json($category, 201);
    }

    /**
     * Obtener una categoría específica por su ID, junto con sus subcategorías.
     */
    public function show(string $id)
    {
        $category = Category::select('id','name')->with('subcategories:id,category_id,name')->find($id);

        if (!$category) {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        }

        return response()->json($category);
    }

    /**
     * Modificar la información de una categoría existente.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
        ]);

        $category->update($validated);

        return response()->json($category, 200);
    }

    /**
     * Eliminar una categoría existente.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        }

        $category->delete();

        return response()->json(['message' => 'Categoría eliminada correctamente'], 200);
    }
}
