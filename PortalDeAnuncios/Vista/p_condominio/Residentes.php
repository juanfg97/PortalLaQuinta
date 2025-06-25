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
    <title>Residentes - Portal Presidente condominio - La Quinta</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../Img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/residentes.css">
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
                    <h5>Bienvenido <?php echo htmlspecialchars($_SESSION['nombre_completo'] ?? 'Usuario'); ?><br>Presidente de la junta de condominio<br>Edificio <?php echo htmlspecialchars($_SESSION['Edificio'] ?? 'N/A'); ?></h5>
                    <a href="../../Controlador/cerrar_sesion.php" class="btn btn-outline-primary btn-sm">
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
                        <h5>Bienvenido <?php echo htmlspecialchars($_SESSION['nombre_completo'] ?? 'Usuario'); ?></h5>
                        <small>Presidente - Terraza <?php echo htmlspecialchars($_SESSION['Terraza'] ?? 'N/A'); ?> Edificio <?php echo htmlspecialchars($_SESSION['Edificio'] ?? 'N/A'); ?></small>
                        <div class="mt-2">
                            <a href="../../Controlador/cerrar_sesion.php" class="btn btn-outline-primary btn-sm">
                                Cerrar Sesión
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

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
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2>Gestión de Residentes</h2>
                        <p>Administra la información de todos los residentes del Edificio <?php echo htmlspecialchars($_SESSION['Terraza'].$_SESSION['Edificio']); ?></p>
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
                    <h4>Lista de Residentes</h4>
                    <div class="records-info">
                        <span id="recordsInfo">Cargando...</span>
                    </div>
                </div>
                
                <div class="table-container">
                    <!-- Desktop Table -->
                    <div class="table-responsive">
                        <table class="table residents-table">
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Nombre Completo</th>
                                    <th>Correo Electrónico</th>
                                    <th>Teléfono</th>
                                </tr>
                            </thead>
                            <tbody id="residentsTableBody">
                                <!-- Los datos se insertarán aquí via JavaScript -->
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Mobile Cards -->
                    <div class="mobile-cards" id="mobileCards">
                        <!-- Las tarjetas se insertarán aquí via JavaScript -->
                    </div>
                    
                    <div id="noResultsMessage" class="text-center text-danger fw-bold py-3" style="display: none;">
                        No se ha encontrado lo ingresado.
                    </div>
                </div>
                
                <!-- Pagination -->
                <div class="pagination-container">
                    <div class="pagination-info">
                        <span id="paginationInfo">Cargando...</span>
                    </div>
                    <div class="pagination-controls">
                        <div class="page-size-selector">
                            <span>Mostrar:</span>
                            <select id="pageSize">
                                <option value="5">5</option>
                                <option value="10" selected>10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                            <span>por página</span>
                        </div>
                        <div class="pagination-buttons" id="paginationButtons">
                            <!-- Los botones se generarán dinámicamente -->
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
                    <span><i class="fas fa-map-marker-alt"></i> Av. Víctor Baptista, Los Teques</span>
                    <span><i class="fas fa-phone"></i> Tel: (032) 31.1221</span>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="../../Modelo/js/menuHamburguesa.js"></script>
    
    <script>
// Obtener datos de residentes desde PHP
// Variables globales
let residentsData = [];
let filteredData = [];
let currentPage = 1;
let pageSize = 10;

<?php 
try {
    // Verificar que las variables de sesión existan
    if (!isset($_SESSION['Terraza']) || !isset($_SESSION['Edificio'])) {
        echo "console.error('Variables de sesión no encontradas');";
        echo "residentsData = [];";
    } else {
        $query = "SELECT usuario, nombre_completo, correo, telefono FROM edificios WHERE Terraza = ? AND Edificio = ?";
        $stmt = $conexion->prepare($query);
        
        if ($stmt) {
            $stmt->bind_param("ss", $_SESSION['Terraza'], $_SESSION['Edificio']);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $residents = [];
            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $residents[] = [
                        'usuario' => htmlspecialchars($row['usuario'] ?? 'N/A'),
                        'nombre' => htmlspecialchars($row['nombre_completo'] ?? 'N/A'),
                        'email' => htmlspecialchars($row['correo'] ?? 'N/A'),
                        'telefono' => htmlspecialchars($row['telefono'] ?? 'N/A')
                    ];
                }
            }
            
            echo "residentsData = " . json_encode($residents, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) . ";";
            echo "console.log('Datos cargados:', residentsData);";
            
            $stmt->close();
        } else {
            echo "console.error('Error preparando consulta');";
            echo "residentsData = [];";
        }
    }
} 
catch (Exception $e) {
    echo "console.error('Error: " . addslashes($e->getMessage()) . "');";
    echo "residentsData = [];";
}
?>

// Función para detectar si estamos en vista móvil
function isMobileView() {
    return window.innerWidth <= 768;
}

// Función para obtener iniciales del nombre
function getInitials(name) {
    if (!name || name === 'N/A') return '?';
    return name.split(' ').map(word => word.charAt(0).toUpperCase()).slice(0, 2).join('');
}

// Función para renderizar tabla en desktop
function renderTable() {
    // Solo renderizar si NO estamos en vista móvil
    if (isMobileView()) return;
    
    const tbody = document.getElementById('residentsTableBody');
    if (!tbody) return;

    const start = (currentPage - 1) * pageSize;
    const end = start + pageSize;
    const pageData = filteredData.slice(start, end);

    tbody.innerHTML = '';

    if (pageData.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="4" class="text-center text-muted py-4">
                    <i class="fas fa-users fa-2x mb-2"></i><br>
                    No hay residentes para mostrar
                </td>
            </tr>
        `;
        return;
    }

    pageData.forEach(resident => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td><strong>${resident.usuario}</strong></td>
            <td>${resident.nombre}</td>
            <td>
                ${resident.email !== 'N/A' ? 
                    `<a href="mailto:${resident.email}" class="contact-email">${resident.email}</a>` : 
                    '<span class="text-muted">No disponible</span>'
                }
            </td>
            <td>
                ${resident.telefono !== 'N/A' ? 
                    `<a href="tel:${resident.telefono}" class="text-decoration-none">${resident.telefono}</a>` : 
                    '<span class="text-muted">No disponible</span>'
                }
            </td>
        `;
        tbody.appendChild(row);
    });
}

// Función para renderizar tarjetas en móvil
function renderMobileCards() {
    // Solo renderizar si estamos en vista móvil
    if (!isMobileView()) return;
    
    const container = document.getElementById('mobileCards');
    if (!container) return;

    const start = (currentPage - 1) * pageSize;
    const end = start + pageSize;
    const pageData = filteredData.slice(start, end);

    container.innerHTML = '';

    if (pageData.length === 0) {
        container.innerHTML = `
            <div class="text-center text-muted py-4">
                <i class="fas fa-users fa-3x mb-3"></i>
                <h6>No hay residentes para mostrar</h6>
                <p class="small">No se encontraron residentes que coincidan con los criterios.</p>
            </div>
        `;
        return;
    }

    pageData.forEach(resident => {
        const card = document.createElement('div');
        card.className = 'resident-card';
        card.innerHTML = `
            <div class="card-header">
                <div class="user-avatar">
                    ${getInitials(resident.nombre)}
                </div>
                <div class="card-title">
                    <h6>${resident.nombre}</h6>
                    <small>Usuario: ${resident.usuario}</small>
                </div>
            </div>
            <div class="card-details">
                <div class="detail-item">
                    <i class="fas fa-envelope"></i>
                    <span>
                        ${resident.email !== 'N/A' ? 
                            `<a href="mailto:${resident.email}" class="contact-email">${resident.email}</a>` : 
                            '<span class="text-muted">No disponible</span>'
                        }
                    </span>
                </div>
                <div class="detail-item">
                    <i class="fas fa-phone"></i>
                    <span>
                        ${resident.telefono !== 'N/A' ? 
                            `<a href="tel:${resident.telefono}" class="text-decoration-none">${resident.telefono}</a>` : 
                            '<span class="text-muted">No disponible</span>'
                        }
                    </span>
                </div>
            </div>
        `;
        container.appendChild(card);
    });
}

// Función para actualizar información de registros
function updateRecordsInfo() {
    const recordsInfo = document.getElementById('recordsInfo');
    const paginationInfo = document.getElementById('paginationInfo');
    
    if (recordsInfo) {
        recordsInfo.textContent = `${filteredData.length} residente${filteredData.length !== 1 ? 's' : ''} encontrado${filteredData.length !== 1 ? 's' : ''}`;
    }

    if (paginationInfo) {
        const start = (currentPage - 1) * pageSize + 1;
        const end = Math.min(currentPage * pageSize, filteredData.length);
        const total = filteredData.length;
        
        if (total === 0) {
            paginationInfo.textContent = 'No hay registros para mostrar';
        } else {
            paginationInfo.textContent = `Mostrando ${start} a ${end} de ${total} registros`;
        }
    }
}

// Función para renderizar botones de paginación
function renderPagination() {
    const container = document.getElementById('paginationButtons');
    if (!container) return;

    const totalPages = Math.ceil(filteredData.length / pageSize);
    container.innerHTML = '';

    if (totalPages <= 1) return;

    // Botón anterior
    const prevBtn = document.createElement('button');
    prevBtn.className = 'pagination-btn';
    prevBtn.innerHTML = '<i class="fas fa-chevron-left"></i>';
    prevBtn.disabled = currentPage === 1;
    prevBtn.onclick = () => {
        if (currentPage > 1) {
            currentPage--;
            renderAll();
        }
    };
    container.appendChild(prevBtn);

    // Botones de páginas
    const maxVisiblePages = 5;
    let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
    let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

    if (endPage - startPage < maxVisiblePages - 1) {
        startPage = Math.max(1, endPage - maxVisiblePages + 1);
    }

    for (let i = startPage; i <= endPage; i++) {
        const pageBtn = document.createElement('button');
        pageBtn.className = 'pagination-btn';
        pageBtn.textContent = i;
        pageBtn.onclick = () => {
            currentPage = i;
            renderAll();
        };
        
        if (i === currentPage) {
            pageBtn.classList.add('active');
        }
        
        container.appendChild(pageBtn);
    }

    // Botón siguiente
    const nextBtn = document.createElement('button');
    nextBtn.className = 'pagination-btn';
    nextBtn.innerHTML = '<i class="fas fa-chevron-right"></i>';
    nextBtn.disabled = currentPage === totalPages;
    nextBtn.onclick = () => {
        if (currentPage < totalPages) {
            currentPage++;
            renderAll();
        }
    };
    container.appendChild(nextBtn);
}

// Función para renderizar todo
function renderAll() {
    // Limpiar ambos contenedores primero
    const tbody = document.getElementById('residentsTableBody');
    const mobileContainer = document.getElementById('mobileCards');
    
    if (tbody) tbody.innerHTML = '';
    if (mobileContainer) mobileContainer.innerHTML = '';
    
    // Renderizar solo la vista apropiada
    if (isMobileView()) {
        renderMobileCards();
    } else {
        renderTable();
    }
    
    updateRecordsInfo();
    renderPagination();
    toggleNoResults();
}

// Función para mostrar/ocultar mensaje de sin resultados
function toggleNoResults() {
    const noResultsMessage = document.getElementById('noResultsMessage');
    const tableContainer = document.querySelector('.table-responsive');
    const mobileContainer = document.getElementById('mobileCards');
    
    if (filteredData.length === 0) {
        if (noResultsMessage) noResultsMessage.style.display = 'block';
        if (tableContainer) tableContainer.style.display = 'none';
        if (mobileContainer) mobileContainer.style.display = 'none';
    } else {
        if (noResultsMessage) noResultsMessage.style.display = 'none';
        if (tableContainer) tableContainer.style.display = 'block';
        if (mobileContainer) mobileContainer.style.display = 'block';
    }
}

// Función de búsqueda
function performSearch() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase().trim();
    
    if (searchTerm === '') {
        filteredData = [...residentsData];
    } else {
        filteredData = residentsData.filter(resident => {
            return resident.usuario.toLowerCase().includes(searchTerm) ||
                   resident.nombre.toLowerCase().includes(searchTerm) ||
                   resident.email.toLowerCase().includes(searchTerm) ||
                   resident.telefono.toLowerCase().includes(searchTerm);
        });
    }
    
    currentPage = 1;
    renderAll();
}

// Event Listeners
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM cargado, inicializando...');
    
    // Inicializar datos filtrados
    filteredData = [...residentsData];
    
    // Inicializar vista
    renderAll();
    
    // Búsqueda
    const searchInput = document.getElementById('searchInput');
    const searchBtn = document.getElementById('searchBtn');
    
    if (searchInput) {
        searchInput.addEventListener('input', performSearch);
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });
    }
    
    if (searchBtn) {
        searchBtn.addEventListener('click', performSearch);
    }
    
    // Cambio de tamaño de página
    const pageSizeSelect = document.getElementById('pageSize');
    if (pageSizeSelect) {
        pageSizeSelect.addEventListener('change', function() {
            pageSize = parseInt(this.value);
            currentPage = 1;
            renderAll();
        });
    }
    
    // Re-renderizar al redimensionar ventana
    window.addEventListener('resize', function() {
        // Re-renderizar con un pequeño delay para evitar múltiples llamadas
        clearTimeout(window.resizeTimer);
        window.resizeTimer = setTimeout(function() {
            renderAll();
        }, 100);
    });
    
    console.log('Inicialización completa');
});
    </script>
        