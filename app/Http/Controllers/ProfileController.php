<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;	
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Profile::with('user')->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'full_name' => 'required|string|max:255',
            'province' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'avatar' => 'nullable|string|max:2048',
        ]);

        $user = User::find($request->user_id);

        if ($user && $user->role === 'professional') {
            $extraValidated = $request->validate([
                'profession' => 'nullable|string|max:255',
                'description' => 'nullable|string|max:1000',
                'availability' => 'nullable|boolean',
                'rating' => 'nullable|numeric|min:0|max:5',
            ]);

            $validated = array_merge($validated, $extraValidated);
        }

        $profile = Profile::create($validated);

        return response()->json($profile, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $profile = Profile::with('user')->find($id);

        if (!$profile) {
            return response()->json(['message' => 'Perfil no encontrado'], 404);
        }

        return response()->json($profile);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $profile = Profile::find($id);

        if (!$profile) {
            return response()->json(['message' => 'Perfil no encontrado'], 404);
        }

        $validated = $request->validate([
            'full_name' => 'sometimes|required|string|max:255',
            'province' => 'sometimes|nullable|string|max:255',
            'department' => 'sometimes|nullable|string|max:255',
            'address' => 'sometimes|nullable|string|max:255',
            'avatar' => 'nullable|string|max:2048',
        ]);

        $user = $profile->user;

        if ($user && $user->role === 'professional') {
            $extraValidated = $request->validate([
                'profession' => 'nullable|string|max:255',
                'description' => 'nullable|string|max:1000',
                'availability' => 'nullable|boolean',
                'rating' => 'nullable|numeric|min:0|max:5',
            ]);

            $validated = array_merge($validated, $extraValidated);
        }

        $profile->update($validated);

        return response()->json($profile, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $profile = Profile::find($id);

        if (!$profile) {
            return response()->json(['message' => 'Perfil no encontrado'], 404);
        }

        $profile->delete();

        return response()->json(['message' => 'Perfil eliminado con éxito'], 200);
    }
}
