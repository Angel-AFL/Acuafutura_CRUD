<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EmpleadoController;

Route::get('/empleados/listar', [EmpleadoController::class, 'index'])->name('empleados.listar');
Route::post('/empleados/agregar', [EmpleadoController::class, 'store'])->name('empleados.agregar');
Route::delete('/empleados/eliminar/{id}', [EmpleadoController::class, 'destroy'])->name('empleados.eliminar');
Route::get('/empleados/show/{id}', [EmpleadoController::class, 'show'])->name('empleados.show');
Route::put('/empleados/actualizar/{id}', [EmpleadoController::class, 'update'])->name('empleados.update');
// Rutas para el registro y login
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Ruta para la recuperación de contraseñas
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Ruta para resetear la contraseña
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');


// Ruta para la vista de login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');

// Ruta para procesar el formulario de login
Route::post('login', [LoginController::class, 'login']);

// Ruta para cerrar sesión
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', function () {
return view('welcome');
});

