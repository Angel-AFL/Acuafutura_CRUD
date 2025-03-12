<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Muestra el formulario de inicio de sesión
    public function showLoginForm()
    {
        return view('auth.login');  // Asegúrate de que esta vista sea la correcta
    }

    // Procesa el inicio de sesión
    public function login(Request $request)
    {
        // Validación de los datos del formulario
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intentar autenticar al usuario
        if (Auth::attempt($credentials, $request->remember)) {
            // Redirige al usuario a su página deseada
            return redirect()->intended('/home');  // Cambia esta ruta según tus necesidades
        }

        // Si el login falla, redirige con un mensaje de error
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }

    // Cerrar sesión
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
