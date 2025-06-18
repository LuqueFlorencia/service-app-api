<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Ruta de prueba
Route::get('/test', function () {
    return response()->json(['message' => 'API funcionando']);
});

//Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('appointments', \App\Http\Controllers\AppointmentController::class);
    Route::apiResource('categories', \App\Http\Controllers\CategoryController::class);
    Route::apiResource('profiles', \App\Http\Controllers\ProfileController::class);
    Route::apiResource('services', \App\Http\Controllers\ServiceController::class);
    Route::apiResource('subcategories', \App\Http\Controllers\SubcategoryController::class);
    Route::apiResource('users', \App\Http\Controllers\UserController::class);
//});
