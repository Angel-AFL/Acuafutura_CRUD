<!-- resources/views/auth/login.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            font-family: 'Arial', sans-serif;
        }

        .login-container {
            width: 90%; /* Aumentamos el ancho del formulario */
            max-width: 1000px; /* Aumento el tamaño máximo */
            padding: 50px;
            margin: 50px auto;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 6px 30px rgba(0, 0, 0, 0.2);
        }

        .login-title {
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

        .form-check-label {
            font-size: 1rem;
        }

        .text-center a {
            font-size: 1rem;
            color: #2575fc;
        }

        .text-center a:hover {
            text-decoration: underline;
        }

        .invalid-feedback {
            font-size: 0.875rem;
        }

        .form-check {
            margin-bottom: 20px;
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
        <div class="login-container">
            <h2 class="login-title">Iniciar sesión</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

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

                <!-- Recordar sesión -->
                <div class="form-check mb-3">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input">
                    <label for="remember" class="form-check-label">Recuérdame</label>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                </div>
            </form>

            <div class="text-center mt-3">
                <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
            </div>
            <div class="text-center mt-2">
    <a href="{{ route('register') }}">¿No tienes una cuenta? Regístrate aquí</a>
</div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
