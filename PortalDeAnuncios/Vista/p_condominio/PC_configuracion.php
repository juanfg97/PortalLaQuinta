
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración - Portal Presidente junta de condominio - La Quinta</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="../Img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/configuracion.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">


</head>
<body>
      <!-- Header -->
    <header class="main-header">
        <div class="container">
            <!-- Móvil: Header reorganizado -->
            <div class="d-md-none">
                <div class="header-top">
                    <div class="logo-section">
                        <div class="logo-image">
                            <img src="../Img/logo.png" alt="Logo La Quinta">
                        </div>
                        <div class="logo-text">
                            <h1>LA QUINTA</h1>
                            <span>Portal Presidente junta de condominio</span>
                        </div>
                    </div>
                    <button class="mobile-menu-toggle" id="mobileMenuToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                
                <div class="user-info-mobile">
                    <h5> Bienvenido  <?php echo $_SESSION["nombre_completo"];  ?> <br>Presidente de la junta de condominio <br> Edificio <?php echo  $_SESSION['Terraza'].$_SESSION['Edificio'];?></h5>
                    <a href="../../Controlador/funciones/logout.php" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-sign-out-alt me-1"></i>Cerrar Sesión
                    </a>
                </div>
            </div>

            <!-- Desktop: Header original -->
            <div class="row align-items-center d-none d-md-flex">
                <div class="col-md-6">
                    <div class="logo-section">
                        <div class="logo-image">
                            <img src="../Img/logo.png" alt="Logo La Quinta">
                        </div>
                        <div class="logo-text">
                            <h1>LA QUINTA</h1>
                            <span>Portal Residente</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="user-info">
                        <h5>Bienvenido <?php   echo $_SESSION['nombre_completo']; ?> </h5>
                        <small>Presidente - Terraza <?php echo $_SESSION["Terraza"];?> Edificio <?php echo $_SESSION["Edificio"]; ?>
                        <div class="mt-2">
                            <a href="../../Controlador/funciones/logout.php" class="btn btn-outline-primary btn-sm">
                                Cerrar Sesión
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="main-nav" id="mainNav">
        <div class="container">
            <ul class="nav nav-pills flex-column flex-md-row">
                <li class="nav-item">
                    <a class="nav-link " href="PC_inicio.php" onclick="closeMenu()">
                        
                        <span class="nav-text">Inicio</span>
                    </a>
                </li>
            
                   <li class="nav-item">
                    <a class="nav-link" href="PC_informacionEdificio.php" onclick="closeMenu()">
                        
                        <span class="nav-text">Información edificio</span>
                    </a>
                </li>
                   <li class="nav-item">
                    <a class="nav-link" href="Residentes.php" onclick="closeMenu()">
                
                        <span class="nav-text">Residentes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="PC_pagos.php" onclick="closeMenu()">
                        
                        <span class="nav-text">Pagos</span>
                    </a>
                </li>
            
                  <li class="nav-item">
                    <a class="nav-link" href="PC_comunicacion.php" onclick="closeMenu()">
                        
                        <span class="nav-text">Comunicacion</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="PC_configuracion.php" onclick="closeMenu()">
                        
                        <span class="nav-text">Configuración</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <!-- Page Header -->
            <div class="page-header">
                <h2>
                    <span class="icon">⚙️</span>
                    Configuración de Cuenta
                </h2>
            </div>

            <div class="row">
                <!-- Profile Information -->
                <div class="col-lg-8 mb-4">
                    <div class="config-card">
                        <div class="config-card-header">
                            <div class="icon icon-profile">👤</div>
                            <h4>Información Personal</h4>
                        </div>
                        <div class="profile-info">


                            <div class="info-item">
                                <div class="info-icon"><i class="bi bi-person-lines-fill"></i></div>
                                <div class="info-content">
                                    <div class="info-label">Usuario</div>
                                    <div class="info-value">  <?php echo $_SESSION['usuario'];    ?>  </div>
                                </div>
                                <button class="edit-btn">✏️ Editar</button>
                            </div>



                            <div class="info-item">
                                <div class="info-icon">📝</div>
                                <div class="info-content">
                                    <div class="info-label">Nombre Completo</div>
                                    <div class="info-value">  <?php echo $_SESSION['nombre_completo'];    ?>  </div>
                                </div>
                                <button class="edit-btn">✏️ Editar</button>
                            </div>

                            <div class="info-item">
                                <div class="info-icon">📧</div>
                                <div class="info-content">
                                    <div class="info-label">Correo Electrónico</div>
                                    <div class="info-value"><?php echo $_SESSION['correo'];    ?> </div>
                                </div>
                                <button class="edit-btn">✏️ Editar</button>
                            </div>

                            <div class="info-item">
                                <div class="info-icon">📱</div>
                                <div class="info-content">
                                    <div class="info-label">Número de Teléfono</div>
                                    <div class="info-value"><?php echo $_SESSION['telefono'];    ?> </div>
                                </div>
                                <button class="edit-btn">✏️ Editar</button>
                            </div>

                            <div class="info-item">
                                <div class="info-icon"><i class="bi bi-building"></i></div>
                                <div class="info-content">
                                    <div class="info-label">Edifico del cual esta a cargo</div>
                                    <div class="info-value">Edificio <?php echo $_SESSION['Terraza'].$_SESSION['Edificio'];  ?></div>
                                </div>
                                <button class="edit-btn" disabled style="opacity: 0.5;">🔒 Fijo</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Security Settings -->
                <div class="col-lg-4 mb-4">
                    <div class="config-card">
                        <div class="config-card-header">
                            <div class="icon icon-security">🔐</div>
                            <h4>Seguridad</h4>
                        </div>
                        <div class="security-item">
                            <div class="security-content">
                                <h6>Contraseña</h6>
                                <p>Última actualización: <?php   include "../../Controlador/funciones/Mostrarfecha.php";
                                
                                if($_SESSION['ultima_modificacion'] === null){
                                    echo "no ha actualizado su contraseña anteriormente";
                                }
                                else{

                               $fecha =  formatearFechaLegible($_SESSION["ultima_modificacion"]); 
                                   echo $fecha;
                                }?></p>
                                
                                
                                
                                
                               
                            </div>
                            <button class="change-password-btn">
                                🔑 Cambiar
                            </button>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </main>
   <!-- Footer -->
    <footer class="main-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    LA QUINTA - Parque Residencial
                </div>
                <div class="footer-contact">
                    <span><i class="bi bi-geo-alt"></i> Av. Víctor Baptista, Los Teques</span>
                    <span><i class="bi bi-telephone"></i> Tel: (032) 31.1221</span>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="../../Modelo/js/PC_Modaledit.js"></script>
    <script src="../../Modelo/js/menuHamburguesa.js"></script>
</body>
</html>