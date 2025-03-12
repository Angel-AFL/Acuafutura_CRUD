<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /**
     * Mostrar el formulario de registro.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Manejar el registro de un nuevo usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Validación de los datos de entrada
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'telefono' => 'required|numeric|min:10',
            'rol_id' => 'required|in:1,2,3,4', // Define los roles según corresponda
        ]);

        // Crear el nuevo usuario
        $user = User::create([
            'name' => $request->name,  // Asegúrate de pasar el nombre
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'telefono' => $validated['telefono'],
            'rol_id' => $validated['rol_id'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Disparar el evento de registro (si es necesario para la verificación por ejemplo)
        event(new Registered($user));

        // Redirigir al usuario al login u otra página según la lógica
        return redirect()->route('login')->with('status', 'Registro exitoso, por favor inicia sesión.');
    }
}
