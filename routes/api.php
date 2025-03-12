<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/verEmpleados', [EmpleadoController::class, 'apiVerEmpleados']);
Route::get('/crearEmpleado', [EmpleadoController::class, 'apiCrearEmpleado']);
Route::get('/verEmpleado/{id}', [EmpleadoController::class, 'apiVerEmpleado']);
Route::get('/editarEmpleado', [EmpleadoController::class, 'apiEditarEmpleado']);