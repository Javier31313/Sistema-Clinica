<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Clinico</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> -->
    <link rel="stylesheet" href="/css/login.css">
</head>
<body>
    <!-- Figuras decorativas para el fondo estilo glassmorphism -->
    <div class="shape shape-blue"></div>
    <div class="shape shape-orange"></div>

    <div class="glass-form" >
        <div class="form-header">
            <span class="logo-text">&lt;/&gt; SISTEMA CLINICA</span>
            <h2>Inicia Sesión</h2>
            <p>Accede a tu dashboard</p>
        </div>

        <form method="POST" id="login-form">
            <span class="hide" id="user-info"></span>
            <div class="input-group">
                <label for="correo">Correo</label>
                <div class="input-box">
                    <i class="fa-regular fa-envelope"></i>
                    <input type="text" id="text" name="correo">
                </div>
            </div>

            <div class="input-group">
                <label for="password">Contraseña</label>
                <div class="input-box">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" id="password" name="contraseña" placeholder="••••••••" required>
                    <i class="fa-regular fa-eye-slash toggle-icon" id="togglePassword"></i>
                </div>
                <span class="hide" id="pass-info"></span>
            </div>


            <div class="form-options">
                <label class="checkbox-label">
                    <input type="checkbox" name="remember">
                    Recordar sesión
                </label>
                <a href="#" class="forgot-link">¿Olvidé mi contraseña?</a>
            </div>

            <button id="btnEnviar" type="submit" class="btn-primary">Iniciar Sesión</button>
        </form>

        <div class="form-footer">
            <p>¿No tienes cuenta? <a href="#">Regístrate aquí.</a></p>
        </div>
    </div>

     <script src="js/views/login.js"></script>
</body>
</html>