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
    <title>Anuncios del edificio <?php echo $_SESSION['Terraza'].$_SESSION['Edificio'];  ?> - La Quinta</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/P_anuncios.css">
    <link rel="shortcut icon" href="../Img/favicon.png" type="image/x-icon">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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
                       
                        <span class="nav-text">Inicio</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="anunciog.php" onclick="closeMenu()">
                        
                        <span class="nav-text">Anuncios</span>
                    </a>
                </li>
                   <li class="nav-item">
                    <a class="nav-link" href="informacionEdificio.php" onclick="closeMenu()">
                        
                        <span class="nav-text">Información edificio</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pagos.php" onclick="closeMenu()">
                   
                        <span class="nav-text">Pagos</span>
                    </a>
                </li>
            
                  <li class="nav-item">
                    <a class="nav-link" href="servicios.php" onclick="closeMenu()">
                        
                        <span class="nav-text">Servicios</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="configuracion.php" onclick="closeMenu()">
    
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
                        <h2>📢 Anuncios del edificio</h2>
                        <p>Mantente informado sobre todas las noticias y eventos importantes del edificio <?php echo $_SESSION['Terraza'].$_SESSION['Edificio']; ?></p>
                    </div>
                    <div class="col-md-4 text-center d-none d-md-block">
                        <div style="font-size: 60px; opacity: 0.3; color: white;">📋</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Main Content Area -->
                <div class="col-lg-8">
                  

                    <!-- Announcements List -->
                    <div id="announcementsList">
                        <!-- Anuncio 1 -->
                  
                    <?php  include '../../Controlador/funciones/mostrarinfoEdificiouser.php';  ?>
                   
               <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Stats -->
                    <div class="row">
                        <div class="col-6">
                            <div class="stats-card">
                                <div class="stat-number" id="totalAnnouncements">
                                    <?php    
                                    include '../../Controlador/funciones/contaredificioinfo.php';
                                    $anunciosE = contarAnunciosedificio($conexion);
                                    echo $anunciosE; 
                                    ?>
                                </div>
                                <div class="stat-label">Total de Anuncios</div>
                            </div>
                        </div>
                        
                        <div class="col-6">
                            <div class="stats-card">
                                <div class="stat-number" id="monthlyAnnouncements">
                                    <?php   
                                    $anunciosmE = contarAnunciosmesedificio($conexion);
                                    echo $anunciosmE; 
                                    ?>
                                </div>
                                <div class="stat-label">Anuncios este Mes</div>
                            </div>
                        </div>
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
                        📝 Crear Nuevo Anuncio General
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="announcementForm" method="post">
                         <input type="hidden" id="formMode" value="crear"> <!-- 'crear' o 'editar' -->
                        <input type="hidden" id="announcementId" value="">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label" for="announcementTitle">
                                    <strong>Título del Anuncio *</strong>
                                </label>
                                <input type="text" class="form-control" id="announcementTitle" 
                                       placeholder="Ingrese el título del anuncio" required>
                            <small id="tituloError" style="color:red; display:none;">El título debe tener al menos 5 caracteres.</small><br>
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label class="form-label" for="announcementContent">
                                    <strong>Contenido del Anuncio *</strong>
                                </label>
                                <textarea class="form-control" id="announcementContent" rows="5" 
                                          placeholder="Escriba el contenido completo del anuncio..." required></textarea>
                            <small id="descripcionError" style="color:red; display:none;">La descripción debe tener al menos 20 caracteres.</small><br>
                            </div>
                               
                            <div class="col-12 mb-3">
                                <label class="form-label" for="announcementImage">
                                    <strong>Imagen (opcional)</strong>
                                </label>
                                <input type="file" class="form-control" id="announcementImage" 
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
                    <button type="submit"  form="announcementForm" id="submitAnnouncementBtn" class="btn btn-primary">
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
    <script src="../../Modelo/js/infoedificio.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <script src="../../Modelo/js/menuHamburguesa.js"></script>

    

</body>
</html>