<?php
session_start();
if (empty($_SESSION['usuario'])) {
    // Redirigir si no hay sesión activa
    session_destroy();
    header('Location: /PortalDeAnuncios/index.php');
    exit();
}
include  '../../Controlador/conexion_bd_login.php'; 


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Residente - La Quinta</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/inicio.css">
     <link rel="shortcut icon" href="../Img/favicon.png" type="image/x-icon">
  
</head>
<body>
    

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
                            <span>Portal Residente</span>
                        </div>
                    </div>
                    <button class="mobile-menu-toggle" id="mobileMenuToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                
                <div class="user-info-mobile">
                    <h5>Bienvenido <?php   echo $_SESSION['nombre_completo']; ?></h5>
                    <a href="" class="btn btn-outline-primary btn-sm">
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
                    <a class="nav-link " href="inicio.php" onclick="closeMenu()">
                        
                        <span class="nav-text">  Inicio</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="anunciog.php" onclick="closeMenu()">
                        
                        <span class="nav-text">  Anuncios</span>
                    </a>
                </li>
                   <li class="nav-item">
                    <a class="nav-link" href="informacionEdificio.php" onclick="closeMenu()">
                        
                        <span class="nav-text">  Información edificio</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pagos.php" onclick="closeMenu()">
                        
                        <span class="nav-text">  Pagos</span>
                    </a>
                </li>
            
                  <li class="nav-item">
                    <a class="nav-link" href="servicios.php" onclick="closeMenu()">
                    
                        <span class="nav-text">  Servicios</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="configuracion.php" onclick="closeMenu()">
                        
                        <span class="nav-text">  Configuración</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <!-- Welcome Section -->
            <div class="welcome-section">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2>Bienvenido, <?php   echo $_SESSION['nombre_completo'];?></h2>
                        <p>Tu portal personal para mantenerte informada sobre todos los anuncios, gestionar tus pagos de condominio y enviar reportes al presidente de tu edificio.</p>
                    </div>
                    <div class="col-md-4 text-center d-none d-md-block">
                        <div style="font-size: 80px; opacity: 0.3; color: white;">🏠</div>
                    </div>
                </div>
            </div>

            <!-- Dashboard Cards -->
            <div class="row">
                <!-- Resumen General -->
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 mb-3">
                            <div class="dashboard-card">
                                <div class="card-header">
                                    <div class="card-indicator indicator-anuncios">📢</div>
                                    <span class="card-title">Anuncios</span>
                                </div>
                                <div class="card-content">
                                    <div class="stat-number text-info"><?php
                            include '../../Controlador/funciones/contaranuncios.php';
                            echo contarAnunciosMesActual($conexion);
                            ?></div>Anuncios generales de este mes</div>
                                    <div class="stat-label">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 mb-3">
                            <div class="dashboard-card">
                                <div class="card-header">
                                    <div class="card-indicator indicator-pagos">💳</div>
                                    <span class="card-title">Estado de Pagos</span>
                                </div>
                                <div class="card-content">
                                    <div class="stat-number text-warning"><?php
                                    include '../../Controlador/funciones/cantidadDeudas.php';
                                  $pendientes = obtenerCantidadDeudasPorEstado('pendiente');
                                  if($pendientes === 0){
                                    echo '✓';
                                    echo '</div>';
                                    echo ' <div class="stat-label">Esta solvente</div>';
                                  }
                                    else{

                                            
                                    echo $pendientes;
                                    echo '</div>';
                                    echo ' <div class="stat-label">Pendientes por pagar</div>';
                                    }?>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 mb-3">
                            <div class="dashboard-card">
                                <div class="card-header">
                                    <div class="card-indicator indicator-reportes">📢</div>
                                    <span class="card-title">Anuncios del edificio</span>
                                </div>
                                <div class="card-content">
                                    <div class="stat-number text-warning"><?php    include '../../Controlador/funciones/contaredificioinfo.php';
                        $anunciosE = contarAnunciosmesedificio($conexion);
                        echo $anunciosE; ?></div> 
                                    <div class="stat-label">En Total este Mes</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 mb-3">
                            <div class="dashboard-card">
                                <div class="card-header">
                                    <div class="card-indicator indicator-servicios">🔧</div>
                                    <span class="card-title">Servicios</span>
                                </div>
                                <div class="card-content">
                                    <div class="stat-number text-success"><?php   include '../../Controlador/funciones/contarservicios.php';
                                    
                                    $servicios =contarServicios($conexion);
                                    echo $servicios;
                                    
                                    ?></div>
                                    <div class="stat-label">Activos en mi edificio</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Acciones Rápidas -->
                <div class="col-lg-4">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <div class="card-indicator indicator-servicios">⚡</div>
                            <span class="card-title">Acciones Rápidas</span>
                        </div>
                        <div class="card-content">
                            <a href="pagos.php" class="quick-action-btn">
                                <span class="action-text">💰 Realizar Pago</span>
                            </a>
                           
                        </div>
                    </div>
                </div>
            </div>

            <!-- Anuncios Generales y del Edificio -->
            <div class="row mt-4">
                <!-- Anuncios Generales Recientes -->
                <div class="col-lg-6 mb-4">
                    <div class="dashboard-card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="card-indicator indicator-anuncios">🌐</div>
                                <span class="card-title">Anuncios Generales Recientes</span>
                            </div>
                            <a href="anunciog.php" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-eye me-1"></i>Ver Todos
                            </a>
                        </div>
                        <div class="card-content">
                            <?php include '../../Controlador/funciones/mostraranunciosrecientes.php'; ?>
                        </div>
                    </div>
                </div>

                <!-- Anuncios del Edificio Recientes -->
                   <div class="col-lg-6 mb-4">
                    <div class="dashboard-card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="card-indicator indicator-anuncios">🌐</div>
                                <span class="card-title">Anuncios del Edificio Recientes</span>
                            </div>
                            <a href="informacionEdificio.php" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-eye me-1"></i>Ver Todos
                            </a>
                        </div>
                        <div class="card-content">
                            <?php include '../../Controlador/funciones/mostrarinfoEdificioreciente.php'; ?>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <script src="../../Modelo/js/menuHamburguesa.js"></script>
</body>
</html>