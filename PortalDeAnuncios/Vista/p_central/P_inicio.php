<?php
session_start();
if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'presidente_central') {
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
    <title>Portal Presidente Central - La Quinta</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="../css/P_inicio.css" />
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
                            <h1>LA QUINTA  </h1>
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
            <!-- Welcome Section -->
            <div class="welcome-section mb-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2>Bienvenido, <?php echo $_SESSION["nombre_completo"]; ?></h2>
                        <p>Panel de control central para la gestión de toda la Urbanización La Quinta. Coordina con los presidentes de cada edificio, publica anuncios generales y supervisa los servicios de toda la comunidad.</p>
                    </div>
                    <div class="col-md-4 text-center d-none d-md-block">
                        <div style="font-size: 80px; opacity: 0.3; color: white;">🏘️</div>
                    </div>
                </div>
            </div>

            <!-- Dashboard Cards -->
            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <div class="dashboard-card p-3 border rounded h-100">
                        <div class="d-flex align-items-center mb-2">
                            <div class="card-indicator indicator-anuncios me-2">A</div>
                            <span class="card-title h6 mb-0">Anuncios Generales</span>
                        </div>
                        <div class="stat-number text-info fs-4">
                            <?php
                            include '../../Controlador/funciones/contaranuncios.php';
                            echo contarAnuncios($conexion);
                            ?>
                        </div>
                        <div class="stat-label">Activos en toda la urbanización</div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="dashboard-card p-3 border rounded h-100">
                        <div class="d-flex align-items-center mb-2">
                            <div class="card-indicator indicator-comunicacion me-2">I</div>
                            <span class="card-title h6 mb-0">Informes Nuevos</span>
                        </div>
                        <div class="stat-number text-danger fs-4">
                            <?php include '../../Controlador/funciones/contarnuevosinformes.php'; echo $nuevosInformes; ?>
                        </div>
                        <div class="stat-label">De presidentes de edificios</div>
                    </div>
                </div>
            </div>

            <!-- Visits Section -->
            <div class="visits-section mb-4">
                <div class="dashboard-card p-4 border rounded">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center">
                            <div class="card-indicator indicator-visitas me-2">👥</div>
                            <span class="card-title h5 mb-0">Control de Visitas</span>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="visits-filters mb-4">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 mb-2">
                                <?php
                                $currentYear = date('Y');

                                // Obtener años distintos que existen en la tabla
                                $query = "SELECT DISTINCT YEAR(fecha) AS year FROM visitas ORDER BY year DESC";
                                $result = $conexion->query($query);

                                $years = [];
                                if ($result) {
                                    while ($row = $result->fetch_assoc()) {
                                        $years[] = $row['year'];
                                    }
                                }

                                $selectedYear = $_POST['year'] ?? $currentYear;
                                ?>
                                <select id="yearFilter" class="form-select form-select-sm">
                                    <option value="Todoslosaños" <?= ($selectedYear === 'Todoslosaños') ? 'selected' : '' ?>>Todos los años</option>
                                    <?php
                                    foreach ($years as $year) {
                                        $selected = ($year == $selectedYear) ? 'selected' : '';
                                        echo "<option value='$year' $selected>$year</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-3 col-sm-6 mb-2">
                                <?php
                                // Array de meses en español
                                $meses = [
                                    1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
                                    5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
                                    9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
                                ];

                                $currentMonth = date('n');
                                $selectedMonth = $_POST['month'] ?? $currentMonth;
                                ?>
                                <select id="monthFilter" class="form-select form-select-sm">
                                    <option value="Todoslosmeses" <?= ($selectedMonth === 'Todoslosmeses') ? 'selected' : '' ?>>Todos los meses</option>
                                    <?php
                                    foreach ($meses as $num => $nombre) {
                                        $selected = ($num == $selectedMonth) ? 'selected' : '';
                                        echo "<option value='$num' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-2">
                                <button id="filterButton" class="btn btn-primary btn-sm w-100">Filtrar</button>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-2">
                                <button id="clearButton" class="btn btn-outline-secondary btn-sm w-100">Resetear</button>
                            </div>
                        </div>
                    </div>

                    <!-- Visit Statistics -->
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <div class="visit-stat-card p-3 border rounded text-center">
                                <div class="visit-stat-icon mb-2">🏠</div>
                                <div class="visit-stat-number text-primary fs-4" id="visitasResidentes">
                                    
                                </div>
                                <div class="visit-stat-label">Visitas Residentes</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="visit-stat-card p-3 border rounded text-center">
                                <div class="visit-stat-icon mb-2">👔</div>
                                <div class="visit-stat-number text-success fs-4" id="visitasPresidentes">
                                    
                                </div>
                                <div class="visit-stat-label">Visitas Presidentes/Junta</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Tabla Morosos -->
                <div class="row mb-4">
                    <?php include('../../Controlador/funciones/tablamorosostotal.php'); ?>
                </div>
            </div>

            <!-- Quick Actions + Recent Announcements -->
            <div class="row mb-4">
                <!-- Quick Actions -->
                <div class="col-lg-4 mb-4">
                    <div class="dashboard-card p-4 border rounded h-100">
                        <div class="d-flex align-items-center mb-3">
                            <div class="card-indicator indicator-servicios me-2">+</div>
                            <span class="card-title h5 mb-0">Acciones Rápidas</span>
                        </div>
                        <div class="d-grid gap-2">
                            <a href="P_anuncios.php" class="btn btn-outline-secondary btn-sm">
                                <i class="me-2">📢</i>Añadir Anuncio
                            </a>
                            <a href="P_servicios.php" class="btn btn-outline-secondary btn-sm">
                                <i class="me-2">🔧</i>Añadir Servicio
                            </a>
                            <a href="P_comunicacion.php" class="btn btn-outline-secondary btn-sm">
                                <i class="me-2">📧</i>Comunicado General
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Recent Announcements -->
                <div class="col-lg-8 mb-4">
                    <div class="dashboard-card p-4 border rounded h-100">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="d-flex align-items-center">
                                <div class="card-indicator indicator-anuncios me-2">📢</div>
                                <span class="card-title h5 mb-0">Anuncios Recientes</span>
                            </div>
                            <a href="P_anuncios.php" class="btn btn-outline-primary btn-sm">Ver Todos</a>
                        </div>
                        
                        <div id="announcementsList" class="announcements-container" style="max-height: 400px; overflow-y: auto;">
                            <?php include '../../Controlador/funciones/mostraranunciosrecientes.php'; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reportes de Usuarios Section -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="dashboard-card p-4 border rounded">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="d-flex align-items-center">
                                <div class="card-indicator indicator-comunicacion me-2">📋</div>
                                <span class="card-title h5 mb-0">Reportes de Usuarios</span>
                            </div>
                            <div class="d-flex gap-2">
                                <button class="btn btn-outline-danger btn-sm w-100" onclick="imprimirReportesPDF()">
                                <i class="fas fa-file-pdf"></i> Imprimir PDF
                                </button>
                                <button class="btn btn-outline-secondary btn-sm" onclick="location.reload()">
    <i class="fas fa-sync-alt me-1"></i>Actualizar
</button>

                            </div>
                        </div>
                        
                        <!-- Filtros para reportes -->
                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-6 mb-2">
                                <select id="filtroEstado" class="form-select form-select-sm">
                                    <option value="todos">Todos los estados</option>
                                    <option value="pendiente">Pendientes</option>
                                    <option value="en_proceso">En Proceso</option>
                                    <option value="resuelto">Resueltos</option>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-2">
                                <input type="text" id="filtroUsuario" class="form-control form-control-sm" placeholder="Buscar por usuario...">
                            </div>
                            <div class="col-md-2 col-sm-6 mb-2">
                                <button class="btn btn-primary btn-sm w-100" onclick="filtrarReportes()">Filtrar</button>
                            </div>
                            <div class="col-md-2 col-sm-6 mb-2">
                                <button class="btn btn-outline-secondary btn-sm w-100" onclick="limpiarFiltros()">Limpiar</button>
                            </div>
                        </div>

                        <!-- Estadísticas rápidas -->
                        <div class="row mb-3">
                            <div class="col-md-3 col-6 mb-2">
                                <div class="text-center p-2 border rounded">
                                    <div class="fw-bold text-danger fs-5" id="totalPendientes">
                                        <?php
                                        $queryPendientes = "SELECT COUNT(*) as total FROM reportes WHERE estado = 'pendiente'";
                                        $resultPendientes = $conexion->query($queryPendientes);
                                        $totalPendientes = $resultPendientes ? $resultPendientes->fetch_assoc()['total'] : 0;
                                        echo $totalPendientes;
                                        ?>
                                    </div>
                                    <small class="text-muted">Pendientes</small>
                                </div>
                            </div>
                            <div class="col-md-3 col-6 mb-2">
                                <div class="text-center p-2 border rounded">
                                    <div class="fw-bold text-warning fs-5" id="totalProceso">
                                        <?php
                                        $queryProceso = "SELECT COUNT(*) as total FROM reportes WHERE estado = 'en_proceso'";
                                        $resultProceso = $conexion->query($queryProceso);
                                        $totalProceso = $resultProceso ? $resultProceso->fetch_assoc()['total'] : 0;
                                        echo $totalProceso;
                                        ?>
                                    </div>
                                    <small class="text-muted">En Proceso</small>
                                </div>
                            </div>
                            <div class="col-md-3 col-6 mb-2">
                                <div class="text-center p-2 border rounded">
                                    <div class="fw-bold text-success fs-5" id="totalResueltos">
                                        <?php
                                        $queryResueltos = "SELECT COUNT(*) as total FROM reportes WHERE estado = 'resuelto'";
                                        $resultResueltos = $conexion->query($queryResueltos);
                                        $totalResueltos = $resultResueltos ? $resultResueltos->fetch_assoc()['total'] : 0;
                                        echo $totalResueltos;
                                        ?>
                                    </div>
                                    <small class="text-muted">Resueltos</small>
                                </div>
                            </div>
                            <div class="col-md-3 col-6 mb-2">
                                <div class="text-center p-2 border rounded">
                                    <div class="fw-bold text-info fs-5" id="totalReportes">
                                        <?php
                                        $queryTotal = "SELECT COUNT(*) as total FROM reportes";
                                        $resultTotal = $conexion->query($queryTotal);
                                        $totalReportes = $resultTotal ? $resultTotal->fetch_assoc()['total'] : 0;
                                        echo $totalReportes;
                                        ?>
                                    </div>
                                    <small class="text-muted">Total</small>
                                </div>
                            </div>
                        </div>

                        <!-- Tabla de reportes -->
                        <?php
// Definir registros por página
$registrosPorPagina = 10;

// Obtener la página actual desde GET, por defecto 1
$paginaActual = isset($_GET['pagina']) && is_numeric($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

// Calcular el offset para la consulta SQL
$offset = ($paginaActual - 1) * $registrosPorPagina;

// Obtener total de registros
$queryTotal = "SELECT COUNT(*) as total FROM reportes";
$resultTotal = $conexion->query($queryTotal);
$totalReportes = $resultTotal ? $resultTotal->fetch_assoc()['total'] : 0;

// Calcular total de páginas
$totalPaginas = ceil($totalReportes / $registrosPorPagina);

// Consulta con LIMIT y OFFSET para la página actual
$queryReportes = "SELECT id, usuario, nombre_completo, asunto, descripcion, telefono, fecha, estado, ubicacion 
                  FROM reportes 
                  ORDER BY fecha DESC 
                  LIMIT $registrosPorPagina OFFSET $offset";

$resultReportes = $conexion->query($queryReportes);
?>

<!-- Tabla -->
<div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
    <table class="table table-hover table-striped" id="tablaReportes">
        <thead class="table-dark sticky-top">
            <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 15%;">Usuario</th>
                <th style="width: 12%;">Ubicación</th>
                <th style="width: 15%;">Asunto</th>
                <th style="width: 25%;">Descripción</th>
                <th style="width: 10%;">Teléfono</th>
                <th style="width: 10%;">Fecha</th>
                <th style="width: 8%;">Estado</th>
                <th style="width: 10%;">Acciones</th>
            </tr>
        </thead>
        <tbody id="cuerpoTablaReportes">
            <?php
            if ($resultReportes && $resultReportes->num_rows > 0) {
                $contador = $offset + 1;  // Para que la numeración sea continua entre páginas
                while ($reporte = $resultReportes->fetch_assoc()) {
                    $fechaFormateada = date('d/m/Y H:i', strtotime($reporte['fecha']));
                    $badgeClass = '';
                    $estadoTexto = '';
                    switch($reporte['estado']) {
                        case 'pendiente':
                            $badgeClass = 'bg-danger';
                            $estadoTexto = 'Pendiente';
                            break;
                        case 'en_proceso':
                            $badgeClass = 'bg-warning';
                            $estadoTexto = 'En Proceso';
                            break;
                        case 'resuelto':
                            $badgeClass = 'bg-success';
                            $estadoTexto = 'Resuelto';
                            break;
                        default:
                            $badgeClass = 'bg-secondary';
                            $estadoTexto = ucfirst($reporte['estado']);
                    }
                    $descripcionCorta = strlen($reporte['descripcion']) > 50 ? substr($reporte['descripcion'], 0, 50) . '...' : $reporte['descripcion'];

                    echo "<tr data-id='{$reporte['id']}' data-estado='{$reporte['estado']}' data-usuario='{$reporte['usuario']}'>
                            <td>{$contador}</td>
                            <td title='{$reporte['nombre_completo']}'>" . substr($reporte['nombre_completo'], 0, 20) . (strlen($reporte['nombre_completo']) > 20 ? '...' : '') . "</td>
                            <td>{$reporte['ubicacion']}</td>
                            <td title='{$reporte['asunto']}'>" . substr($reporte['asunto'], 0, 20) . (strlen($reporte['asunto']) > 20 ? '...' : '') . "</td>
                            <td title='{$reporte['descripcion']}'>{$descripcionCorta}</td>
                            <td>{$reporte['telefono']}</td>
                            <td>{$fechaFormateada}</td>
                            <td><span class='badge {$badgeClass}'>{$estadoTexto}</span></td>
                            <td>
                                <div class='btn-group' role='group'>";
                    if ($reporte['estado'] !== 'resuelto') {
                        echo "<button class='btn btn-success btn-sm' onclick='cambiarEstado({$reporte['id']}, \"resuelto\")' title='Marcar como resuelto'>
                                <i class='fas fa-check'></i>
                              </button>";
                        if ($reporte['estado'] === 'pendiente') {
                            echo "<button class='btn btn-warning btn-sm' onclick='cambiarEstado({$reporte['id']}, \"en_proceso\")' title='Marcar en proceso'>
                                    <i class='fas fa-clock'></i>
                                  </button>";
                        }
                    }
                    echo "      <button class='btn btn-info btn-sm' onclick='verDetalle({$reporte['id']})' title='Ver detalles'>
                                    <i class='fas fa-eye'></i>
                                </button>
                            </div>
                        </td>
                      </tr>";
                    $contador++;
                }
            } else {
                echo "<tr><td colspan='9' class='text-center text-muted'>No hay reportes registrados</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Paginación -->
<nav aria-label="Paginación de reportes">
    <ul class="pagination justify-content-center mt-3">
        <!-- Botón anterior -->
        <li class="page-item <?php if($paginaActual <= 1) echo 'disabled'; ?>">
            <a class="page-link" href="?pagina=<?php echo $paginaActual - 1; ?>" tabindex="-1">Anterior</a>
        </li>

        <?php
        // Mostrar enlaces numéricos (puedes limitar el rango si quieres)
        for ($i = 1; $i <= $totalPaginas; $i++) {
            $activo = ($i == $paginaActual) ? 'active' : '';
            echo "<li class='page-item $activo'><a class='page-link' href='?pagina=$i'>$i</a></li>";
        }
        ?>

        <!-- Botón siguiente -->
        <li class="page-item <?php if($paginaActual >= $totalPaginas) echo 'disabled'; ?>">
            <a class="page-link" href="?pagina=<?php echo $paginaActual + 1; ?>">Siguiente</a>
        </li>
    </ul>
</nav>

                    </div>
                </div>
            </div>
        </div>
    </main>
<!-- Modal para mostrar detalles del reporte -->
<div class="modal fade" id="detalleModal" tabindex="-1" aria-labelledby="detalleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detalleModalLabel">Detalle del reporte</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
            <tr><th>ID</th><td id="detalleId"></td></tr>
            <tr><th>Usuario</th><td id="detalleUsuario"></td></tr>
            <tr><th>Nombre Completo</th><td id="detalleNombreCompleto"></td></tr>
            <tr><th>Asunto</th><td id="detalleAsunto"></td></tr>
            <tr><th>Descripción</th><td id="detalleDescripcion"></td></tr>
            <tr><th>Teléfono</th><td id="detalleTelefono"></td></tr>
            <tr><th>Fecha</th><td id="detalleFecha"></td></tr>
            <tr><th>Estado</th><td id="detalleEstado"></td></tr>
            <tr><th>Ubicación</th><td id="detalleUbicacion"></td></tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../Modelo/js/menuHamburguesa.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="../../Modelo/js/ver_reportes.js"></script>
    <script>
  document.addEventListener('DOMContentLoaded', function() {
    const filterButton = document.getElementById('filterButton');
    const clearButton = document.getElementById('clearButton');
    const yearFilter = document.getElementById('yearFilter');
    const monthFilter = document.getElementById('monthFilter');

    // Obtener año y mes actuales al cargar la página
     const initialYear = yearFilter.value;
    const initialMonth = monthFilter.value;
    // Establecer los valores seleccionados por defecto en el select
    yearFilter.value = initialYear;
    monthFilter.value = initialMonth;

    // Función para cargar estadísticas
    function cargarEstadisticas(year = '', month = '') {
        fetch('../../Controlador/funciones/filtrarvisitas.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `year=${year}&month=${month}`
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('visitasResidentes').textContent = data.visitas_residentes;
            document.getElementById('visitasPresidentes').textContent = data.visitas_presidentes;
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    // Ejecutar la carga inicial
    cargarEstadisticas(initialYear, initialMonth);

    // Al hacer clic en filtrar
    filterButton.addEventListener('click', function() {
        cargarEstadisticas(yearFilter.value, monthFilter.value);

        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Filtros aplicados',
            showConfirmButton: false,
            timer: 2000,
            toast: true
        });
    });

    // Al hacer clic en limpiar
    clearButton.addEventListener('click', function() {
        yearFilter.value = initialYear;
        monthFilter.value = initialMonth;
        cargarEstadisticas(initialYear, initialMonth);

        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Filtros restablecidos',
            showConfirmButton: false,
            timer: 2000,
            toast: true
        });
    });
});


    </script>
</body>
</html>