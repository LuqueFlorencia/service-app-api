<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role'     => 'required|in:client,professional',

            // Datos del perfil
            'full_name' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'avatar' => 'nullable|string|max:2048',

            // Solo si es profesional
            'profession' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'availability' => 'nullable|string|max:255',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        $user = User::create([
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
            'is_premium' => false,
        ]);

        $profileData = [
            'user_id' => $user->id,
            'full_name' => $validated['full_name'],
            'province' => $validated['province'] ?? null,
            'department' => $validated['department'] ?? null,
            'address' => $validated['address'] ?? null,
            'avatar' => $validated['avatar'] ?? null,
        ];

        if ($user->role === 'professional') {
            $profileData = array_merge($profileData, [
                'profession' => $validated['profession'] ?? null,
                'description' => $validated['description'] ?? null,
                'availability' => $validated['availability'] ?? null,
                'rating' => $validated['rating'] ?? 0,
            ]);
        }

        $user->profile()->create($profileData);

        return response()->json([
            'message' => 'Usuario registrado correctamente',
            'token' => $user->createToken('auth_token')->plainTextToken,
            'user' => $user->load('profile'),
        ], 201);
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            throw ValidationException::withMessages(['email' => 'Credenciales incorrectas']);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['user' => $user, 'token' => $token]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Sesión cerrada']);
    }
}
