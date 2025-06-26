<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\UserController;


// Ruta de prueba
Route::get('/test', function () {
    return response()->json(['message' => 'API funcionando']);
});

Route::apiResource('appointments', AppointmentController::class);
Route::put('appointments/{id}/status', [AppointmentController::class, 'updateStatus']);

Route::apiResource('users', UserController::class)->except(['show', 'store']);
Route::get('users/me', [UserController::class, 'me']);
Route::put('users/premium/{id}', [UserController::class, 'updatePremium']);
