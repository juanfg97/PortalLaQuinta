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
    <title>Servicios - La Quinta</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="../css/P_anuncios.css">
    <link rel="shortcut icon" href="../Img/favicon.png" type="image/x-icon">

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
                        <h2>Servicios </h2>
                        <p>Mantente informado sobre todos los servicios de terceros disponibles en la urbanizacion</p>
                    </div>
                    <div class="col-md-4 text-center d-none d-md-block">
                        <div style="font-size: 60px; opacity: 0.3; color: white;">📋</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Main Content Area -->
                <div class="col-lg-8">
                    <!-- Add Announcement Button -->
                    <button class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#addAnnouncementModal">
                        ➕ Agregar Nuevo Servicio
                    </button>


                    <div class="mb-3">
                        <label for="categoriaFiltro" class="form-label"><strong>Filtrar por categoría:</strong></label>
                        <select id="categoriaFiltro" class="form-control">
                        <option value="Todos">Todos</option>
                        <option value="Limpieza">Limpieza</option>
                        <option value="Mantenimiento">Mantenimiento</option>
                        <option value="Emergencia">Emergencia</option>
                        <option value="Eventos">Eventos</option>
                        <option value="Recreativo">Recreativo</option>
                        <option value="Otros">Otros</option>
                        </select>
</div>


                    <!-- Announcements List -->
                    <div id="announcementsList">
                        <!-- Anuncio 1 -->
                  
                    <?php  include '../../Controlador/funciones/mostrarservicios.php';  ?>
                   
                 

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Stats -->
                    <div class="stats-card">
                        <div class="stat-number" id="totalAnnouncements"><?php    include '../../Controlador/funciones/contarservicios.php';
                        include '../../Controlador/conexion_bd_login.php';
                        $servicios = contarServicios($conexion);
                        echo $servicios;
                        
                        ?></div>
                        <div class="stat-label">Total de Servicios</div>
                    </div>
            </div>
        </div>
    </main>

    <!-- Modal para Agregar Anuncio -->
    <div class="modal fade" id="addAnnouncementModal" tabindex="-1" aria-labelledby="addAnnouncementModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAnnouncementModalLabel">
                        📝 Crear Nuevo Servicio
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="ServicioForm" method="post">
                         <input type="hidden" id="formMode" value="crear"> <!-- 'crear' o 'editar' -->
                        <input type="hidden" id="announcementId" value="">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label" for="nombre_servicio">
                                    <strong>Nombre del servicio *</strong>
                                </label>
                                <input type="text" class="form-control" id="nombre_servicio" 
                                       placeholder="Ingrese el nombre del servicio" required>
                            <small id="nombreError" style="color:red; display:none;">El nombre del servicio debe tener al menos 5 caracteres.</small><br>
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label class="form-label" for="descripcion">
                                    <strong>Contenido del Anuncio *</strong>
                                </label>
                                <textarea class="form-control" id="descripcion" rows="5" 
                                          placeholder="Describa su servicio" required></textarea>
                            <small id="descripcionError" style="color:red; display:none;">La descripción debe tener al menos 20 caracteres.</small><br>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="proveedor">
                                    <strong>Proveedor*</strong>
                                </label>
                                <input type="text" class="form-control" id="proveedor" 
                                       placeholder="Ingrese nombre del proveedor" required>
                                <small id="proveedorError" style="color:red; display:none;">El proveedor debe tener al menos 3 letras.</small>

                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="contacto">
                                    <strong>Contacto*</strong>
                                </label>
                                <input type="text" class="form-control" id="contacto" 
                                       placeholder="Ingrese informacion de contacto" required>
                                <small id="contactoError" style="color:red; display:none;">El contacto debe tener al menos 3 letras o numeros.</small>

                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="servicioCategory">
                                    <strong>Categoría</strong>
                                </label>
                                <select class="form-control" id="servicioCategory">
                                    <option value="Limpieza">Limpieza</option>
                                    <option value="Mantenimiento">Mantenimiento</option>
                                    <option value="Emergencia">Emergencia</option>
                                    <option value="Eventos">Eventos</option>
                                    <option value="Recreativo">Recreativo</option>
                                    <option value="Otros">Otros</option>
                                </select>
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label class="form-label" for="servicioImage">
                                    <strong>Imagen (opcional)</strong>
                                </label>
                                <input type="file" class="form-control" id="servicioImage" 
                                       accept="image/*" onchange="previewImage(this)">
                                <small class="text-muted">Formatos permitidos: JPG, PNG, GIF (máximo 5MB)</small>
                                <img id="imagePreview" class="image-preview" alt="Vista previa">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        ❌ Cancelar
                    </button>
                    <button type="submit"  form="ServicioForm" id="submitAnnouncementBtn" class="btn btn-primary">
                        📤 Publicar Anuncio
                    </button>
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
    <script src="../../Modelo/js/servicio.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
   <script src="../../Modelo/js/menuHamburguesa.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>

  

</body>
</html>