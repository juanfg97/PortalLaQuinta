<?php
session_start();
if (!isset($_SESSION['correo_verificacion'])) {
    // Redirigir si no hay sesión activa
    header('Location: ../index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Restablecer contraseña - Portal Residencial La Quinta</title>
    <link rel="stylesheet" href="css/ActualizacionDatos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
     <link rel="shortcut icon" href="Img/favicon.png" type="image/x-icon">
</head>
<body>
    <!-- Header -->
  <header>
        <div class="container header-container">
            <div class="logo">
                <div class="logo-image">
                    <!-- Espacio para el logo de La Quinta -->
                    <img src="Img/logo.png" alt="Logo La Quinta">
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
        <div class="container registration-container">
            <div class="page-title">
                <h2>Completar Registro</h2>
                <p>Por favor completa la siguiente información para restablecer su cuenta</p>
            </div>
            
          
                    
            <form id="registration-form" method = "post">
            <div class="form-row">
            <div class="form-group">
            <label for="password" class="required">Contraseña</label>
            <div class="input-with-icon">
                <i class="bi bi-shield"></i>
                <input type="password" id="password" name="password" >
            </div>
            <div class="password-requirements">
                La contraseña debe tener al menos 8 caracteres, incluir una letra mayúscula, una minúscula y un número.
            </div>
        </div>

        <div class="form-group">
            <label for="confirmarPassword" class="required">Confirmar Contraseña</label>
            <div class="input-with-icon">
                <i class="bi bi-shield-check"></i>
                <input type="password" id="confirmarPassword" name="confirmarPassword" >
            </div>
        </div>
    </div>

    <button type="submit" class="submit-button">Restablecer cuenta</button>

    <div class="form-footer">
        <p>Los campos marcados con * son obligatorios</p>
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
    <script src="../Modelo/js/Validacion_restablecer.js"></script>
</body>
</html>