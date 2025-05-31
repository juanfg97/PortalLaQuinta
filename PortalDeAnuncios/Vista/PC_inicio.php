

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
    <title>Portal Presidente - La Quinta</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/PC_inicio.css">
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
                            <span>Portal Presidente junta de condominio</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="user-info">
                        <h5><?php  echo $_SESSION["usuario"];  ?></h5>
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
                        <span class="nav-text">Residentes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span class="nav-text">Pagos</span>
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
                        <h2>Bienvenido, <?php   echo $_SESSION["usuario"]; ?></h2>
                        <p>Panel de control para la gestión del Edificio A. Aquí puedes administrar residentes, aprobar pagos, publicar anuncios y coordinar servicios para tu edificio.</p>
                    </div>
                    <div class="col-md-4 text-center d-none d-md-block">
                        <div style="font-size: 80px; opacity: 0.3; color: white;">🏢</div>
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
                                    <div class="card-indicator indicator-residentes">R</div>
                                    <span class="card-title">Residentes Activos</span>
                                </div>
                                <div class="card-content">
                                    <div class="stat-number text-success">48</div>
                                    <div class="stat-label">De 52 apartamentos</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 mb-3">
                            <div class="dashboard-card">
                                <div class="card-header">
                                    <div class="card-indicator indicator-pagos">$</div>
                                    <span class="card-title">Pagos Pendientes</span>
                                </div>
                                <div class="card-content">
                                    <div class="stat-number text-warning">7</div>
                                    <div class="stat-label">Requieren aprobación</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 mb-3">
                            <div class="dashboard-card">
                                <div class="card-header">
                                    <div class="card-indicator indicator-anuncios">A</div>
                                    <span class="card-title">Anuncios Activos</span>
                                </div>
                                <div class="card-content">
                                    <div class="stat-number text-info">12</div>
                                    <div class="stat-label">3 generales, 9 del edificio</div>
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
                                    <div class="stat-number text-danger">3</div>
                                    <div class="stat-label">Sin responder</div>
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
                                <span class="action-text">+ Nuevo Anuncio</span>
                            </a>
                            <a href="#" class="quick-action-btn">
                                <span class="action-text">✓ Aprobar Pagos</span>
                            </a>
                            <a href="#" class="quick-action-btn">
                                <span class="action-text">👥 Nuevo Residente</span>
                            </a>
                            <a href="#" class="quick-action-btn">
                                <span class="action-text">📧 Enviar Comunicado</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actividad Reciente -->
            <div class="row mt-4">
                <div class="col-lg-6 mb-4">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <div class="card-indicator indicator-edificio">⏰</div>
                            <span class="card-title">Actividad Reciente</span>
                        </div>
                        <div class="card-content">
                            <div class="activity-item">
                                <div class="activity-indicator bg-success">✓</div>
                                <div class="activity-content">
                                    <h6>Pago aprobado</h6>
                                    <small>Apt. 304 - Condominio Enero 2025</small>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-indicator bg-info">📢</div>
                                <div class="activity-content">
                                    <h6>Anuncio publicado</h6>
                                    <small>Mantenimiento del ascensor</small>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-indicator bg-primary">👤</div>
                                <div class="activity-content">
                                    <h6>Nuevo residente</h6>
                                    <small>María González - Apt. 207</small>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-indicator bg-warning">⚠️</div>
                                <div class="activity-content">
                                    <h6>Reporte de servicio</h6>
                                    <small>Problema con el portón principal</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Información del Edificio -->
                <div class="col-lg-6 mb-4">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <div class="card-indicator indicator-edificio">🏢</div>
                            <span class="card-title">Información del Edificio</span>
                        </div>
                        <div class="card-content">
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <h6>📍 Ubicación</h6>
                                    <p class="mb-3">Edificio A<br>Parque Residencial La Quinta</p>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <h6>🏠 Apartamentos</h6>
                                    <p class="mb-3">52 unidades<br>13 pisos</p>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <h6>📅 Período Actual</h6>
                                    <p class="mb-3">Enero 2025</p>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <h6>💰 Tarifa Mensual</h6>
                                    <p class="mb-3">$45.00</p>
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <a href="#" class="btn btn-outline-primary">
                                    👁️ Ver Detalles Completos
                                </a>
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