
<?php
session_start();
if (empty($_SESSION['usuario'])) {
    // Redirigir si no hay sesión activa
    sesion_destroy();
    header('Location: ../index.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Presidente Central - La Quinta</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="css/P_inicio.css">
    <link rel="shortcut icon" href="Img/favicon.png" type="image/x-icon">
</head>
<body>
    <!-- Header -->
    <header class="main-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="logo-section">
                        <div class="logo-image">
                            <img src="Img/logo.png" alt="Logo La Quinta">
                        </div>
                        <div class="logo-text">
                            <h1>LA QUINTA</h1>
                            <span>Portal Presidente Central</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="user-info">
                        <h5><?php echo $_SESSION["usuario"]; ?></h5>
                        <small>Presidente Central - Urbanización</small>
                        <div class="mt-2">
                            <a href="../Controlador/logout.php" class="btn btn-outline-primary btn-sm">
                                Cerrar Sesión
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="main-nav">
        <div class="container">
            <ul class="nav nav-pills flex-column flex-md-row">
                <li class="nav-item">
                    <a class="nav-link active" href="#">
                        <span class="nav-text">Inicio</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span class="nav-text">Anuncios</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span class="nav-text">Presidentes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span class="nav-text">Comunicación</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span class="nav-text">Servicios</span>
                    </a>
                </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span class="nav-text">Configuración</span>
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
                        <h2>Bienvenido, <?php echo  $_SESSION["usuario"];  ?></h2>
                        <p>Panel de control central para la gestión de toda la Urbanización La Quinta. Coordina con los presidentes de cada edificio, publica anuncios generales y supervisa los servicios de toda la comunidad.</p>
                    </div>
                    <div class="col-md-4 text-center d-none d-md-block">
                        <div style="font-size: 80px; opacity: 0.3; color: white;">🏘️</div>
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
                                    <div class="card-indicator indicator-presidentes">P</div>
                                    <span class="card-title">Presidentes Activos</span>
                                </div>
                                <div class="card-content">
                                    <div class="stat-number text-success">8</div>
                                    <div class="stat-label">De 8 edificios</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 mb-3">
                            <div class="dashboard-card">
                                <div class="card-header">
                                    <div class="card-indicator indicator-anuncios">A</div>
                                    <span class="card-title">Anuncios Generales</span>
                                </div>
                                <div class="card-content">
                                    <div class="stat-number text-info">5</div>
                                    <div class="stat-label">Activos en toda la urbanización</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 mb-3">
                            <div class="dashboard-card">
                                <div class="card-header">
                                    <div class="card-indicator indicator-comunicacion">M</div>
                                    <span class="card-title">Mensajes Nuevos</span>
                                </div>
                                <div class="card-content">
                                    <div class="stat-number text-danger">12</div>
                                    <div class="stat-label">De presidentes de edificios</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 mb-3">
                            <div class="dashboard-card">
                                <div class="card-header">
                                    <div class="card-indicator indicator-servicios">S</div>
                                    <span class="card-title">Servicios Activos</span>
                                </div>
                                <div class="card-content">
                                    <div class="stat-number text-success">15</div>
                                    <div class="stat-label">Vigilancia, limpieza, jardinería</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Acciones Rápidas -->
                <div class="col-lg-4">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <div class="card-indicator indicator-servicios">+</div>
                            <span class="card-title">Acciones Rápidas</span>
                        </div>
                        <div class="card-content">
                            <a href="#" class="quick-action-btn">
                                <span class="action-text">📢 Añadir Anuncio</span>
                            </a>
                            <a href="#" class="quick-action-btn">
                                <span class="action-text">🔧 Añadir Servicio</span>
                            </a>
                            <a href="#" class="quick-action-btn">
                                <span class="action-text">📧 Comunicado General</span>
                            </a>
                            <a href="#" class="quick-action-btn">
                                <span class="action-text">📊 Ver Reportes</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actividad Reciente y Anuncios -->
            <div class="row mt-4">
                <div class="col-lg-6 mb-4">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <div class="card-indicator indicator-edificio">⏰</div>
                            <span class="card-title">Actividad Reciente</span>
                        </div>
                        <div class="card-content">
                            <div class="activity-item">
                                <div class="activity-indicator bg-success">📢</div>
                                <div class="activity-content">
                                    <h6>Anuncio general publicado</h6>
                                    <small>Mantenimiento de áreas comunes</small>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-indicator bg-info">👤</div>
                                <div class="activity-content">
                                    <h6>Nuevo presidente asignado</h6>
                                    <small>Edificio F - Ana Martínez</small>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-indicator bg-primary">🔧</div>
                                <div class="activity-content">
                                    <h6>Servicio programado</h6>
                                    <small>Fumigación general - Próximo lunes</small>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-indicator bg-warning">📧</div>
                                <div class="activity-content">
                                    <h6>Mensaje de presidente</h6>
                                    <small>Edificio C - Consulta sobre vigilancia</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Anuncios Recientes -->
                <div class="col-lg-6 mb-4">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <div class="card-indicator indicator-anuncios">📋</div>
                            <span class="card-title">Anuncios Recientes</span>
                        </div>
                        <div class="card-content">
                            <div class="announcement-card">
                                <div class="announcement-title">
                                    Mantenimiento de Áreas Verdes
                                </div>
                                <div class="announcement-content">
                                    Se realizará el mantenimiento mensual de todas las áreas verdes de la urbanización. Se solicita mantener los vehículos alejados de las zonas de jardinería.
                                </div>
                                <div class="announcement-image">
                                    <img src="Img/cortarmonte.jpg" alt="Imagen del anuncio">
                                </div>
                                <div class="announcement-meta">
                                    <span>📅 20 Mayo 2025</span>
                                    <span>🏘️ Toda la urbanización</span>
                                </div>
                            </div>
                            
                            <div class="announcement-card">
                                <div class="announcement-title">
                                    Nuevo Horario de Vigilancia
                                </div>
                                <div class="announcement-content">
                                    A partir del 1 de junio, el servicio de vigilancia tendrá nuevo horario. Los guardias estarán disponibles las 24 horas con refuerzo nocturno.
                                </div>
                                <div class="announcement-image">
                                   <img src="Img/seguridad.webp" alt="Imagen del anuncio">
                                </div>
                                <div class="announcement-meta">
                                    <span>📅 18 Mayo 2025</span>
                                    <span>🛡️ Servicio de seguridad</span>
                                </div>
                            </div>
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
</body>
</html>