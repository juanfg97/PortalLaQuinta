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
    <title>Presidentes - Portal Presidente - La Quinta</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../Img/favicon.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../css/Presidentes.css">
    <link rel="shortcut icon" href="../Img/favicon.png" type="image/x-icon" />

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
    <main class="main-content">
        <div class="container">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2>Gestión de Presidentes de la junta de condominio</h2>
                        <p>Administra la información de todos los presidentes de la junta de condominio</p>
                    </div>
                    <div class="col-md-4 text-center d-none d-md-block">
                        <div style="font-size: 60px; opacity: 0.3; color: white;">👥</div>
                    </div>
                </div>
            </div>

            <!-- Filter Bar -->
            <div class="filter-bar">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="input-group">
                            <input type="text" class="form-control search-input" placeholder="Buscar por nombre, usuario, correo o teléfono..." id="searchInput">
                            <button class="btn btn-primary-custom" type="button" id="searchBtn">
                                🔍 Buscar
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Residents Table -->
            <div class="residents-section">
                <div class="section-header">
                    <h4>Lista de Presidentes de la junta de condominio</h4>
                    <button type="button" class="btn btn-add-president" data-bs-toggle="modal" data-bs-target="#addPresidentModal">
                        ➕ Añadir Presidente
                    </button>
                </div>
                <div class="table-container">
                    <div class="table-responsive">
                        
<table class="table presidents-table">
    <thead>
        <tr>
            <th>Edificio</th>
            <th>Nombre Completo</th>
            <th>Correo Electrónico</th>
            <th>Teléfono</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody id="presidentTableBody">
   
    
    </tbody>
</table>
                        <div id="noResultsMessage" class="text-center text-danger fw-bold py-3" style="display: none;">
                            No se ha encontrado lo ingresado.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="main-footer">
    <div class="container d-flex justify-content-between">
        <div class="footer-logo fw-bold">LA QUINTA - Parque Residencial</div>
        <div class="footer-contact">
            <span class="me-3"><i class="bi bi-geo-alt"></i> Av. Víctor Baptista, Los Teques</span>
            <span><i class="bi bi-telephone"></i> Tel: (032) 31.1221</span>
        </div>
    </div>
</footer>

    <!-- Modal para Añadir Presidente -->
    <div class="modal fade" id="addPresidentModal" tabindex="-1" aria-labelledby="addPresidentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPresidentModalLabel">➕ Añadir Nuevo Presidente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addPresidentForm">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="terraza" class="form-label">Número de Terraza *</label>
                                <input type="number" class="form-control" id="terraza" name="terraza" required min="1" max="999">
                                <div class="form-text">Ingrese un número del 1 al 13</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edificio" class="form-label">Edificio *</label>
                                <input type="text" class="form-control" id="edificio" name="edificio" required pattern="[A-Z]+" maxlength="5" style="text-transform: uppercase;">
                                <div class="form-text">Solo letras mayúsculas (ej: A, B, C, etc.)</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="usuario" class="form-label">Usuario *</label>
                                <input type="text" class="form-control" id="usuario" name="usuario" required minlength="3" maxlength="20">
                                <div class="form-text">Entre 6 y 20 caracteres</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nombreCompleto" class="form-label">Nombre Completo *</label>
                                <input type="text" class="form-control" id="nombreCompleto" name="nombreCompleto" required minlength="2" maxlength="100">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="correo" class="form-label">Correo Electrónico *</label>
                                <input type="email" class="form-control" id="correo" name="correo" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="telefono" class="form-label">Teléfono *</label>
                                <input type="tel" class="form-control" id="telefono" name="telefono" required pattern="[0-9\-\+\(\)\s]+" minlength="10" maxlength="20">
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="password" class="form-label">Contraseña *</label>
                                <input type="password" class="form-control" id="password" name="password" required minlength="6" maxlength="50">
                                <div class="form-text">Mínimo 6 carácteres, una letra mayúscula y minúscula y un número</div>
                            </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="password" class="form-label"> Repetir Contraseña *</label>
                                <input type="password" class="form-control" id="repeatpassword" name="repeatpassword" required minlength="6" maxlength="50">
                                
                            </div>
                        </div>
                        <div class="form-text text-muted">
                            <small>Los campos marcados con (*) son obligatorios</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary-custom" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success-custom">Guardar Presidente</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="../../Modelo/js/Presidentes.js"></script>
    <script src="../../Modelo/js/eliminarpresidente.js"></script>
    <script src="../../Modelo/js/renderpresidentes.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <script src="../../Modelo/js/menuHamburguesa.js"></script>
    
</body>
</html>