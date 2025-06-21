<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;

// Ruta de prueba
Route::get('/test', function () {
    return response()->json(['message' => 'API funcionando']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('users', UserController::class)->except(['show','store']);
    Route::get('users/me', [UserController::class, 'me']);
    Route::put('users/premium/{id}', [UserController::class, 'updatePremium']);

    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('subcategories', SubcategoryController::class);
    Route::apiResource('services', ServiceController::class);
    Route::apiResource('appointments', AppointmentController::class);
});

Route::get('/reports/services/pdf', [ReportController::class, 'exportServicesPDF'])->name('reports.services.pdf');
Route::get('/reports/services/excel', [ReportController::class, 'exportServicesExcel'])->name('reports.services.excel');
Route::get('/reports/appointments/pdf', [ReportController::class, 'exportAppointmentsPDF'])->name('reports.appointments.pdf');
Route::get('/reports/appointments/excel', [ReportController::class, 'exportAppointmentsExcel'])->name('reports.appointments.excel');
