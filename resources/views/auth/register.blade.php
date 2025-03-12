<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            font-family: 'Arial', sans-serif;
        }

        .register-container {
            width: 90%; /* Aumentamos el ancho del formulario */
            max-width: 1000px; /* Aumento el tamaño máximo */
            padding: 50px;
            margin: 50px auto;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 6px 30px rgba(0, 0, 0, 0.2);
        }

        .register-title {
            text-align: center;
            font-size: 36px;
            color: #333;
            font-weight: 700;
            margin-bottom: 30px;
        }

        .form-control {
            border-radius: 25px;
            box-shadow: none;
            height: 50px;
            border: 1px solid #ddd;
        }

        .form-control:focus {
            border-color: #2575fc;
            box-shadow: 0 0 0 0.2rem rgba(37, 117, 252, 0.25);
        }

        .btn-primary {
            background-color: #2575fc;
            border: none;
            border-radius: 25px;
            font-weight: 600;
            padding: 12px;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #6a11cb;
        }

        .invalid-feedback {
            font-size: 0.875rem;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            color: #fff;
            font-size: 0.875rem;
        }

        .footer a {
            color: #fff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="register-container">
            <h2 class="register-title">Registro</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!--Nombre-->
                <div class="form-group mb-3">
    <label for="name">Nombre</label>
    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" required>
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

                <!-- Correo -->
                <div class="form-group mb-3">
                    <label for="email">Correo electrónico</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" 
                           value="{{ old('email') }}" required autofocus placeholder="Ingresa tu correo electrónico">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Contraseña -->
                <div class="form-group mb-3">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required placeholder="Ingresa tu contraseña">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirmar Contraseña -->
                <div class="form-group mb-3">
                    <label for="password_confirmation">Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required placeholder="Confirma tu contraseña">
                </div>

                <!-- Teléfono -->
                <div class="form-group mb-3">
                    <label for="telefono">Teléfono</label>
                    <input type="text" name="telefono" id="telefono" class="form-control @error('telefono') is-invalid @enderror" 
                           value="{{ old('telefono') }}" required placeholder="Ingresa tu número de teléfono">
                    @error('telefono')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Rol -->
                <div class="form-group mb-3">
                    <label for="rol_id">Rol</label>
                    <select name="rol_id" id="rol_id" class="form-control @error('rol_id') is-invalid @enderror" required>
                        <option value="">Selecciona un rol</option>
                        <option value="1" @if(old('rol_id') == 1) selected @endif>Administrador</option>
                        <option value="2" @if(old('rol_id') == 2) selected @endif>Usuario</option>
                        <option value="3" @if(old('rol_id') == 3) selected @endif>Gerente</option>
                        <option value="4" @if(old('rol_id') == 4) selected @endif>Empleado</option>
                    </select>
                    @error('rol_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Fecha de creación y actualización (no visibles para el usuario) -->
                <input type="hidden" name="created_at" value="{{ now() }}">
                <input type="hidden" name="updated_at" value="{{ now() }}">

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Registrarse</button>
                </div>
            </form>

            <div class="text-center mt-3">
                <a href="{{ route('login') }}">¿Ya tienes cuenta? Inicia sesión aquí</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
