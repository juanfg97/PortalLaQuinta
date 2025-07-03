<?php
session_start();
if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'presidente_junta') {
    session_destroy();
    header('Location: /PortalDeAnuncios/index.php');
    exit();
}
include '../../Controlador/conexion_bd_login.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Comunicación - Portal Presidente de Edificio</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/inicio.css" />
    <link rel="shortcut icon" href="../Img/favicon.png" type="image/x-icon" />
    <link rel="stylesheet" href="../css/PC_comunicacion.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                            <span>Portal Presidente de la junta de condominio</span>
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
    <main class="main-content mb-5">
        <div class="container">
            <!-- Header Section -->
            <div class="comunicacion-header">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2>Centro de Comunicación</h2>
                        <p>Revisa los comunicados del Presidente Central y envía tus informes sobre la gestión del edificio.</p>
                        <div class="info-edificio">
                            🏢 Terraza <?php echo $_SESSION["Terraza"]; ?> - Edificio <?php echo $_SESSION["Edificio"]; ?>
                        </div>
                    </div>
                    <div class="col-md-4 text-center d-none d-md-block">
                        <div style="font-size: 60px; opacity: 0.3;">📨</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Comunicados del Presidente Central -->
                <div class="col-lg-7 mb-4">
                    <div class="comunicacion-card">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="d-flex align-items-center">
                                <div class="card-indicator indicator-anuncios me-2">📥</div>
                                <h4 class="mb-0">Comunicados Recibidos</h4>
                            </div>
                            <span class="contador-comunicados">3 nuevos</span>
                        </div>
                        
                        <!-- Filtros -->
                        <div class="filtros-comunicacion mb-4">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <select class="form-select form-select-sm" id="filtroPrioridad">
                                        <option value="">Todas las prioridades</option>
                                        <option value="urgente">🚨 Urgente</option>
                                        <option value="importante">⚠️ Importante</option>
                                        <option value="normal">📄 Normal</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-select form-select-sm" id="filtroEstado">
                                        <option value="">Todos los comunicados</option>
                                        <option value="recientes">Recientes</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Lista de Comunicados -->
                        <div id="listaComunicados" style="max-height: 600px; overflow-y: auto;">
                           <div id="contenedor-comunicados"></div>
                            <div id="paginacion-comunicados"></div>
                        </div>
                    </div>
                </div>

                <!-- Enviar Informe -->
                <div class="col-lg-5 mb-4">
                    <div class="comunicacion-card">
                        <div class="d-flex align-items-center mb-3">
                            <div class="card-indicator indicator-servicios me-2">📤</div>
                            <h4 class="mb-0">Enviar Informe</h4>
                        </div>
                        
                        <form id="formInforme" class="informe-form" method="POST" enctype="multipart/form-data">

    <div class="mb-3">
        <label for="tipoInforme" class="form-label fw-bold">Tipo de Informe</label>
        <select class="form-select" id="tipoInforme" name="tipoInforme" required>
            <option value="">Seleccionar tipo...</option>
            <option value="mantenimiento">🔧 Mantenimiento</option>
            <option value="seguridad">🛡️ Seguridad</option>
            <option value="financiero">💰 Financiero</option>
            <option value="limpieza">🧹 Limpieza</option>
            <option value="servicios">⚡ Servicios Públicos</option>
            <option value="reparaciones">🔨 Reparaciones</option>
            <option value="general">📋 General</option>
        </select>
    </div>
    
    <div class="mb-3">
        <label for="asuntoInforme" class="form-label fw-bold">Asunto</label>
        <input type="text" class="form-control" id="asuntoInforme" name="asuntoInforme" placeholder="Tema del informe..." required>
    </div>
    
    <div class="mb-3">
        <label for="descripcionInforme" class="form-label fw-bold">Descripción Detallada</label>
        <textarea class="form-control" id="descripcionInforme" name="descripcionInforme" rows="6" placeholder="Describa detalladamente la situación, problema o informe que desea comunicar..." required></textarea>
    </div>
    
    <div class="mb-3">
        <label for="prioridadInforme" class="form-label fw-bold">Nivel de Urgencia</label>
        <select class="form-select" id="prioridadInforme" name="prioridadInforme">
            <option value="baja">🟢 Baja - Informativo</option>
            <option value="media">🟡 Media - Requiere Atención</option>
            <option value="alta">🔴 Alta - Urgente</option>
        </select>
    </div>
   <div class="mb-3">
    <div class="form-check mb-2">
        <input class="form-check-input" type="checkbox" id="adjuntarDocumentos" name="adjuntarDocumentos">
        <label class="form-check-label" for="adjuntarDocumentos">
            Adjuntar documentos
        </label>
    </div>
    <!-- Este input estará oculto al inicio -->
    <input type="file" class="form-control" id="fileAdjuntos" name="adjuntos[]" multiple style="display: none;">
</div>

    
    <button type="submit" class="btn btn-enviar-informe w-100">
        📤 Enviar Informe al Presidente Central
    </button>
</form>

                        <!-- Información adicional -->
                        <div class="mt-3 p-3 bg-light rounded">
                            <small class="text-muted">
                                <strong>💡 Consejos:</strong><br>
                                • Sé específico en la descripción<br>
                                • Incluye fechas y horarios cuando sea relevante<br>
                                • Menciona si afecta a residentes específicos<br>
                                • Los informes urgentes son revisados inmediatamente
                            </small>
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
    <!-- Modal para Ver Comunicado Completo -->
    <div class="modal fade" id="modalComunicadoCompleto" tabindex="-1" aria-labelledby="modalComunicadoCompletoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalComunicadoCompletoLabel">Comunicado del Presidente Central</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="contenidoComunicadoCompleto">
                        <!-- Contenido del comunicado se cargará aquí -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Confirmar Envío de Informe -->
    <div class="modal fade" id="modalConfirmarInforme" tabindex="-1" aria-labelledby="modalConfirmarInformeLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="modalConfirmarInformeLabel">Confirmar Envío de Informe</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="me-3" style="font-size: 40px;">📤</div>
                        <div>
                            <h6 class="mb-1">¿Está seguro de enviar este informe?</h6>
                            <small class="text-muted">Se enviará al Presidente Central de la urbanización</small>
                        </div>
                    </div>
                    
                    <div class="border rounded p-3 bg-light">
                        <div class="row mb-2">
                            <div class="col-4"><strong>Edificio:</strong></div>
                            <div class="col-8">Terraza <?php echo $_SESSION["Terraza"]; ?> - Edificio <?php echo $_SESSION["Edificio"]; ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4"><strong>Tipo:</strong></div>
                            <div class="col-8" id="confirmTipo"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4"><strong>Asunto:</strong></div>
                            <div class="col-8" id="confirmAsuntoInforme"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4"><strong>Urgencia:</strong></div>
                            <div class="col-8" id="confirmUrgencia"></div>
                        </div>
                        <div class="row">
                            <div class="col-4"><strong>Descripción:</strong></div>
                            <div class="col-8" id="confirmDescripcion"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" id="btnConfirmarInforme">
                        📤 Enviar Informe
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="../../Modelo/js/PC_comunicacion.js"></script>
    <script src="../../Modelo/js/menuHamburguesa.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    
   
    
</body>
</html>