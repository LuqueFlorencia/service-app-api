<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Subcategory::select('id','category_id','name')->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
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
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
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
