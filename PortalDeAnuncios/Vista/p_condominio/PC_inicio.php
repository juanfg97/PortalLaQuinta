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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Presidente - La Quinta</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/PC_inicio.css">
    <link rel="stylesheet" href="../css/P_anuncios.css">
    <link rel="shortcut icon" href="../Img/favicon.png" type="image/x-icon">
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
                    <h5>Bienvenido <?php echo $_SESSION["nombre_completo"]; ?> <br>Presidente de la junta de condominio <br> Edificio <?php echo $_SESSION['Terraza'].$_SESSION['Edificio']; ?></h5>
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
                        <h5>Bienvenido <?php echo $_SESSION['nombre_completo']; ?></h5>
                        <small>Presidente - Terraza <?php echo $_SESSION["Terraza"]; ?> Edificio <?php echo $_SESSION["Edificio"]; ?></small>
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
                    <a class="nav-link" href="PC_inicio.php" onclick="closeMenu()">
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
                        <span class="nav-text">Comunicación</span>
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

    <div id="logo-pdf" style="display:none; text-align:center; margin-bottom:20px;">
        <img src="../Img/logo.png" alt="Logo La Quinta" style="height:80px;">
        <h4>Reporte de Morosos - Edificio <?php echo $_SESSION['Terraza'] . $_SESSION['Edificio']; ?></h4>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <!-- Welcome Section -->
            <div class="welcome-section">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2>Bienvenido, <?php echo $_SESSION["nombre_completo"]; ?></h2>
                        <p>Panel de control para la gestión del Edificio <?php echo $_SESSION['Terraza'].$_SESSION['Edificio']; ?> <br> Aquí puedes administrar residentes, aprobar pagos, publicar anuncios y coordinar servicios para tu edificio.</p>
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
                                    <span class="card-title">Residentes</span>
                                </div>
                                <div class="card-content">
                                    <div class="stat-number text-success"><?php include '../../Controlador/funciones/numero_residentes.php'; ?></div>
                                    <div class="stat-label">Número de apartamentos</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 mb-3">
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
                        <div class="col-md-6 col-sm-6 mb-3">
                            <div class="dashboard-card">
                                <div class="card-header">
                                    <div class="card-indicator indicator-anuncios">A</div>
                                    <span class="card-title">Anuncios del edificio</span>
                                </div>
                                <div class="card-content">
                                    <div class="stat-number text-info">
                                        <?php 
                                        include '../../Controlador/funciones/contaredificioinfo.php';
                                        $anunciosE = contarAnunciosmesedificio($conexion);
                                        echo $anunciosE; 
                                        ?>
                                    </div>
                                    <div class="stat-label">En Total este Mes</div>
                                </div>
                            </div>
                        </div>

                        <?php include ('../../Controlador/funciones/tablamoroso.php'); ?>

                        <div class="col-12 mb-3">
                            <div class="dashboard-card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="card-indicator indicator-anuncios">🌐</div>
                                        <span class="card-title">Anuncios del Edificio Recientes</span>
                                    </div>
                                    <a href="PC_informacionEdificio.php" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-eye me-1"></i>Ver Todos
                                    </a>
                                </div>
                                <div class="card-content">
                                    <?php 
                                    include '../../Controlador/funciones/Mostrarfecha.php';
                                    include '../../Controlador/funciones/mostrarinfoEdificioreciente.php';
                                    ?>
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
                        </div>
                    </div>
                </div>
            </div>
       
            <!-- Sección de Reportes -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <div class="card-indicator indicator-reportes">📝</div>
                            <span class="card-title">Enviar Reportes</span>
                        </div>
                        <div class="card-content">
                            <p class="text-muted mb-4">
                                Utiliza este formulario para reportar incidencias, sugerencias, problemas en el sistema o cualquier situación que requiera atención del presidente central.
                            </p>
                        <form id="reporteForm" method="POST">
    <div class="mb-3">
        <label for="asunto" class="form-label">
            <i class="fas fa-tag me-2"></i>Asunto del Reporte <span class="text-danger">*</span>
        </label>
        <input type="text" 
               class="form-control" 
               id="asunto" 
               name="asunto" 
               placeholder="Ingresa el asunto del reporte" 
               maxlength="100" 
               required>
        <div class="character-counter" id="asuntoCounter">0/100 caracteres</div>
    </div>

    <div class="mb-4">
        <label for="descripcion" class="form-label">
            <i class="fas fa-align-left me-2"></i>Descripción Detallada <span class="text-danger">*</span>
        </label>
        <textarea class="form-control" 
                  id="descripcion" 
                  name="descripcion" 
                  rows="6" 
                  placeholder="Describe detalladamente la situación, problema o sugerencia..." 
                  required 
                  maxlength="1000"></textarea>
        <div class="character-counter" id="descripcionCounter">0/1000 caracteres</div>
    </div>

    <div class="d-flex flex-column flex-md-row gap-3 justify-content-end">
        <button type="button" class="btn btn-outline-secondary" onclick="limpiarFormulario()">
            <i class="fas fa-eraser me-2"></i>Limpiar Formulario
        </button>

        <!-- Dentro del <form> -->
<button 
    type="button" 
    class="btn btn-outline-info" 
    data-bs-toggle="modal" 
    data-bs-target="#modalReportes" 
    formnovalidate>
    <i class="fas fa-list me-2"></i>Ver Mis Reportes
</button>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-paper-plane me-2"></i>Enviar Reporte
        </button>
    </div>
</form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php

$usuario = $_SESSION['usuario'];

// Consulta reportes del usuario
$sql = "SELECT id, asunto, descripcion, fecha, estado FROM reportes WHERE usuario = ? ORDER BY fecha DESC";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();

?>
<!-- Modal Bootstrap -->
<div class="modal fade" id="modalReportes" tabindex="-1" aria-labelledby="modalReportesLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalReportesLabel">Mis Reportes</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body" id="reporteContenido">
        <?php if ($resultado->num_rows > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Asunto</th>
                            <th>Descripción</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($fila = $resultado->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($fila['id']) ?></td>
                                <td><?= htmlspecialchars($fila['asunto']) ?></td>
                                <td><?= htmlspecialchars($fila['descripcion']) ?></td>
                                <td><?= htmlspecialchars($fila['fecha']) ?></td>
                                <td><?= htmlspecialchars(ucfirst($fila['estado'])) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-muted">No has realizado reportes aún.</p>
        <?php endif; ?>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-primary" onclick="imprimirPDF()">
          <i class="fas fa-file-pdf me-2"></i> Imprimir PDF
        </button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          Cerrar
        </button>
      </div>
    </div>
  </div>
</div>

<script>
function imprimirPDF() {
    const contenido = document.getElementById("reporteContenido").innerHTML;
    const ventana = window.open('', '', 'height=800,width=1200');
    
    ventana.document.write('<html><head><title>Mis Reportes</title>');
    ventana.document.write(`
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <style>
            body { font-family: Arial, sans-serif; padding: 20px; }
            h2 { text-align: center; margin-bottom: 20px; }
            table { width: 100%; border-collapse: collapse; }
            th, td { border: 1px solid #000; padding: 8px; text-align: left; }
            th { background-color: #f8f9fa; }
            tr:nth-child(even) { background-color: #f2f2f2; }
        </style>
    `);
    ventana.document.write('</head><body>');
    ventana.document.write('<h2>Listado de Reportes</h2>');
    ventana.document.write(contenido);
    ventana.document.write('</body></html>');

    ventana.document.close();
    ventana.focus();
    ventana.print();
    ventana.close();
}
</script>

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../Modelo/js/reportespc.js"></script>
    <script>
    // Contadores en tiempo real
    function actualizarContador(inputId, counterId, maxLength) {
        const input = document.getElementById(inputId);
        const counter = document.getElementById(counterId);

        const update = () => {
            const longitud = input.value.length;
            counter.textContent = `${longitud}/${maxLength} caracteres`;
            counter.style.color = longitud > maxLength * 0.9 ? 'red' : '';
        };

        input.addEventListener('input', update);
        update(); // Inicializa el contador
    }

    // Función para limpiar el formulario
    function limpiarFormulario() {
        const formulario = document.getElementById('reporteForm');
        formulario.reset(); // Limpia todos los campos del formulario

        // Reinicia contadores de caracteres
        document.getElementById('asuntoCounter').textContent = '0/100 caracteres';
        document.getElementById('asuntoCounter').style.color = '';

        document.getElementById('descripcionCounter').textContent = '0/1000 caracteres';
        document.getElementById('descripcionCounter').style.color = '';
    }

    // Ejecuta contadores cuando el DOM está listo
    document.addEventListener('DOMContentLoaded', () => {
        actualizarContador('asunto', 'asuntoCounter', 100);
        actualizarContador('descripcion', 'descripcionCounter', 1000);
    });
</script>

    <script>
    // Función para actualizar contador
    function actualizarContador(inputId, counterId, maxLength) {
        const input = document.getElementById(inputId);
        const counter = document.getElementById(counterId);

        input.addEventListener('input', () => {
            const longitud = input.value.length;
            counter.textContent = `${longitud}/${maxLength} caracteres`;

            // Opcional: cambiar color si se acerca al límite
            if (longitud > maxLength * 0.9) {
                counter.style.color = 'red';
            } else {
                counter.style.color = '';
            }
        });
    }

    // Ejecutar al cargar la página
    document.addEventListener('DOMContentLoaded', () => {
        actualizarContador('asunto', 'asuntoCounter', 100);
        actualizarContador('descripcion', 'descripcionCounter', 1000);
    });
</script>

</body>
</html>