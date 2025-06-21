<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;	
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(User::select('id','email','role','is_premium')->get(), 200);
    }

    public function me(Request $request)
    {
        $user = $request->user()->load('profile');

        $user->makeHidden(['created_at', 'updated_at', 'email_verified_at']);

        if ($user->profile) {
            $user->profile->makeHidden(['created_at', 'updated_at']);
            if ($user->role === 'professional') {
                $user->profile->makeVisible(['profession', 'description', 'availability', 'rating']);
            } else {
                $user->profile->makeHidden(['profession', 'description', 'availability', 'rating']);
            }
        }

        return response()->json($user);
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
            ]);

            $validated = array_merge($validated, $extraValidated);
        }

        $profile->update($validated);

        return response()->json($profile, 200);
    }

    /**
     * Update the specified resource in storage.
     * Este metodo actualiza el estado premium de un usuario.
     */
    public function updatePremium(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        // Cambiar el estado a su valor opuesto
        $user->is_premium = !$user->is_premium;
        $user->save();

        return response()->json([
            'message' => 'Estado premium actualizado',
            'user' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::with('profile')->find($id);

        if (!$user) 
            return response()->json(['message' => 'Usuario no encontrado'], 404);

        $user->delete();

        return response()->json(['message' => 'Usuario eliminado correctamente']);
    }
}
