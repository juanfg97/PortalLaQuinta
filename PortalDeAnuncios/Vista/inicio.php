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
    <title>Portal Residente - La Quinta</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/inicio.css">
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
                            <span>Portal Residente</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="user-info">
                       <h5> Bienvenido <?php   include ("../Controlador/mostrarnombre.php") ?></h5>
                    
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
                        <span class="nav-text">Pagos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span class="nav-text">Reportes</span>
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
                        <h2>Bienvenido, <?php   include ("../Controlador/mostrarnombre.php") ?></h2>
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
                                    <span class="card-title">Anuncios Nuevos</span>
                                </div>
                                <div class="card-content">
                                    <div class="stat-number text-info">5</div>
                                    <div class="stat-label">3 generales, 2 del edificio</div>
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
                                    <div class="stat-number text-success">✓</div>
                                    <div class="stat-label">Al día - Mayo 2025</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 mb-3">
                            <div class="dashboard-card">
                                <div class="card-header">
                                    <div class="card-indicator indicator-reportes">📝</div>
                                    <span class="card-title">Mis Reportes</span>
                                </div>
                                <div class="card-content">
                                    <div class="stat-number text-warning">2</div>
                                    <div class="stat-label">Pendientes de respuesta</div>
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
                                    <div class="stat-number text-success">3</div>
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
                            <a href="#" class="quick-action-btn">
                                <span class="action-text">💰 Realizar Pago</span>
                            </a>
                            <a href="#" class="quick-action-btn">
                                <span class="action-text">📝 Enviar Reporte</span>
                            </a>
                            <a href="#" class="quick-action-btn">
                                <span class="action-text">📋 Ver Historial</span>
                            </a>
                            <a href="#" class="quick-action-btn">
                                <span class="action-text">📞 Contactar Presidente</span>
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
                            <span class="card-title">Mi Actividad Reciente</span>
                        </div>
                        <div class="card-content">
                            <div class="activity-item">
                                <div class="activity-indicator bg-success">💳</div>
                                <div class="activity-content">
                                    <h6>Pago realizado</h6>
                                    <small>Condominio Mayo 2025 - $45.00</small>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-indicator bg-info">📝</div>
                                <div class="activity-content">
                                    <h6>Reporte enviado</h6>
                                    <small>Problema con el ascensor - Piso 3</small>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-indicator bg-primary">📢</div>
                                <div class="activity-content">
                                    <h6>Anuncio leído</h6>
                                    <small>Mantenimiento de áreas verdes</small>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-indicator bg-warning">👀</div>
                                <div class="activity-content">
                                    <h6>Respuesta recibida</h6>
                                    <small>Reporte de ruido - Solucionado</small>
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
                            
                            <!-- Anuncio del General -->
                            <div class="announcement-card general">
                                <div class="announcement-title">
                                    Limpieza y mantenimiento de pozos 
                                    <span class="announcement-badge badge-building">Edificio 1A</span>
                                </div>
                                <div class="announcement-content">
                                Se suspendera el servicio de agua  el miércoles 28 de mayo desde las 8:00 AM hasta las 2:00 PM por mantenimiento preventivo. Disculpen las molestias.
                                </div>
                                <div class="announcement-image">
                                    <img src="Img/limpieza-de-pozos.webp" alt="Imagen del anuncio">
                                </div>
                                <div class="announcement-meta">
                                    <span>📅 21 Mayo 2025</span>
                                    <span>🏢 Solo Edificio 1A</span>
                                </div>
                            </div>
                            <!-- Anuncio de edificio -->
                            <div class="announcement-card building">
                                <div class="announcement-title">
                                    Mantenimiento de Áreas Verdes
                                    <span class="announcement-badge badge-general">General</span>
                                </div>
                                <div class="announcement-content">
                                    Se realizará el mantenimiento mensual de todas las áreas verdes de la urbanización. Se solicita mantener los vehículos alejados de las zonas de jardinería.
                                </div>
                                <div class="announcement-image">
                                    <img src="Img/cortarmonte.jpg" alt="Imagen del anuncio">
                                </div>
                                <div class="announcement-meta">
                                    <span>📅 20 Mayo 2025</span>
                                    
                                </div>
                            </div>

                            <!-- Otro Anuncio General -->
                            <div class="announcement-card general">
                                <div class="announcement-title">
                                    Nuevo Horario de Vigilancia
                                    <span class="announcement-badge badge-general">General</span>
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