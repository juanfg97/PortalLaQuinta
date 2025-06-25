<?php
session_start();
if (empty($_SESSION['usuario'])) {
    session_destroy();
    header('Location: /PortalDeAnuncios/index.php');
    exit();
}
include '../../Controlador/conexion_bd_login.php';

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagos - Portal Presidente - La Quinta</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/PC_inicio.css">
    <link rel="shortcut icon" href="../Img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/P_anuncios.css">
    <link rel="stylesheet" href="../css/pagos.css">
</head>
<body>
    <!-- Header -->
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
            <div class="welcome-section">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2><i class="fas fa-money-bill-wave me-3"></i>Gestión de Pagos</h2>
                        <p>Administra los pagos de condominio del Edificio <?php echo $_SESSION['Terraza'] . $_SESSION['Edificio']; ?>. Puedes agregar deudas, revisar el estado de pagos y aprobar comprobantes.</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <button class="btn btn-light btn-lg" data-bs-toggle="modal" data-bs-target="#addDebtModal">
                            <i class="fas fa-plus me-2"></i>Agregar Deuda
                        </button>
                    </div>
                </div>
            </div>

            <!-- Dashboard Cards -->
            <div class="row mb-4">
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <div class="card-indicator indicator-pagos">Bs</div>
                            <span class="card-title">Pagos Pendientes</span>
                        </div>
                        <div class="card-content">
                            <div class="stat-number text-warning">
                                <?php 
                                include '../../Controlador/funciones/contarpagosporaprobar.php';
                                $pagos = contarPagosPorEdificio($conexion,'en proceso');
                                echo $pagos;
                                ?>
                            </div>
                            <div class="stat-label">Requieren aprobación</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <div class="card-indicator indicator-residentes">✓</div>
                            <span class="card-title">Pagos Aprobados</span>
                        </div>
                        <div class="card-content">
                            <div class="stat-number text-success">
                                <?php  
                                $pagosa = contarPagosPorEdificio($conexion,'aprobado');
                                echo $pagosa;
                                ?>
                            </div>
                            <div class="stat-label">Este mes</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cuentas Bancarias -->
            <div class="row mb-4">
                <div class="col-lg-6">
                    <div class="payment-card">
                        <div class="payment-card-header">
                            <h4><i class="fas fa-university me-2"></i>Cuentas Bancarias</h4>
                        </div>
                        <div class="payment-card-body">
                            <div class="debt-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1"><i class="fas fa-credit-card me-2"></i>Banco Venezuela</h6>
                                        <small class="text-muted">Cuenta Corriente</small>
                                    </div>
                                    <div class="text-end">
                                        <strong>0102-1234-5678-9012</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="debt-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1"><i class="fas fa-credit-card me-2"></i>Banesco</h6>
                                        <small class="text-muted">Cuenta Corriente</small>
                                    </div>
                                    <div class="text-end">
                                        <strong>0134-9876-5432-1098</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="debt-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1"><i class="fas fa-mobile-alt me-2"></i>Pago Móvil</h6>
                                        <small class="text-muted">Banesco</small>
                                    </div>
                                    <div class="text-end">
                                        <strong>0424-1234567</strong><br>
                                        <small>CI: V-12345678</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Búsqueda -->
            <div class="search-box">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input 
                              type="text" 
                              id="searchInput" 
                              class="form-control" 
                              placeholder="Buscar por apartamento, nombre o referencia..."
                              autocomplete="off"
                            >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select id="filterEstado" class="form-select">
                            <option value="">Todos los estados</option>
                            <option value="en proceso">Pendiente</option>
                            <option value="aprobado">Aprobado</option>
                        </select>
                    </div>
                  
                </div>
            </div>
</br>
            <!-- Pagos Enviados -->
            <div class="payment-card">
                <div class="payment-card-header">
                    <h4><i class="fas fa-receipt me-2"></i>Pagos Enviados por Residentes</h4>
                </div>
                <div id="pagosContainer" class="payment-card-body mt-3"></div>
                <div id="paginacionContainer" class="pagination-container mt-4 d-flex justify-content-center"></div>

            </div>
        </div>
    </main>

    <!-- Modal Agregar Deuda -->
    <div class="modal fade" id="addDebtModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-plus me-2"></i>Agregar Nueva Deuda</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="deudaForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Apartamento</label>
                                    <select class="form-select" id="apartamento" name="apartamento" required>
                                        <?php include '../../Controlador/funciones/seleccionresidende.php'; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tipo de Deuda</label>
                                    <select class="form-select" id="tipoDeuda" name="tipoDeuda" required>
                                        <option value="">Seleccionar tipo</option>
                                        <option value="condominio">Condominio Mensual</option>
                                        <option value="otros">Otros</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Monto</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Bs</span>
                                        <input type="number" class="form-control" id="monto" name="monto" step="0.01" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Fecha de Vencimiento</label>
                                    <input type="date" class="form-control" id="fecha" name="fecha" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Descripción detallada de la deuda..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="agregarBtn">Agregar Deuda</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para ver comprobante -->
    <div class="modal fade" id="comprobanteModal" tabindex="-1" aria-labelledby="comprobanteModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered" style="max-width: 90vw;">
        <div class="modal-content" style="height: 90vh;">
          <div class="modal-header">
            <h5 class="modal-title" id="comprobanteModalLabel">Comprobante</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body text-center" style="height: calc(90vh - 70px); overflow-y: auto;">
            <div id="comprobanteContent" style="max-height: 100%; width: 100%;">
              <!-- Aquí carga PDF o imagen -->
            </div>
          </div>
        </div>
      </div>
    </div>

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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="../../Modelo//js/menuHamburguesa.js"></script>
    <script src="../../Modelo/js/Pc_pagos.js"></script>
</body>
</html>