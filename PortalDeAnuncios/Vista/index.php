

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Residencial La Quinta</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container header-container">
            <div class="logo">
                <div class="logo-image">
                    <!-- Espacio para el logo de La Quinta -->
                    <img src="Img/logoarreglado.jpg" alt="Logo La Quinta">
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
                        <label>
                            <input type="radio" name="user-type" value="residente" checked> Residente
                        </label>
                        <label>
                            <input type="radio" name="user-type" value="presidente_junta"> Presidente de Junta
                        </label>
                        <label>
                            <input type="radio" name="user-type" value="presidente_central"> Presidente Central
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="username">Usuario</label>
                        <input type="text" id="username" name="username" >
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" >
                    </div>
                    <button type="submit" class="submit-button">Acceder al Portal</button>

                     <p id="mensaje" style="color: red; margin-top: 10px;"></p>

                    <div class="form-footer">
                        <p>¿Olvidaste tu contraseña? <a href="#">Recuperar</a></p>
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
<script src="../Modelo/js/ValidacionLogin.js"></script>

</body>
</html>