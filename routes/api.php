<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Ruta de prueba
Route::get('/test', function () {
    return response()->json(['message' => 'API funcionando']);
});