<?php
session_start();
if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'residente') {
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
    <title>Portal Residente - La Quinta</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/inicio.css">
    <link rel="shortcut icon" href="../Img/favicon.png" type="image/x-icon">
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
                    <h5>Bienvenido <?php echo $_SESSION['nombre_completo']; ?></h5>
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
                        <h5>Bienvenido <?php echo $_SESSION['nombre_completo']; ?></h5>
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
                    <a class="nav-link" href="inicio.php" onclick="closeMenu()">
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
            <!-- Welcome Section -->
            <div class="welcome-section">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2>Bienvenido, <?php echo $_SESSION['nombre_completo']; ?></h2>
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
                                    <span class="card-title">Anuncios</span>
                                </div>
                                <div class="card-content">
                                    <div class="stat-number text-info">
                                        <?php
                                        include '../../Controlador/funciones/contaranuncios.php';
                                        echo contarAnunciosMesActual($conexion);
                                        ?>
                                    </div>
                                    <div class="stat-label">Anuncios generales de este mes</div>
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
                                    <div class="stat-number text-warning">
                                        <?php
                                        include '../../Controlador/funciones/cantidadDeudas.php';
                                        $pendientes = obtenerCantidadDeudasPorEstado('pendiente');
                                        if($pendientes === 0){
                                            echo '✓';
                                        } else {
                                            echo $pendientes;
                                        }
                                        ?>
                                    </div>
                                    <div class="stat-label">
                                        <?php
                                        if($pendientes === 0){
                                            echo 'Esta solvente';
                                        } else {
                                            echo 'Pendientes por pagar';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 mb-3">
                            <div class="dashboard-card">
                                <div class="card-header">
                                    <div class="card-indicator indicator-reportes">📢</div>
                                    <span class="card-title">Anuncios del edificio</span>
                                </div>
                                <div class="card-content">
                                    <div class="stat-number text-warning">
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
                        <div class="col-md-6 col-sm-6 mb-3">
                            <div class="dashboard-card">
                                <div class="card-header">
                                    <div class="card-indicator indicator-servicios">🔧</div>
                                    <span class="card-title">Servicios</span>
                                </div>
                                <div class="card-content">
                                    <div class="stat-number text-success">
                                        <?php   
                                        include '../../Controlador/funciones/contarservicios.php';
                                        $servicios = contarServicios($conexion);
                                        echo $servicios;
                                        ?>
                                    </div>
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
                            <a href="pagos.php" class="quick-action-btn">
                                <span class="action-text">💰 Realizar Pago</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Anuncios Generales y del Edificio -->
            <div class="row mt-4">
                <!-- Anuncios Generales Recientes -->
                <div class="col-lg-6 mb-4">
                    <div class="dashboard-card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="card-indicator indicator-anuncios">🌐</div>
                                <span class="card-title">Anuncios Generales Recientes</span>
                            </div>
                            <a href="anunciog.php" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-eye me-1"></i>Ver Todos
                            </a>
                        </div>
                        <div class="card-content">
                            <?php include '../../Controlador/funciones/mostraranunciosrecientes.php'; ?>
                        </div>
                    </div>
                </div>

                <!-- Anuncios del Edificio Recientes -->
                <div class="col-lg-6 mb-4">
                    <div class="dashboard-card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="card-indicator indicator-anuncios">🌐</div>
                                <span class="card-title">Anuncios del Edificio Recientes</span>
                            </div>
                            <a href="informacionEdificio.php" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-eye me-1"></i>Ver Todos
                            </a>
                        </div>
                        <div class="card-content">
                            <?php include '../../Controlador/funciones/mostrarinfoEdificioreciente.php'; ?>
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
                                Utiliza este formulario para reportar incidencias, sugerencias, problemas en el sistema o cualquier situación que requiera atención de el presidente central.
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
    <script src="../../Modelo/js/reportes.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
</body>
</html>