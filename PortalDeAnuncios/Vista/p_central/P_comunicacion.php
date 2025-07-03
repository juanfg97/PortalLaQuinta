<?php
session_start();
if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'presidente_central') {
    session_destroy();
    header('Location: /PortalDeAnuncios/index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Comunicación - Portal Presidente Central</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet" />
     <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/css/bootstrap-select.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/P_inicio.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../css/P_comunicacion.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    

    <link rel="shortcut icon" href="../Img/favicon.png" type="image/x-icon" />
    
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
                            <span>Portal Presidente central</span>
                        </div>
                    </div>
                    <button class="mobile-menu-toggle" id="mobileMenuToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                
                <div class="user-info-mobile">
                    <h5> Bienvenido  <?php echo $_SESSION["nombre_completo"];  ?> <br>Presidente central</h5>
                    
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
                            <span>Portal Presidente central</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="user-info">
                        <h5>Bienvenido <?php   echo $_SESSION['nombre_completo']; ?> </h5>
                        <small>Presidente central</small>
                        
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
                    <a class="nav-link " href="P_inicio.php" onclick="closeMenu()">
                        
                        <span class="nav-text">Inicio</span>
                    </a>
                </li>
            
                   <li class="nav-item">
                    <a class="nav-link" href="Presidentes.php" onclick="closeMenu()">
                        
                        <span class="nav-text">Presidentes</span>
                    </a>
                </li>
                   <li class="nav-item">
                    <a class="nav-link" href="P_anuncios.php" onclick="closeMenu()">
                        
                        <span class="nav-text">Anuncios</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="P_comunicacion.php" onclick="closeMenu()">
                        
                        <span class="nav-text">Comunicación</span>
                    </a>
                </li>
            
                  <li class="nav-item">
                    <a class="nav-link" href="P_servicios.php" onclick="closeMenu()">
                        
                        <span class="nav-text">Servicios</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="P_configuracion.php" onclick="closeMenu()">
                        
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
                        <p>Envía comunicados a los presidentes de edificios y revisa los informes recibidos de toda la urbanización.</p>
                    </div>
                    <div class="col-md-4 text-center d-none d-md-block">
                        <div style="font-size: 60px; opacity: 0.3;">💬</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Enviar Comunicados -->
                <div class="col-lg-5 mb-4">
                    <div class="comunicacion-card">
                        <div class="d-flex align-items-center mb-3">
                            <div class="card-indicator indicator-anuncios me-2">📤</div>
                            <h4 class="mb-0">Enviar Comunicado</h4>
                        </div>
                        
                        <form id="formComunicado" class="comunicado-form">
                            <div class="mb-3">
                                <label for="destinatario" class="form-label fw-bold">Destinatario</label>
                                <?php  include '../../Controlador/funciones/selecciondestinatario.php';  ?>
                            </div>
                            
                            <div class="mb-3">
                                <label for="asunto" class="form-label fw-bold">Asunto</label>
                                <input type="text" class="form-control" id="asunto" placeholder="Tema del comunicado..." required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="mensaje" class="form-label fw-bold">Mensaje</label>
                                <textarea class="form-control" id="mensaje" rows="6" placeholder="Escriba aquí el contenido del comunicado..." required></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label for="prioridad" class="form-label fw-bold">Prioridad</label>
                                <select class="form-select" id="prioridad">
                                    <option value="normal">📄 Normal</option>
                                    <option value="importante">⚠️ Importante</option>
                                    <option value="urgente">🚨 Urgente</option>
                                </select>
                            </div>
                            
                            <button type="submit" class="btn btn-enviar-comunicado w-100">
                                📤 Enviar Comunicado
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Informes Recibidos -->
                <div class="col-lg-7 mb-4">
                    <div class="comunicacion-card">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="d-flex align-items-center">
                                <div class="card-indicator indicator-reportes me-2">📋</div>
                                <h4 class="mb-0">Informes de Presidentes</h4>
                            </div>
                            <span class="contador-informes">
                                <?php 
                                include '../../Controlador/conexion_bd_login.php';
                                include '../../Controlador/funciones/contarnuevosinformes.php'; echo $nuevosInformes.' informes nuevos'; ?>
                            </span>
                        </div>
                        
                        <!-- Filtros -->
                        <div class="filtros-comunicacion mb-4">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <select class="form-select form-select-sm" id="filtroTerraza">
                                        <option value="">Todas las terrazas</option>
                                        <option value="1">Terraza 1</option>
                                        <option value="2">Terraza 2</option>
                                        <option value="3">Terraza 3</option>
                                        <option value="4">Terraza 4</option>
                                        <option value="5">Terraza 5</option>
                                        <option value="6">Terraza 6</option>
                                        <option value="7">Terraza 7</option>
                                        <option value="8">Terraza 8</option>
                                        <option value="9">Terraza 9</option>
                                        <option value="10">Terraza 10</option>
                                        <option value="11">Terraza 11</option>
                                        <option value="12">Terraza 12</option>
                                        <option value="13">Terraza 13</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                <input type="text" id="filtroEdificio" class="form-control form-control-sm" placeholder="Filtrar por edificio (ej. 1A)">
                                </div>
                                <div class="col-md-6 mt-2">
    <select class="form-select form-select-sm" id="filtroPrioridad">
        <option value="">Todas las prioridades</option>
        <option value="baja">🟢 Baja - Informativo</option>
        <option value="media">🟡 Media - Requiere Atención</option>
        <option value="alta">🔴 Alta - Urgente</option>
    </select>
</div>

 <div class="col-md-6 mt-2">
        <select class="form-select form-select-sm" id="filtroTipo"  required>
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

    </div>
</div>

                        <!-- Control de elementos por página -->
                         

                        <div class="items-per-page">
                            <label for="itemsPorPagina" class="form-label mb-0">Mostrar:</label>
                            <select class="form-select form-select-sm" id="itemsPorPagina" style="width: auto;">
                                <option value="5">5 informes</option>
                                <option value="10" selected>10 informes</option>
                                <option value="15">15 informes</option>
                                <option value="20">20 informes</option>
                                <option value="50">50 informes</option>
                            </select>
                            <span class="text-muted">por página</span>
                        </div>
                        
                        <!-- Spinner de carga -->
                        <div class="loading-spinner" id="loadingSpinner">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Cargando...</span>
                            </div>
                            <p class="mt-2 text-muted">Cargando informes...</p>
                        </div>

                        <!-- Lista de Informes -->
                        <div id="listaInformes" style="max-height: 600px; overflow-y: auto;">
                            
                        </div>

                        <!-- Mensaje cuando no hay resultados -->
                        <div class="no-results d-none" id="noResults">
                            <i class="bi bi-search"></i>
                            <h5>No se encontraron informes</h5>
                            <p class="text-muted">No hay informes que coincidan con los filtros seleccionados.</p>
                        </div>

                        <!-- Paginación -->
                        <div class="pagination-container" id="paginationContainer">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="pagination-info" id="paginationInfo">
                                    <!-- Información de paginación se mostrará aquí -->
                                </div>
                                <nav aria-label="Navegación de informes">
                                    <ul class="pagination pagination-sm mb-0" id="paginationControls">
                                        <!-- Los controles de paginación se generarán aquí -->
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
   <footer class="main-footer">
    <div class="container d-flex justify-content-between">
        <div class="footer-logo fw-bold">LA QUINTA - Parque Residencial</div>
        <div class="footer-contact">
            <span class="me-3"><i class="bi bi-geo-alt"></i> Av. Víctor Baptista, Los Teques</span>
            <span><i class="bi bi-telephone"></i> Tel: (032) 31.1221</span>
        </div>
    </div>
</footer>

    <!-- Modal para Confirmar Envío -->
    <div class="modal fade" id="modalConfirmarEnvio" tabindex="-1" aria-labelledby="modalConfirmarEnvioLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalConfirmarEnvioLabel">Confirmar Envío de Comunicado</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="me-3" style="font-size: 40px;">📤</div>
                        <div>
                            <h6 class="mb-1">¿Está seguro de enviar este comunicado?</h6>
                            <small class="text-muted">Esta acción no se puede deshacer</small>
                        </div>
                    </div>
                    
                    <div class="border rounded p-3 bg-light">
                        <div class="row mb-2">
                            <div class="col-4"><strong>Destinatario:</strong></div>
                            <div class="col-8" id="confirmDestinatario"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4"><strong>Asunto:</strong></div>
                            <div class="col-8" id="confirmAsunto"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4"><strong>Prioridad:</strong></div>
                            <div class="col-8" id="confirmPrioridad"></div>
                        </div>
                        <div class="row">
                            <div class="col-4"><strong>Mensaje:</strong></div>
                            <div class="col-8" id="confirmMensaje"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnConfirmarEnvio">
                        📤 Enviar Comunicado
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Ver Informe Completo -->
    <div class="modal fade" id="modalInformeCompleto" tabindex="-1" aria-labelledby="modalInformeCompletoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="modalInformeCompletoLabel">Informe Completo</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="contenidoInformeCompleto">
              
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="../../Modelo/js/P_comunicacion.js"></script>
    <script src="../../Modelo/js/menuHamburguesa.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>