<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(User::with('profile')->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:client,professional',
            'is_premium' => 'boolean'
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['is_premium'] = $validated['is_premium'] ?? false;

        $user = User::create($validated);

        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('profile')->find($id);

        if (!$user)
            return response()->json(['message' => 'Usuario no encontrado'], 404);

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if (!$user) 
            return response()->json(['message' => 'Usuario no encontrado'], 404);

        $validated = $request->validate([
            'email' => 'email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'role' => 'in:client,professional',
            'is_premium' => 'boolean'
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!$user) 
            return response()->json(['message' => 'Usuario no encontrado'], 404);

        $user->delete();

        return response()->json(['message' => 'Usuario eliminado correctamente']);
    }
}
