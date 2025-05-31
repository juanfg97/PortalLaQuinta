<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Iniciar Sesión - Portal Residencial La Quinta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/Recuperar_password.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
        <div class="container login-container">
            <div class="page-title">
                <h2>Recuperacion de cuenta</h2>
                <p>Ingresa tus credenciales para recuperar su cuenta</p>
            </div>
            
            <div class="login-box">
                <form id="login-form" method="post">
                    <div class="form-group">
                        <label for="usuario" class="required">Usuario</label>
                        <div class="input-with-icon">
                            <i class="bi bi-person-circle"></i>  
                            <input type="text" id="usuario" name="usuario" placeholder="Ingresa tu usuario">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="correo" class="required">Correo Electrónico</label>
                        <div class="input-with-icon">
                            <i class="bi bi-envelope"></i>
                            <input type="email" id="correo" name="correo" placeholder="ejemplo@correo.com">
                        </div>
                    </div>
                    
                    <button type="submit" class="submit-button">Continuar</button>
                    
                    <div class="form-footer">
                        <p>Los campos marcados con * son obligatorios</p>
                    </div>

                    <!-- Mensaje de error global -->
                    <div id="mensaje-error-global" class="mensaje-error-global">
                        Por favor corrige los errores indicados.
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Modal Token -->
    <div id="modal-token" class="modal-overlay">
        <div class="modal-token">
            <button class="modal-close" id="close-modal">&times;</button>
            
            <div class="modal-header">
                <div class="icon">
                    <i class="bi bi-shield-lock"></i>
                </div>
                <h3>Verificación de Seguridad</h3>
                <p>Se ha enviado un código de verificación a tu correo electrónico. Ingresa el código de 6 dígitos para continuar.</p>
            </div>

            <div id="modal-error" class="modal-error" style="display: none;">
                Código de verificación incorrecto. Inténtalo de nuevo.
            </div>

            <div class="token-input-group">
                <label for="token-input">Código de Verificación</label>
                <input type="text" id="token-input" class="token-input" placeholder="000000" maxlength="6">
            </div>

            <div class="modal-buttons">
                <button class="btn-cancel" id="btn-cancel">Cancelar</button>
                <button class="btn-verify" id="btn-verify">Verificar</button>
            </div>
        </div>
    </div>

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
        <script src="../Modelo/js/Recuperar_password.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </footer>
</body>
</html>