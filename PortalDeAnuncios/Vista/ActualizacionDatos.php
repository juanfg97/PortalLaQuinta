<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    // Redirigir si no hay sesión activa
    header('Location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Completar Registro - Portal Residencial La Quinta</title>
    <link rel="stylesheet" href="css/ActualizacionDatos.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container header-container">
            <div class="logo">
                <div class="logo-image">
                    <!-- Espacio para el logo de La Quinta -->
                    <img src="/api/placeholder/120/80" alt="Logo La Quinta">
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
                <p>Por favor completa la siguiente información para activar tu cuenta</p>
            </div>
            
            <div class="registration-box">
                <form id="registration-form">
                    <div class="form-group">
                        <label for="fullname" class="required">Nombre Completo</label>
                        <input type="text" id="fullname" name="fullname" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email" class="required">Correo Electrónico</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone" class="required">Teléfono</label>
                        <input type="tel" id="phone" name="phone" required>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="password" class="required">Contraseña</label>
                            <input type="password" id="password" name="password" required>
                            <div class="password-requirements">
                                La contraseña debe tener al menos 8 caracteres, incluir una letra mayúscula, una minúscula y un número.
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="confirm-password" class="required">Confirmar Contraseña</label>
                            <input type="password" id="confirm-password" name="confirm-password" required>
                        </div>
                    </div>
                    
                    <button type="submit" class="submit-button">Completar Registro</button>
                    
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
    <script src="../Modelo/js/ValidacionActualizarDatos.js"></script>
</body>
</html>