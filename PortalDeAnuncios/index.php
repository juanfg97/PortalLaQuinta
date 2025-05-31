

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Residencial La Quinta</title>
    <link rel="stylesheet" href="Vista/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="shortcut icon" href="Vista/Img/favicon.png" type="image/x-icon">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container header-container">
            <div class="logo">
                <div class="logo-image">
                    <!-- Espacio para el logo de La Quinta -->
                    <img src="Vista/Img/logo.png" alt="Logo La Quinta">
                </div>
                <div class="logo-text">
                    <h1>LA QUINTA</h1>
                    <span>Portal Residencial</span>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <div class="login-container container">
            <div class="welcome-section">
                    <h2>Bienvenido al Portal de Residentes</h2>
                    <p>Accede a tu cuenta para consultar anuncios, información importante y servicios exclusivos para los residentes de Parque Residencial La Quinta.</p>
                    <div class="building-image"></div>
                </div>
                
                <div class="login-box">
                    <h3 class="login-title">Iniciar Sesión</h3>
                    <!-- Login Form -->
                    <form id="form-login" method="post">
            <div class="user-type">
                <h4>Selecciona tu perfil:</h4>
                <div class="radio-group">
                <label class="radio-option">
                    <input type="radio" name="user-type" value="residente" checked>
                    <span class="radio-custom"></span>
                    <span class="radio-label">Residente</span>
                </label>
                
                <label class="radio-option">
                    <input type="radio" name="user-type" value="presidente_junta">
                    <span class="radio-custom"></span>
                    <span class="radio-label">Presidente de Junta</span>
                </label>
                
                <label class="radio-option">
                    <input type="radio" name="user-type" value="presidente_central">
                    <span class="radio-custom"></span>
                    <span class="radio-label">Presidente Central</span>
                </label>
                </div>
            </div>
            
            <!-- Campos de usuario y contraseña -->
            <div class="form-group">
                <label for="username">Usuario</label>
                <div class="input-with-icon">
                <i class="bi bi-person"></i>
                <input type="text" id="username" name="username" placeholder="Ingresa tu usuario">
                </div>
            </div>
            
            <div class="form-group">
                <label for="password">Contraseña</label>
                <div class="input-with-icon">
                <i class="bi bi-shield-shaded"></i>
                <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña">
                </div>
            </div>
            
            <button type="submit" class="submit-button">Acceder al Portal</button>
         
            <div class="form-footer">
                <p>¿Olvidaste tu contraseña? <a href="Vista/Recuperar_password.php">Recuperar</a></p>
            </div>
            </div>
            </form>
        </div>
    </div>
</main>

    <!-- Footer -->
    <footer>
        <div class="container footer-content">
            <div class="footer-logo">
                LA QUINTA - Parque Residencial
            </div>
            <div class="footer-contact">
                <span>Av. Víctor Baptista, Los Teques</span>
                <span>Tel: (032) 31.1221</span>
            </div>
        </div>
    </footer>
<script src="Modelo/js/ValidacionLogin.js"></script>

</body>
</html>