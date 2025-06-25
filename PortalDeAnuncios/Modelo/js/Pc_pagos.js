document.addEventListener('DOMContentLoaded', function() {

    const container = document.getElementById('pagosContainer');
    const searchInput = document.getElementById('searchInput');
    const filterEstado = document.getElementById('filterEstado');
    

    let pagosOriginales = [];
    let pagosFiltrados = [];
    
    // Variables de paginación
    let paginaActual = 1;
    const pagosPorPagina = 5; // Puedes ajustar este número

    // Función para crear los controles de paginación
    function crearControlesPaginacion(totalPaginas) {
        const paginacionContainer = document.getElementById('paginacionContainer') || 
            (() => {
                const div = document.createElement('div');
                div.id = 'paginacionContainer';
                div.className = 'pagination-container mt-4 d-flex justify-content-center';
                container.parentNode.insertBefore(div, container.nextSibling);
                return div;
            })();
if (totalPaginas <= 1) {
    // Agregar información de registros incluso cuando no hay paginación
    const infoHTML = `
        <div class="pagination-info mt-2 text-center text-muted">
            <small>Mostrando ${pagosFiltrados.length} de ${pagosFiltrados.length} pagos</small>
        </div>
    `;
    paginacionContainer.innerHTML = infoHTML;
    return;
}

        let paginacionHTML = `
            <nav aria-label="Navegación de pagos">
                <ul class="pagination">
                    <li class="page-item ${paginaActual === 1 ? 'disabled' : ''}">
                        <button class="page-link" onclick="cambiarPagina(${paginaActual - 1})" ${paginaActual === 1 ? 'disabled' : ''}>
                            <i class="fas fa-chevron-left"></i> Anterior
                        </button>
                    </li>
        `;

        // Lógica para mostrar números de página
        const rango = 2; // Páginas a mostrar a cada lado de la actual
        let inicio = Math.max(1, paginaActual - rango);
        let fin = Math.min(totalPaginas, paginaActual + rango);

        // Ajustar si estamos cerca del inicio o final
        if (paginaActual <= rango) {
            fin = Math.min(totalPaginas, 2 * rango + 1);
        }
        if (paginaActual > totalPaginas - rango) {
            inicio = Math.max(1, totalPaginas - 2 * rango);
        }

        // Primera página si no está en rango
        if (inicio > 1) {
            paginacionHTML += `
                <li class="page-item">
                    <button class="page-link" onclick="cambiarPagina(1)">1</button>
                </li>
            `;
            if (inicio > 2) {
                paginacionHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
            }
        }

        // Páginas en rango
        for (let i = inicio; i <= fin; i++) {
            paginacionHTML += `
                <li class="page-item ${i === paginaActual ? 'active' : ''}">
                    <button class="page-link" onclick="cambiarPagina(${i})">${i}</button>
                </li>
            `;
        }

        // Última página si no está en rango
        if (fin < totalPaginas) {
            if (fin < totalPaginas - 1) {
                paginacionHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
            }
            paginacionHTML += `
                <li class="page-item">
                    <button class="page-link" onclick="cambiarPagina(${totalPaginas})">${totalPaginas}</button>
                </li>
            `;
        }

        paginacionHTML += `
                    <li class="page-item ${paginaActual === totalPaginas ? 'disabled' : ''}">
                        <button class="page-link" onclick="cambiarPagina(${paginaActual + 1})" ${paginaActual === totalPaginas ? 'disabled' : ''}>
                            Siguiente <i class="fas fa-chevron-right"></i>
                        </button>
                    </li>
                </ul>
            </nav>
        `;

        // Información de registros
        const inicio_registro = (paginaActual - 1) * pagosPorPagina + 1;
        const fin_registro = Math.min(paginaActual * pagosPorPagina, pagosFiltrados.length);
        
        paginacionHTML += `
            <div class="pagination-info mt-2 text-center text-muted">
                <small>Mostrando ${inicio_registro}-${fin_registro} de ${pagosFiltrados.length} pagos</small>
            </div>
        `;

        paginacionContainer.innerHTML = paginacionHTML;
    }

    // Función para cambiar de página (debe ser global)
    window.cambiarPagina = function(nuevaPagina) {
        const totalPaginas = Math.ceil(pagosFiltrados.length / pagosPorPagina);
        if (nuevaPagina >= 1 && nuevaPagina <= totalPaginas) {
            paginaActual = nuevaPagina;
            renderPagosPaginados();
        }
    }

    // Función para obtener los pagos de la página actual
    function obtenerPagosPagina() {
        const inicio = (paginaActual - 1) * pagosPorPagina;
        const fin = inicio + pagosPorPagina;
        return pagosFiltrados.slice(inicio, fin);
    }

    // Función para renderizar pagos con paginación
    function renderPagosPaginados() {
        const pagosPagina = obtenerPagosPagina();
        const totalPaginas = Math.ceil(pagosFiltrados.length / pagosPorPagina);
        
        renderPagos(pagosPagina);
        crearControlesPaginacion(totalPaginas);
        
        // Scroll suave al inicio del contenedor
        container.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    // Función para renderizar los pagos (mantienes tu función original)
    function renderPagos(pagos) {
        container.innerHTML = '';
        if (pagos.length === 0) {
            container.innerHTML = `<p class="text-danger">No se encontraron pagos.</p>`;
            return;
        }

        pagos.forEach(pago => {
            const comentarioHTML = pago.comentario 
                ? `<div class="mt-2"><strong>Comentario:</strong> <span class="text-danger">${pago.comentario}</span></div>`
                : '';
            
            // Botones compactos y responsive
            const accionesHTML = pago.estado === 'en proceso'
                ? `
                <div class="payment-actions">
                    <button class="btn btn-success btn-approve" title="Aprobar">
                        <i class="fas fa-check"></i>
                        <span class="btn-text">Aprobar</span>
                    </button>
                    <button class="btn btn-danger btn-reject" title="Rechazar">
                        <i class="fas fa-times"></i>
                        <span class="btn-text">Rechazar</span>
                    </button>
                </div>`
                : `<span class="badge bg-success">Aprobado</span>`;
            
            const pagoHTML = `
                <div class="payment-item mb-3" data-pago-id="${pago.id}" data-deuda-id="${pago.deudaid}">
                    
                    <!-- Header principal -->
                    <div class="payment-header d-flex justify-content-between align-items-start mb-3">
                        <div class="payment-info">
                            <h6 class="payment-apt mb-1">Apartamento ${pago.apartamento}</h6>
                            <div class="payment-resident">${pago.nombre}</div>
                            <div class="payment-cedula">C.I: ${pago.cedula}</div>
                        </div>
                        <div class="payment-amount-status text-end">
                            <div class="payment-amount mb-2">Bs${pago.monto}</div>
                            <div class="payment-status">
                                ${accionesHTML}
                            </div>
                        </div>
                    </div>
                    
                    <!-- Información detallada -->
                    <div class="payment-details">
                        <div class="payment-details-grid">
                            <div class="detail-item">
                                <span class="detail-label">Descripción:</span>
                                <span class="detail-value">${pago.descripcion}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Método:</span>
                                <span class="detail-value">${pago.metodo_pago}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Banco:</span>
                                <span class="detail-value">${pago.banco}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Referencia:</span>
                                <span class="detail-value">${pago.referencia}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Fecha:</span>
                                <span class="detail-value">${pago.fecha_pago}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Teléfono:</span>
                                <span class="detail-value">${pago.telefono}</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Botón de comprobante -->
                    <div class="payment-proof mt-3">
                        <button class="btn btn-outline-info btn-view-comprobante w-100" data-archivo="${pago.archivo}">
                            <i class="fas fa-file-image me-2"></i>Ver Comprobante
                        </button>
                    </div>
                    
                    ${comentarioHTML}
                </div>
            `;
            
            container.insertAdjacentHTML('beforeend', pagoHTML);
        });

        // Re-agregar listeners a botones generados dinámicamente

        // Ver comprobante
        function esPDF(nombreArchivo) {
            return nombreArchivo.toLowerCase().endsWith('.pdf');
        }
        function esImagen(nombreArchivo) {
            const ext = nombreArchivo.toLowerCase();
            return ext.endsWith('.jpg') || ext.endsWith('.jpeg') || ext.endsWith('.png') || ext.endsWith('.gif') || ext.endsWith('.bmp') || ext.endsWith('.webp');
        }
        container.querySelectorAll('.btn-view-comprobante').forEach(btn => {
            btn.addEventListener('click', function() {
                const archivo = this.getAttribute('data-archivo');
                const rutaArchivo = `../../Vista/pagos/${archivo}`;
                const contentDiv = document.getElementById('comprobanteContent');
                contentDiv.innerHTML = '';

                if (esPDF(archivo)) {
                    contentDiv.innerHTML = `<embed src="${rutaArchivo}" type="application/pdf" width="100%" height="600px" />`;
                } else if (esImagen(archivo)) {
                    contentDiv.innerHTML = `<img src="${rutaArchivo}" alt="Comprobante" class="img-fluid" />`;
                } else {
                    contentDiv.innerHTML = `<p class="text-danger">Formato no soportado para este comprobante.</p>`;
                }

                const comprobanteModal = new bootstrap.Modal(document.getElementById('comprobanteModal'));
                comprobanteModal.show();
            });
        });

        // Botones aprobar
        container.querySelectorAll('.btn-approve').forEach(btn => {
            btn.addEventListener('click', function () {
                const item = this.closest('.payment-item');
                const pagoId = item.getAttribute('data-pago-id');
                const deudaId = item.getAttribute('data-deuda-id');

                Swal.fire({
                    title: '¿Aprobar pago?',
                    text: "Esta acción no se puede deshacer.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, aprobar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch('../../Controlador/funciones/aprobarpago.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ pago_id: pagoId, deuda_id: deudaId })
                        })
                        .then(res => res.json())
                        .then(response => {
                            if (response.success) {
                                item.style.backgroundColor = '#d1e7dd';
                                btn.innerHTML = '<i class="fas fa-check"></i> Aprobado';
                                btn.classList.remove('btn-approve');
                                btn.classList.add('btn-success');
                                btn.disabled = true;
                                if (btn.nextElementSibling) {
                                    btn.nextElementSibling.style.display = 'none';
                                }
                                Swal.fire("¡Aprobado!", "El pago ha sido aprobado correctamente.", "success");
                            } else {
                                Swal.fire("Error", "No se pudo aprobar el pago.", "error");
                            }
                        })
                        .catch(err => {
                            Swal.fire("Error", "Error en la solicitud.", "error");
                        });
                    }
                });
            });
        });

        // Botones rechazar
        container.querySelectorAll('.btn-reject').forEach(btn => {
            btn.addEventListener('click', function () {
                const item = this.closest('.payment-item');
                const pagoId = item.getAttribute('data-pago-id');
                const deudaId = item.getAttribute('data-deuda-id');

                Swal.fire({
                    title: '¿Rechazar pago?',
                    text: "Esta acción no se puede deshacer.",
                    icon: 'warning',
                    input: 'text',
                    inputPlaceholder: 'Motivo del rechazo',
                    inputValidator: (value) => {
                        if (!value) {
                            return 'Debes ingresar un motivo';
                        }
                    },
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Sí, rechazar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const motivo = result.value;

                        fetch('../../Controlador/funciones/rechazarpago.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({
                                pago_id: pagoId,
                                deuda_id: deudaId,
                                motivo: motivo
                            })
                        })
                        .then(res => res.json())
                        .then(response => {
                            if (response.success) {
                                item.style.backgroundColor = '#f8d7da';
                                btn.innerHTML = '<i class="fas fa-times"></i> Rechazado';
                                btn.classList.remove('btn-reject');
                                btn.classList.add('btn-danger');
                                btn.disabled = true;
                                if (btn.previousElementSibling) {
                                    btn.previousElementSibling.style.display = 'none';
                                }
                                Swal.fire("¡Rechazado!", "El pago ha sido rechazado correctamente.", "success");
                            } else {
                                Swal.fire("Error", "No se pudo rechazar el pago.", "error");
                            }
                        })
                        .catch(err => {
                            Swal.fire("Error", "Error en la solicitud.", "error");
                        });
                    }
                });
            });
        });
    }

    // Función para filtrar los pagos según inputs (modificada para paginación)
    function filtrarPagos() {
        const texto = searchInput.value.toLowerCase();
        const estadoFiltro = filterEstado.value.toLowerCase();

        pagosFiltrados = pagosOriginales.filter(pago => {
            // Buscar en apartamento, nombre, referencia
            const textoMatch = pago.apartamento.toLowerCase().includes(texto)
                || pago.nombre.toLowerCase().includes(texto)
                || pago.referencia.toLowerCase().includes(texto);

            // Filtrar estado si está seleccionado
            const estadoMatch = estadoFiltro ? pago.estado.toLowerCase() === estadoFiltro : true;

            return textoMatch && estadoMatch;
        });

        // Resetear a la primera página cuando se filtra
        paginaActual = 1;
        renderPagosPaginados();
    }

    // Fetch inicial de pagos
    fetch('../../Controlador/funciones/mostrarpagosenviados.php')
    .then(res => res.json())
    .then(data => {
        if(data.success){
            pagosOriginales = data.pagos;
            pagosFiltrados = [...pagosOriginales]; // Copia inicial
            renderPagosPaginados();
        } else {
            container.innerHTML = `<p class="text-danger">Error al cargar los pagos: ${data.message}</p>`;
        }
    })
    .catch(err => {
        container.innerHTML = `<p class="text-danger">Error al cargar los pagos.</p>`;
    });

    // Eventos para filtros
    searchInput.addEventListener('input', filtrarPagos);
    filterEstado.addEventListener('change', filtrarPagos);

   document.getElementById("agregarBtn").addEventListener("click", function () {
    const apartamento = document.getElementById("apartamento").value.trim();
    const tipoDeuda = document.getElementById("tipoDeuda").value.trim();
    const monto = document.getElementById("monto").value.trim();
    const fecha = document.getElementById("fecha").value.trim();
    const descripcion = document.getElementById("descripcion").value.trim();

    const errores = [];

    // Validar usuario/apartamento
    if (!apartamento) {
        errores.push("El campo 'Apartamento' es obligatorio.");
    } else if (apartamento.length > 20) {
        errores.push("El campo 'Apartamento' no debe superar los 20 caracteres.");
    }

    // Validar tipo de deuda
    const tiposPermitidos = ['condominio', 'otros'];
    if (!tipoDeuda || !tiposPermitidos.includes(tipoDeuda)) {
        errores.push("El tipo de deuda no es válido.");
    }

    // Validar monto
    const montoNumerico = parseFloat(monto);
    if (isNaN(montoNumerico) || montoNumerico <= 0) {
        errores.push("El monto debe ser un número positivo.");
    } else if (montoNumerico > 99999999.99) {
        errores.push("El monto excede el límite permitido (99,999,999.99).");
    }

    // Validar fecha
    if (!fecha) {
        errores.push("La fecha de vencimiento es obligatoria.");
    } else if (!/^\d{4}-\d{2}-\d{2}$/.test(fecha)) {
        errores.push("La fecha de vencimiento debe tener el formato YYYY-MM-DD.");
    }

    // Validar descripción según tipoDeuda
    if (tipoDeuda === 'otros') {
        if (!descripcion) {
            errores.push("La descripción es obligatoria cuando el tipo de deuda es 'otros'.");
        } else if (descripcion.length > 1000) {
            errores.push("La descripción no debe superar los 1000 caracteres.");
        }
    } else {
        if (descripcion.length > 1000) {
            errores.push("La descripción no debe superar los 1000 caracteres.");
        }
    }

    if (errores.length > 0) {
        Swal.fire({
            icon: "warning",
            title: "Errores en el formulario",
            html: "<ul style='text-align:left'>" + errores.map(e => `<li>${e}</li>`).join('') + "</ul>",
            confirmButtonText: "Entendido"
        });
        return;
    }

    // Confirmación
    Swal.fire({
        title: "¿Agregar deuda?",
        text: `Monto: $${montoNumerico.toFixed(2)} para ${apartamento}`,
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Sí, agregar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            const formData = new FormData(document.getElementById("deudaForm"));

            fetch("../../Controlador/funciones/agregardeuda.php", {
                method: "POST",
                body: formData
            })
            .then(res => res.text())
            .then(data => {
                Swal.fire("Éxito", "Deuda agregada correctamente", "success");
                document.getElementById("deudaForm").reset();
                const modal = bootstrap.Modal.getInstance(document.getElementById("addDebtModal"));
                modal.hide();
            })
            .catch(err => {
                console.error(err);
                Swal.fire("Error", "No se pudo agregar la deuda", "error");
            });
        }
    });
});

})
