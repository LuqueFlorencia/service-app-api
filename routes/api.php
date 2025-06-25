<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;

// Ruta de prueba
Route::get('/test', function () {
    return response()->json(['message' => 'API funcionando']);
});

Route::apiResource('appointments', AppointmentController::class);
Route::put('appointments/{id}/status', [AppointmentController::class, 'updateStatus']);

