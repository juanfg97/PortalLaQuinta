// Variables globales para paginación
let currentPage = 1;
let itemsPerPage = 10;
let totalItems = 0;
let totalPages = 0;
let allInformes = [];
let filteredInformes = [];

// Inicialización cuando el documento esté listo
document.addEventListener('DOMContentLoaded', function() {
    initializePagination();
    bindEventListeners();
    loadInformes();
});

// Función para inicializar la paginación
function initializePagination() {
    const itemsSelect = document.getElementById('itemsPorPagina');
    if (itemsSelect) {
        itemsSelect.addEventListener('change', function() {
            itemsPerPage = parseInt(this.value);
            currentPage = 1;
            displayInformes();
            updatePagination();
        });
    }
}

// Función para vincular event listeners
function bindEventListeners() {
    // Filtros
    const filtros = ['filtroTerraza', 'filtroEdificio', 'filtroPrioridad', 'filtroTipo'];
    filtros.forEach(filtroId => {
        const elemento = document.getElementById(filtroId);
        if (elemento) {
            elemento.addEventListener('change', applyFilters);
            elemento.addEventListener('input', applyFilters);
        }
    });
}

// Función para cargar informes
function loadInformes() {
    showLoadingSpinner(true);
    
    // Hacer llamada AJAX para obtener los informes
    fetch('../../Controlador/funciones/mostrarinformes.php')
        .then(response => response.json())
        .then(data => {
            allInformes = data.informes || [];
            filteredInformes = [...allInformes];
            totalItems = filteredInformes.length;
            
            applyFilters();
            showLoadingSpinner(false);
             console.log(data);
        })
        .catch(error => {
            console.error('Error al cargar informes:', error);
            showLoadingSpinner(false);
            showNoResults(true);
        });
}

// Función para aplicar filtros
function applyFilters() {
    const filtroTerraza = document.getElementById('filtroTerraza').value;
    const filtroEdificio = document.getElementById('filtroEdificio').value.toLowerCase();
    const filtroPrioridad = document.getElementById('filtroPrioridad').value;
    const filtroTipo = document.getElementById('filtroTipo').value;
    
    filteredInformes = allInformes.filter(informe => {
        let matches = true;
        
if (filtroTerraza) {
    const numeroTerraza = informe.remitente.match(/^\d+/);
    if (!numeroTerraza || numeroTerraza[0] !== filtroTerraza) {
        matches = false;
    }
}

        
        // Filtro por edificio
        if (filtroEdificio && !informe.remitente.toLowerCase().includes(filtroEdificio)) {
            matches = false;
        }
        
        // Filtro por prioridad
        if (filtroPrioridad && informe.prioridad.toLowerCase() !== filtroPrioridad) {
            matches = false;
        }
        
        // Filtro por tipo
        if (filtroTipo && informe.tipo.toLowerCase() !== filtroTipo) {
            matches = false;
        }
        
        return matches;
    });
    
    totalItems = filteredInformes.length;
    currentPage = 1;
    displayInformes();
    updatePagination();
}

// Función para mostrar los informes de la página actual
function displayInformes() {
    const listaInformes = document.getElementById('listaInformes');
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const informesPage = filteredInformes.slice(startIndex, endIndex);
    
    if (informesPage.length === 0) {
        showNoResults(true);
        listaInformes.innerHTML = '';
        return;
    }
    
    showNoResults(false);
    listaInformes.innerHTML = generateInformesHTML(informesPage);
    
    // Reactivar event listeners para los botones "Ver Completo"
    bindInformeButtons();
}

// Función para generar HTML de los informes
function generateInformesHTML(informes) {
    return informes.map(informe => {
        const esNuevo = informe.es_nuevo || false;
        const cardClasses = `informe-item p-3 mb-4 border rounded ${esNuevo ? 'border-primary bg-light' : ''}`;
        const prioridadIcono = getPrioridadIcono(informe.prioridad);
        const tipoIcono = getTipoIcono(informe.tipo);
        
        return `
            <div class="${cardClasses}"
                 data-terraza="${parseInt(informe.remitente)}"
                 data-edificio="${informe.remitente}"
                 data-prioridad="${informe.prioridad.toLowerCase()}"
                 data-tipo="${informe.tipo.toLowerCase()}">

                <div class="informe-header mb-2 d-flex justify-content-between align-items-center">
                    <span class="badge-edificio">Edificio ${informe.remitente}</span>
                    <span class="badge-fecha badge bg-secondary">${formatDate(informe.fecha)}</span>
                    ${esNuevo ? '<span class="badge bg-primary ms-2">🆕 Nuevo</span>' : ''}
                </div>

                <p class="mb-2"><strong>Asunto:</strong> ${informe.asunto}</p>
                <p class="mb-2"><strong>Tipo:</strong> ${tipoIcono} ${informe.tipo}</p>
                <p class="mb-2"><strong>Prioridad:</strong> ${prioridadIcono}</p>

                ${generateAdjuntosHTML(informe.adjuntos)}

                <div class="d-flex justify-content-between align-items-center mt-2">
                    <small class="text-muted">
                        ${formatTime(informe.fecha)} | Edificio ${informe.remitente}
                    </small>
                    <button 
                        class="btn btn-outline-primary btn-sm ver-completo"
                        data-id="${informe.id}"
                        data-asunto="${informe.asunto}"
                        data-tipo="${informe.tipo}"
                        data-prioridad="${informe.prioridad}"
                        data-remitente="${informe.remitente}"
                        data-fecha="${informe.fecha}"
                        data-descripcion="${informe.descripcion}"
                        data-adjuntos='${JSON.stringify(informe.adjuntos)}'>
                        Ver Completo
                    </button>
                </div>
            </div>
        `;
    }).join('');
}

// Función para generar HTML de adjuntos
function generateAdjuntosHTML(adjuntos) {
    if (!adjuntos || adjuntos.length === 0) {
        return '<p class="text-muted">No hay archivos adjuntos.</p>';
    }
    
    const adjuntosHTML = adjuntos.map(adj => {
        const rutacompleta = `/PortalDeAnuncios/Vista/${adj.ruta}`;
        return `
            <li class="list-group-item py-2">
                <a href="${rutacompleta}"
                   download="${adj.nombre}"
                   target="_blank"
                   class="text-decoration-none d-flex align-items-center">
                    <span class="me-2">📎</span> ${adj.nombre}
                </a>
            </li>
        `;
    }).join('');
    
    return `
        <p><strong>Archivos adjuntos:</strong></p>
        <ul class="list-group">
            ${adjuntosHTML}
        </ul>
    `;
}

// Función para actualizar la paginación
function updatePagination() {
    totalPages = Math.ceil(totalItems / itemsPerPage);
    
    updatePaginationInfo();
    generatePaginationControls();
    
    const container = document.getElementById('paginationContainer');
    if (totalPages <= 1) {
        container.style.display = 'none';
    } else {
        container.style.display = 'block';
    }
}

// Función para actualizar la información de paginación
function updatePaginationInfo() {
    const info = document.getElementById('paginationInfo');
    if (!info) return;
    
    const startItem = totalItems > 0 ? ((currentPage - 1) * itemsPerPage) + 1 : 0;
    const endItem = Math.min(currentPage * itemsPerPage, totalItems);
    
    info.innerHTML = `
        <i class="bi bi-info-circle"></i>
        Mostrando ${startItem}-${endItem} de ${totalItems} informes
    `;
}

// Función para generar controles de paginación
function generatePaginationControls() {
    const controls = document.getElementById('paginationControls');
    if (!controls) return;
    
    let html = '';
    
    // Botón Primera página
    html += `
        <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
            <a class="page-link page-first" href="#" onclick="goToPage(1)" aria-label="Primera página">
                <i class="bi bi-chevron-double-left"></i>
            </a>
        </li>
    `;
    
    // Botón Anterior
    html += `
        <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
            <a class="page-link" href="#" onclick="goToPage(${currentPage - 1})" aria-label="Página anterior">
                <i class="bi bi-chevron-left"></i>
            </a>
        </li>
    `;
    
    // Páginas numeradas
    const startPage = Math.max(1, currentPage - 2);
    const endPage = Math.min(totalPages, currentPage + 2);
    
    if (startPage > 1) {
        html += `
            <li class="page-item">
                <a class="page-link" href="#" onclick="goToPage(1)">1</a>
            </li>
        `;
        if (startPage > 2) {
            html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
        }
    }
    
    for (let i = startPage; i <= endPage; i++) {
        html += `
            <li class="page-item ${i === currentPage ? 'active' : ''}">
                <a class="page-link" href="#" onclick="goToPage(${i})">${i}</a>
            </li>
        `;
    }
    
    if (endPage < totalPages) {
        if (endPage < totalPages - 1) {
            html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
        }
        html += `
            <li class="page-item">
                <a class="page-link" href="#" onclick="goToPage(${totalPages})">${totalPages}</a>
            </li>
        `;
    }
    
    // Botón Siguiente
    html += `
        <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
            <a class="page-link" href="#" onclick="goToPage(${currentPage + 1})" aria-label="Página siguiente">
                <i class="bi bi-chevron-right"></i>
            </a>
        </li>
    `;
    
    // Botón Última página
    html += `
        <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
            <a class="page-link page-last" href="#" onclick="goToPage(${totalPages})" aria-label="Última página">
                <i class="bi bi-chevron-double-right"></i>
            </a>
        </li>
    `;
    
    controls.innerHTML = html;
}

// Función para ir a una página específica
function goToPage(page) {
    if (page < 1 || page > totalPages || page === currentPage) return;
    
    currentPage = page;
    displayInformes();
    updatePagination();
    
    // Scroll suave hacia la lista de informes
    document.getElementById('listaInformes').scrollIntoView({ 
        behavior: 'smooth', 
        block: 'start' 
    });
}

// Función para mostrar/ocultar spinner de carga
function showLoadingSpinner(show) {
    const spinner = document.getElementById('loadingSpinner');
    if (spinner) {
        spinner.classList.toggle('show', show);
    }
}

// Función para mostrar/ocultar mensaje de no resultados
function showNoResults(show) {
    const noResults = document.getElementById('noResults');
    if (noResults) {
        noResults.classList.toggle('d-none', !show);
    }
}

// Función para reactivar event listeners de botones de informes
function bindInformeButtons() {
    const buttons = document.querySelectorAll('.ver-completo');
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const data = {
                id: this.dataset.id,
                asunto: this.dataset.asunto,
                tipo: this.dataset.tipo,
                prioridad: this.dataset.prioridad,
                remitente: this.dataset.remitente,
                fecha: this.dataset.fecha,
                descripcion: this.dataset.descripcion,
                adjuntos: JSON.parse(this.dataset.adjuntos || '[]')
            };
            
            showInformeCompleto(data);
        });
    });
}

// Función para mostrar el modal de informe completo
function showInformeCompleto(data) {
    const modal = new bootstrap.Modal(document.getElementById('modalInformeCompleto'));
    const contenido = document.getElementById('contenidoInformeCompleto');
    
    const tipoIcono = getTipoIcono(data.tipo);
    const prioridadIcono = getPrioridadIcono(data.prioridad);
    
    contenido.innerHTML = `
        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Edificio:</strong> ${data.remitente}
            </div>
            <div class="col-md-6">
                <strong>Fecha:</strong> ${formatDate(data.fecha)}
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Tipo:</strong> ${tipoIcono} ${data.tipo}
            </div>
            <div class="col-md-6">
                <strong>Prioridad:</strong> ${prioridadIcono}
            </div>
        </div>
        <div class="mb-3">
            <strong>Asunto:</strong> ${data.asunto}
        </div>
        <div class="mb-3">
            <strong>Descripción completa:</strong>
            <div class="mt-2 p-3 bg-light rounded">
                ${data.descripcion || 'No hay descripción adicional.'}
            </div>
        </div>
        ${generateAdjuntosHTML(data.adjuntos)}
    `;
    
    modal.show();
}

// Funciones auxiliares
function getPrioridadIcono(prioridad) {
    const iconos = {
        'baja': '🟢 Baja - Informativo',
        'media': '🟡 Media - Requiere Atención',
        'alta': '🔴 Alta - Urgente',
        'normal': '📄 Normal',
        'importante': '⚠️ Importante',
        'urgente': '🚨 Urgente'
    };
    return iconos[prioridad.toLowerCase()] || prioridad;
}

function getTipoIcono(tipo) {
    const iconos = {
        'mantenimiento': '🔧',
        'seguridad': '🛡️',
        'financiero': '💰',
        'limpieza': '🧹',
        'servicios': '⚡',
        'reparaciones': '🔨',
        'general': '📋'
    };
    return iconos[tipo.toLowerCase()] || '📋';
}

function formatDate(dateString) {
    const date = new Date(dateString);
    const months = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 
                   'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
    return `${date.getDate()} ${months[date.getMonth()]} ${date.getFullYear()}`;
}

function formatTime(dateString) {
    const date = new Date(dateString);
    return date.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit' });
}

  // Manejar envío de comunicado
        document.getElementById('formComunicado').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const destinatario = document.getElementById('destinatario').value;
            const asunto = document.getElementById('asunto').value;
            const mensaje = document.getElementById('mensaje').value;
            const prioridad = document.getElementById('prioridad').value;
            
            // Actualizar modal de confirmación
            document.getElementById('confirmDestinatario').textContent = 
                document.getElementById('destinatario').selectedOptions[0].text;
            document.getElementById('confirmAsunto').textContent = asunto;
            document.getElementById('confirmMensaje').textContent = 
                mensaje.length > 100 ? mensaje.substring(0, 100) + '...' : mensaje;
            
            const prioridadTexto = {
                'normal': '📄 Normal',
                'importante': '⚠️ Importante', 
                'urgente': '🚨 Urgente'
            };
            document.getElementById('confirmPrioridad').textContent = prioridadTexto[prioridad];
            
            // Mostrar modal
            new bootstrap.Modal(document.getElementById('modalConfirmarEnvio')).show();
        });
    document.getElementById('btnConfirmarEnvio').addEventListener('click', function () {
    const destinatario = document.getElementById('destinatario').value.trim();
    const asunto = document.getElementById('asunto').value.trim();
    const mensaje = document.getElementById('mensaje').value.trim();
    const prioridad = document.getElementById('prioridad').value;

    // Validar campos vacíos
    if (!destinatario || !asunto || !mensaje || !prioridad) {
        Swal.fire({
            icon: 'warning',
            title: 'Campos incompletos',
            text: 'Por favor, completa todos los campos antes de enviar el comunicado.'
        });
        return;
    }

    // Validar longitud de asunto
    if (asunto.length < 5 || asunto.length > 100) {
        Swal.fire({
            icon: 'warning',
            title: 'Asunto inválido',
            text: 'El asunto debe tener entre 5 y 100 caracteres.'
        });
        return;
    }

    // Validar longitud de mensaje
    if (mensaje.length < 10 || mensaje.length > 1000) {
        Swal.fire({
            icon: 'warning',
            title: 'Mensaje inválido',
            text: 'El mensaje debe tener entre 10 y 1000 caracteres.'
        });
        return;
    }

    const data = { destinatario, asunto, mensaje, prioridad };

    fetch('../../Controlador/funciones/P_enviarcomunicado.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(res => {
        if (!res.ok) throw new Error('Error al enviar comunicado');
        return res.json();
    })
    .then(response => {
        if (response.success) {
            Swal.fire({
                icon: 'success',
                title: 'Comunicado enviado',
                text: 'El comunicado ha sido enviado correctamente.'
            });

            document.getElementById('formComunicado').reset();
            bootstrap.Modal.getInstance(document.getElementById('modalConfirmarEnvio')).hide();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error al enviar',
                text: response.error || 'Hubo un problema inesperado.'
            });
        }
    })
    .catch(error => {
        console.error(error);
        Swal.fire({
            icon: 'error',
            title: 'Error del sistema',
            text: 'No se pudo enviar el comunicado. Intenta nuevamente.'
        });
    });
});


