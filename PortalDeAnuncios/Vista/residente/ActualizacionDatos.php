<?php
session_start();
if (empty($_SESSION['usuario'])) {
    // Redirigir si no hay sesión activa
    session_destroy();
    header('Location: /PortalDeAnuncios/index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Completar Registro - Portal Residencial La Quinta</title>
    <link rel="stylesheet" href="../css/ActualizacionDatos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
     <link rel="shortcut icon" href="../Img/favicon.png" type="image/x-icon">
</head>
<body>
    <!-- Header -->
  <header>
        <div class="container header-container">
            <div class="logo">
                <div class="logo-image">
                    <!-- Espacio para el logo de La Quinta -->
                    <img src="../Img/logo.png" alt="Logo La Quinta">
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
                <form id="registration-form" method = "post">
                    <div class="form-group">
                        <label for="nombreCompleto" class="required">Nombre Completo</label>

                        <div class="input-with-icon">
                          <i class="bi bi-person-circle"></i>  
                        <input type="text" id="nombreCompleto" name="nombreCompleto" placeholder="Ingrese su nombre completo" >
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="correo" class="required">Correo Electrónico</label>
                        <div class="input-with-icon">
                        <i class="bi bi-envelope"></i>
                        <input type="correo" id="correo" name="correo" placeholder="ejemplo@correo.com" >
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="telefono" class="required">Teléfono</label>
                        <div class="input-with-icon">
                        <i class="bi bi-phone"></i>
                        <input type="tel" id="telefono" name="telefono" placeholder="Ingrese su número de teléfono" >
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="password" class="required">Contraseña</label>
                        <div class="input-with-icon">
                            <i class="bi bi-shield"></i>
                            <input type="password" id="password" name="password" placeholder="Ingrese su contraseña">
                        </div>
                            <div class="password-requirements">
                                La contraseña debe tener al menos 8 caracteres, incluir una letra mayúscula, una minúscula y un número.
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="confirmarPassword" class="required">Confirmar Contraseña</label>
                        <div class="input-with-icon">

                            <i class="bi bi-shield-check"></i>
                            <input type="password" id="confirmarPassword" name="confirmarPassword" placeholder="Confirmar Contraseña" >
                        </div>
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
    <script src="../../Modelo/js/ValidacionActualizarDatos.js"></script>
</body>
</html>