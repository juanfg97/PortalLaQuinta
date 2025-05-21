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
                        <label for="fullname" class="required">Nombre Completo</label>
                        <input type="text" id="fullname" name="fullname" required>
                    </div>
                      <button type="submit" class="submit-button">Completar Registro</button>
                    
                    <div class="form-footer">
                        <p>Los campos marcados con * son obligatorios</p>
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
    <script src="../Modelo/js/Prueba.js"></script>
</body>
</html>