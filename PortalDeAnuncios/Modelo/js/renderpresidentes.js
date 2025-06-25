// Variables globales para paginación
let currentPage = 1;
let itemsPerPage = 10;
let totalPresidentes = 0;
let allPresidentes = [];
let filteredPresidentes = [];

// Función para cargar y renderizar los presidentes
async function loadPresidentes() {
    const tableBody = document.getElementById('presidentTableBody');
    const mobileCards = document.getElementById('mobileCards');
    
    try {
        // Mostrar indicador de carga
        showLoadingState();

        // Realizar petición AJAX para obtener los datos
        const response = await fetch('../../Controlador/funciones/mostrarPresidentes.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            }
        });

        if (!response.ok) {
            throw new Error(`Error HTTP: ${response.status}`);
        }

        const data = await response.json();
        
        if (data.success && data.presidentes && data.presidentes.length > 0) {
            allPresidentes = data.presidentes;
            filteredPresidentes = [...allPresidentes];
            totalPresidentes = filteredPresidentes.length;
            
            // Resetear a la primera página
            currentPage = 1;
            
            // Renderizar presidentes con paginación
            renderPresidentesPage();
            updatePaginationControls();
        } else {
            // No hay presidentes
            showEmptyState();
        }

    } catch (error) {
        console.error('Error al cargar presidentes:', error);
        showErrorState(error.message);
    }
}

// Función para mostrar estado de carga
function showLoadingState() {
    const tableBody = document.getElementById('presidentTableBody');
    const mobileCards = document.getElementById('mobileCards');
    
    const loadingHTML = `
        <div class="text-center py-4">
            <div class="loading">
                <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                Cargando presidentes...
            </div>
        </div>
    `;
    
    tableBody.innerHTML = `
        <tr>
            <td colspan="5" class="text-center">
                ${loadingHTML}
            </td>
        </tr>
    `;
    
    if (mobileCards) {
        mobileCards.innerHTML = loadingHTML;
    }
}

// Función para mostrar estado vacío
function showEmptyState() {
    const tableBody = document.getElementById('presidentTableBody');
    const mobileCards = document.getElementById('mobileCards');
    
    const emptyHTML = `
        <div class="text-center text-muted py-4">
            No se encontraron presidentes registrados
        </div>
    `;
    
    tableBody.innerHTML = `
        <tr>
            <td colspan="5" class="text-center text-muted py-4">
                ${emptyHTML}
            </td>
        </tr>
    `;
    
    if (mobileCards) {
        mobileCards.innerHTML = emptyHTML;
    }
    
    // Ocultar controles de paginación
    const paginationSection = document.querySelector('.pagination-section');
    if (paginationSection) {
        paginationSection.style.display = 'none';
    }
}

// Función para mostrar estado de error
function showErrorState(errorMessage) {
    const tableBody = document.getElementById('presidentTableBody');
    const mobileCards = document.getElementById('mobileCards');
    
    const errorHTML = `
        <div class="text-center text-danger py-4">
            <div class="error">
                <strong>Error al cargar los datos:</strong><br>
                ${errorMessage}
            </div>
        </div>
    `;
    
    tableBody.innerHTML = `
        <tr>
            <td colspan="5" class="text-center text-danger py-4">
                ${errorHTML}
            </td>
        </tr>
    `;
    
    if (mobileCards) {
        mobileCards.innerHTML = errorHTML;
    }
}

// Función para renderizar presidentes de la página actual
function renderPresidentesPage() {
    const tableBody = document.getElementById('presidentTableBody');
    let mobileCards = document.getElementById('mobileCards');
    
    // Crear contenedor móvil si no existe
    if (!mobileCards) {
        mobileCards = document.createElement('div');
        mobileCards.id = 'mobileCards';
        mobileCards.className = 'mobile-cards';
        
        const tableContainer = document.querySelector('.table-responsive');
        if (tableContainer && tableContainer.parentNode) {
            tableContainer.parentNode.insertBefore(mobileCards, tableContainer.nextSibling);
        }
    }
    
    // Calcular índices para la página actual
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = Math.min(startIndex + itemsPerPage, filteredPresidentes.length);
    const currentPagePresidentes = filteredPresidentes.slice(startIndex, endIndex);
    
    // Limpiar contenido anterior
    tableBody.innerHTML = '';
    mobileCards.innerHTML = '';
    
    if (currentPagePresidentes.length === 0) {
        showEmptyState();
        return;
    }
    
    // Renderizar cada presidente
    currentPagePresidentes.forEach(presidente => {
        renderPresidenteDesktop(presidente, tableBody);
        renderPresidenteMobile(presidente, mobileCards);
    });
    
    // Mostrar controles de paginación
    const paginationSection = document.querySelector('.pagination-section');
    if (paginationSection) {
        paginationSection.style.display = 'flex';
    }
}

// Función para renderizar un presidente en la tabla (desktop)
function renderPresidenteDesktop(presidente, tableBody) {
    const edificio = presidente.Terraza + presidente.Edificio; // ej: "1A"
    
    const row = document.createElement('tr');
    row.setAttribute('data-terraza', presidente.Terraza);
    row.setAttribute('data-edificio', presidente.Edificio);
    
    row.innerHTML = `
        <td>
            <div class="d-flex align-items-center">
                <div class="ms-3">
                    <strong>${edificio}</strong>
                </div>
            </div>
        </td>
        <td>${escapeHtml(presidente.nombre_completo)}</td>
        <td>
            <div class="contact-info">
                <a href="mailto:${escapeHtml(presidente.correo)}" class="contact-email">
                    ${escapeHtml(presidente.correo)}
                </a>
            </div>
        </td>
        <td>
            <div class="contact-phone">${escapeHtml(presidente.telefono)}</div>
        </td>
        <td>
            <div class="action-buttons">
                <button type="button" class="btn btn-danger btn-sm btn-delete"
                        data-terraza="${presidente.Terraza}"
                        data-edificio="${escapeHtml(presidente.Edificio)}"
                        data-name="${escapeHtml(presidente.nombre_completo)}"
                        data-building="${edificio}">
                    🗑️ Eliminar
                </button>
            </div>
        </td>
    `;
    
    tableBody.appendChild(row);
}

// Función para renderizar un presidente en tarjeta móvil
function renderPresidenteMobile(presidente, mobileCards) {
    const edificio = presidente.Terraza + presidente.Edificio; // ej: "1A"
    
    const card = document.createElement('div');
    card.className = 'president-card';
    card.setAttribute('data-terraza', presidente.Terraza);
    card.setAttribute('data-edificio', presidente.Edificio);
    
    card.innerHTML = `
        <div class="card-header">
            <div class="building-badge">${edificio}</div>
        </div>
        <div class="card-body">
            <div class="card-field">
                <div class="card-field-label">Nombre Completo</div>
                <div class="card-field-value">${escapeHtml(presidente.nombre_completo)}</div>
            </div>
            <div class="card-field">
                <div class="card-field-label">Correo Electrónico</div>
                <div class="card-field-value">
                    <a href="mailto:${escapeHtml(presidente.correo)}">
                        ${escapeHtml(presidente.correo)}
                    </a>
                </div>
            </div>
            <div class="card-field">
                <div class="card-field-label">Teléfono</div>
                <div class="card-field-value">${escapeHtml(presidente.telefono)}</div>
            </div>
        </div>
        <div class="card-actions">
            <button type="button" class="btn btn-danger btn-sm btn-delete"
                    data-terraza="${presidente.Terraza}"
                    data-edificio="${escapeHtml(presidente.Edificio)}"
                    data-name="${escapeHtml(presidente.nombre_completo)}"
                    data-building="${edificio}">
                🗑️ Eliminar
            </button>
        </div>
    `;
    
    mobileCards.appendChild(card);
}

// Función para escapar HTML y prevenir XSS
function escapeHtml(text) {
    if (text == null) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// Función para filtrar presidentes en tiempo real
function filterPresidentes() {
    const searchInput = document.getElementById('searchInput');
    const searchTerm = searchInput.value.toLowerCase().trim();
    
    if (searchTerm === '') {
        // Si no hay término de búsqueda, mostrar todos
        filteredPresidentes = [...allPresidentes];
    } else {
        // Filtrar por término de búsqueda
        filteredPresidentes = allPresidentes.filter(presidente => {
            const edificio = presidente.Terraza + presidente.Edificio;
            const searchableText = [
                edificio,
                presidente.nombre_completo,
                presidente.correo,
                presidente.telefono
            ].join(' ').toLowerCase();
            
            return searchableText.includes(searchTerm);
        });
    }
    
    // Actualizar total y resetear a primera página
    totalPresidentes = filteredPresidentes.length;
    currentPage = 1;
    
    // Renderizar resultados
    renderPresidentesPage();
    updatePaginationControls();
    
    // Manejar mensaje de "no encontrado"
    const noResultsMessage = document.getElementById('noResultsMessage');
    if (noResultsMessage) {
        if (filteredPresidentes.length === 0 && searchTerm !== '') {
            noResultsMessage.style.display = 'block';
        } else {
            noResultsMessage.style.display = 'none';
        }
    }
}

// Función para actualizar controles de paginación
function updatePaginationControls() {
    const totalPages = Math.ceil(totalPresidentes / itemsPerPage);
    
    // Actualizar información de paginación
    updatePaginationInfo();
    
    // Actualizar navegación de páginas
    updatePaginationNav(totalPages);
}

// Función para actualizar información de paginación
function updatePaginationInfo() {
    const paginationInfo = document.querySelector('.pagination-info');
    if (!paginationInfo) return;
    
    const startItem = totalPresidentes === 0 ? 0 : (currentPage - 1) * itemsPerPage + 1;
    const endItem = Math.min(currentPage * itemsPerPage, totalPresidentes);
    
    paginationInfo.textContent = `Mostrando ${startItem} - ${endItem} de ${totalPresidentes} presidentes`;
}

// Función para actualizar navegación de páginas
function updatePaginationNav(totalPages) {
    const paginationNav = document.querySelector('.pagination-nav');
    if (!paginationNav) return;
    
    paginationNav.innerHTML = '';
    
    // Botón anterior
    const prevItem = document.createElement('li');
    prevItem.className = `page-item ${currentPage === 1 ? 'disabled' : ''}`;
    prevItem.innerHTML = `
        <a class="page-link" href="#" onclick="changePage(${currentPage - 1}); return false;">
            ← Anterior
        </a>
    `;
    paginationNav.appendChild(prevItem);
    
    // Páginas numeradas
    const maxVisiblePages = 5;
    let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
    let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);
    
    // Ajustar startPage si estamos cerca del final
    if (endPage - startPage < maxVisiblePages - 1) {
        startPage = Math.max(1, endPage - maxVisiblePages + 1);
    }
    
    // Primera página si no está visible
    if (startPage > 1) {
        const firstPageItem = document.createElement('li');
        firstPageItem.className = 'page-item';
        firstPageItem.innerHTML = `
            <a class="page-link" href="#" onclick="changePage(1); return false;">1</a>
        `;
        paginationNav.appendChild(firstPageItem);
        
        if (startPage > 2) {
            const ellipsisItem = document.createElement('li');
            ellipsisItem.className = 'page-item disabled';
            ellipsisItem.innerHTML = '<span class="page-link">...</span>';
            paginationNav.appendChild(ellipsisItem);
        }
    }
    
    // Páginas visibles
    for (let i = startPage; i <= endPage; i++) {
        const pageItem = document.createElement('li');
        pageItem.className = `page-item ${i === currentPage ? 'active' : ''}`;
        pageItem.innerHTML = `
            <a class="page-link" href="#" onclick="changePage(${i}); return false;">${i}</a>
        `;
        paginationNav.appendChild(pageItem);
    }
    
    // Última página si no está visible
    if (endPage < totalPages) {
        if (endPage < totalPages - 1) {
            const ellipsisItem = document.createElement('li');
            ellipsisItem.className = 'page-item disabled';
            ellipsisItem.innerHTML = '<span class="page-link">...</span>';
            paginationNav.appendChild(ellipsisItem);
        }
        
        const lastPageItem = document.createElement('li');
        lastPageItem.className = 'page-item';
        lastPageItem.innerHTML = `
            <a class="page-link" href="#" onclick="changePage(${totalPages}); return false;">${totalPages}</a>
        `;
        paginationNav.appendChild(lastPageItem);
    }
    
    // Botón siguiente
    const nextItem = document.createElement('li');
    nextItem.className = `page-item ${currentPage === totalPages || totalPages === 0 ? 'disabled' : ''}`;
    nextItem.innerHTML = `
        <a class="page-link" href="#" onclick="changePage(${currentPage + 1}); return false;">
            Siguiente →
        </a>
    `;
    paginationNav.appendChild(nextItem);
}

// Función para cambiar página
function changePage(newPage) {
    const totalPages = Math.ceil(totalPresidentes / itemsPerPage);
    
    if (newPage < 1 || newPage > totalPages) return;
    
    currentPage = newPage;
    renderPresidentesPage();
    updatePaginationControls();
    
    // Scroll suave hacia arriba
    document.querySelector('.residents-section').scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    });
}

// Función para cambiar elementos por página
function changeItemsPerPage(newItemsPerPage) {
    itemsPerPage = parseInt(newItemsPerPage);
    currentPage = 1; // Resetear a primera página
    renderPresidentesPage();
    updatePaginationControls();
}

// Función para crear controles de paginación
function createPaginationControls() {
    const residentsSection = document.querySelector('.residents-section');
    if (!residentsSection) return;
    
    // Verificar si ya existe la sección de paginación
    let paginationSection = document.querySelector('.pagination-section');
    if (paginationSection) return;
    
    // Crear sección de paginación
    paginationSection = document.createElement('div');
    paginationSection.className = 'pagination-section';
    paginationSection.innerHTML = `
        <div class="pagination-info">
            Mostrando 0 - 0 de 0 presidentes
        </div>
        <div class="pagination-controls">
            <div class="page-size-selector">
                <label for="itemsPerPageSelect">Mostrar:</label>
                <select id="itemsPerPageSelect" onchange="changeItemsPerPage(this.value)">
                    <option value="5">5</option>
                    <option value="10" selected>10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
                <span>por página</span>
            </div>
            <ul class="pagination-nav">
                <!-- Páginas se generan dinámicamente -->
            </ul>
        </div>
    `;
    
    residentsSection.appendChild(paginationSection);
}

// Función para recargar la tabla después de operaciones CRUD
function reloadPresidentes() {
    loadPresidentes();
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Crear controles de paginación
    createPaginationControls();
    
    // Cargar presidentes al inicializar la página
    loadPresidentes();
    
    // Configurar búsqueda
    const searchInput = document.getElementById('searchInput');
    const searchBtn = document.getElementById('searchBtn');
    
    if (searchInput) {
        // Búsqueda en tiempo real mientras escribes
        searchInput.addEventListener('input', filterPresidentes);
        
        // Búsqueda al presionar Enter
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                filterPresidentes();
            }
        });
    }
    
    if (searchBtn) {
        // Búsqueda al hacer clic en el botón
        searchBtn.addEventListener('click', filterPresidentes);
    }
    
    // Los botones de eliminar son manejados por eliminarpresidente.js
    // No duplicamos la funcionalidad aquí
});

// Exponer funciones globalmente para uso en otros scripts
window.loadPresidentes = loadPresidentes;
window.reloadPresidentes = reloadPresidentes;
window.filterPresidentes = filterPresidentes;
window.changePage = changePage;
window.changeItemsPerPage = changeItemsPerPage;