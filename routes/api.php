<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;


// Ruta de prueba
Route::get('/test', function () {
    return response()->json(['message' => 'API funcionando']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('users', UserController::class)->except(['show', 'store']);
    Route::get('users/me', [UserController::class, 'me']);
    Route::put('users/premium/{id}', [UserController::class, 'updatePremium']);

    Route::apiResource('services', ServiceController::class);
    
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('subcategories', SubcategoryController::class);

    Route::apiResource('appointments', AppointmentController::class);
    Route::put('appointments/{id}/status', [AppointmentController::class, 'updateStatus']);
});


