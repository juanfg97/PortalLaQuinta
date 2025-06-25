// Tipos permitidos para archivos adjuntos
const tiposPermitidos = [
    'pdf',
    // Word
    'doc', 'docx', 'dot', 'dotx',
    // Excel
    'xls', 'xlsx', 'xlsm', 'xlsb',
    // PowerPoint
    'ppt', 'pptx', 'pps', 'ppsx',
    // Imágenes
    'jpg', 'jpeg', 'png'
];

document.getElementById('formInforme').addEventListener('submit', function (e) {
    e.preventDefault();

    const tipoInforme = document.getElementById('tipoInforme');
    const asuntoInforme = document.getElementById('asuntoInforme');
    const descripcionInforme = document.getElementById('descripcionInforme');
    const prioridadInforme = document.getElementById('prioridadInforme');
    const checkboxAdjuntos = document.getElementById('adjuntarDocumentos');
    const fileInput = document.getElementById('fileAdjuntos');

    const asunto = asuntoInforme.value.trim();
    const descripcion = descripcionInforme.value.trim();

    const errores = [];

    // Validaciones básicas
    if (!tipoInforme.value) errores.push("El tipo de informe es obligatorio.");
    if (!asunto) errores.push("El asunto es obligatorio.");
    if (asunto.length > 100) errores.push("El asunto no debe superar los 100 caracteres.");
    if (!descripcion) errores.push("La descripción es obligatoria.");
    if (descripcion.length < 10) errores.push("La descripción debe tener al menos 10 caracteres.");
    if (descripcion.length > 3000) errores.push("La descripción no debe superar los 3000 caracteres.");
    if (!prioridadInforme.value) errores.push("La prioridad es obligatoria.");

    // Validación de archivos si el checkbox está marcado
    if (checkboxAdjuntos.checked) {
        const archivos = fileInput.files;
        const extensionesPermitidas = ['pdf', 'jpg', 'jpeg', 'png', 'doc', 'docx'];

        if (archivos.length > 3) {
            errores.push("Solo se permiten hasta 3 archivos adjuntos.");
        }

        for (let archivo of archivos) {
            const extension = archivo.name.split('.').pop().toLowerCase();
            if (!extensionesPermitidas.includes(extension)) {
                errores.push(`Archivo no permitido: ${archivo.name}`);
            }
            if (archivo.size > 5 * 1024 * 1024) {
                errores.push(`El archivo ${archivo.name} excede el tamaño máximo de 5MB.`);
            }
        }
    }

    if (errores.length > 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Errores en el formulario',
            html: '<ul style="text-align: left;">' + errores.map(e => `<li>${e}</li>`).join('') + '</ul>'
        });
        return;
    }

    // Mostrar datos en el modal de confirmación
    document.getElementById('confirmTipo').textContent = tipoInforme.selectedOptions[0].text;
    document.getElementById('confirmAsuntoInforme').textContent = asunto;
    document.getElementById('confirmDescripcion').textContent =
        descripcion.length > 100 ? descripcion.substring(0, 100) + '...' : descripcion;

    const urgenciaTexto = {
        'baja': '🟢 Baja - Informativo',
        'media': '🟡 Media - Requiere Atención',
        'alta': '🔴 Alta - Urgente'
    };
    document.getElementById('confirmUrgencia').textContent = urgenciaTexto[prioridadInforme.value];

    // Mostrar modal de confirmación
    new bootstrap.Modal(document.getElementById('modalConfirmarInforme')).show();
});

document.getElementById('btnConfirmarInforme').addEventListener('click', function () {
    const form = document.getElementById('formInforme');
    const formData = new FormData(form); // Incluye archivos y demás campos
     // 👉 Mostrar el contenido del FormData
    console.log('Contenido de FormData:');
    for (const [key, value] of formData.entries()) {
        console.log(`${key}:`, value);
    }


    fetch('../../Controlador/funciones/enviarinforme.php', {
        method: 'POST',
        body: formData
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.json();
        })
      .then(data => {
    if (data.estado === 'ok') {
        Swal.fire({
            icon: 'success',
            title: 'Informe enviado',
            text: 'El informe fue enviado exitosamente al Presidente Central.'
        });

        form.reset();

        const fileInput = document.getElementById('fileAdjuntos');
        if (fileInput) {
            fileInput.style.display = 'none';
            fileInput.value = '';
        }

        
        document.getElementById('adjuntarDocumentos').checked = false;

      

        bootstrap.Modal.getInstance(document.getElementById('modalConfirmarInforme')).hide();
    } else {
        throw new Error(data.mensaje || 'Error desconocido');
    }
})

        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error al enviar',
                text: error.message || 'No se pudo enviar el informe.'
            });
        });
});


// Manejo botón ver completo
document.addEventListener('DOMContentLoaded', function () {
    // Asigna eventos a los botones existentes al cargar la página (aunque después los reemplazas)
    document.querySelectorAll('.btnVerComunicado').forEach(btn => {
        btn.addEventListener('click', function () {
            const comunicadoId = this.getAttribute('data-id');
            const contenedor = document.getElementById('contenidoComunicadoCompleto');
            contenedor.innerHTML = '<p class="text-muted">Cargando comunicado...</p>';

            fetch('../../Controlador/funciones/obtenercomunicado.php?id=' + encodeURIComponent(comunicadoId))
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Respuesta no válida del servidor');
                    }
                    return response.text();
                })
                .then(html => {
                    if (html.includes('ERROR_COMUNICADO')) {
                        throw new Error(html.replace('ERROR_COMUNICADO:', '').trim());
                    }
                    contenedor.innerHTML = html;
                })
                .catch(error => {
                    contenedor.innerHTML = '';
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al cargar',
                        text: error.message || 'No se pudo cargar el comunicado.'
                    });
                });
        });
    });

    // 👇 Esta línea carga los comunicados automáticamente al entrar
    cargarPagina();
});

function tiempo_transcurrido(fecha) {
    const ahora = new Date();
    const fechaCom = new Date(fecha);
    const diffMs = ahora - fechaCom;
    const diffMins = Math.floor(diffMs / 60000);
    if (diffMins < 1) return "Justo ahora";
    if (diffMins < 60) return diffMins + " minuto" + (diffMins > 1 ? "s" : "") + " atrás";
    const diffHrs = Math.floor(diffMins / 60);
    if (diffHrs < 24) return diffHrs + " hora" + (diffHrs > 1 ? "s" : "") + " atrás";
    const diffDays = Math.floor(diffHrs / 24);
    if (diffDays === 1) return "Ayer";
    if (diffDays < 30) return diffDays + " días atrás";
    const diffMonths = Math.floor(diffDays / 30);
    if (diffMonths < 12) return diffMonths + " mes" + (diffMonths > 1 ? "es" : "") + " atrás";
    const diffYears = Math.floor(diffMonths / 12);
    return diffYears + " año" + (diffYears > 1 ? "s" : "") + " atrás";
}

function cargarPagina(pagina = 1) {
    fetch('../../Controlador/funciones/mostrarcomunicados.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded', // Para enviar como formulario
        },
        body: 'pagina=' + encodeURIComponent(pagina)
    })
    .then(res => res.json())
    .then(data => {
        if (data.error) {
            console.error(data.error);
            return;
        }

        const contenedor = document.getElementById('contenedor-comunicados');
        const paginacion = document.getElementById('paginacion-comunicados');

        contenedor.innerHTML = data.comunicados.map(c => {
            const prioridad = c.Prioridad.toLowerCase();
            const fechaTexto = new Date(c.Fecha).toLocaleString('es-ES', {day: '2-digit', month: 'short', year: 'numeric', hour: '2-digit', minute:'2-digit'});
            const tiempo = tiempo_transcurrido(c.Fecha);

            let badgePrioridad = "📄 Normal";
            if (prioridad === 'urgente') badgePrioridad = "🚨 Urgente";
            else if (prioridad === 'importante') badgePrioridad = "⚠️ Importante";

            return `
                <div class="comunicado-item comunicado-${prioridad}">
                    <div class="comunicado-header">
                        <div class="comunicado-meta">
                            <span class="badge-presidente-central">👑 Presidente Central</span>
                            <span class="badge-prioridad badge-${prioridad}">${badgePrioridad}</span>
                            <span class="badge-fecha">${fechaTexto}</span>
                        </div>
                    </div>
                    <h6 class="fw-bold text-info">${c.Asunto}</h6>
                    <p class="mb-2">${c.Mensaje}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">${tiempo}</small>
                        <button class="btn btn-outline-info btn-sm btnVerComunicado" data-id="${c.Id}" data-bs-toggle="modal" data-bs-target="#modalComunicadoCompleto">Ver Completo</button>
                    </div>
                </div>`;
        }).join('');

        let nav = '<nav><ul class="pagination justify-content-center mt-4">';
        for (let i = 1; i <= data.total_paginas; i++) {
            const active = i === data.pagina_actual ? 'active' : '';
            nav += `<li class="page-item ${active}"><a href="#" class="page-link" onclick="cargarPagina(${i});return false;">${i}</a></li>`;
        }
        nav += '</ul></nav>';
        paginacion.innerHTML = nav;
        
    asignarEventosVerComunicado(); 

    })
    .catch(err => {
        console.error('Error al cargar comunicados:', err);
    });
}
function asignarEventosVerComunicado() {
    document.querySelectorAll('.btnVerComunicado').forEach(btn => {
        btn.addEventListener('click', function () {
            const comunicadoId = this.getAttribute('data-id');
            const contenedor = document.getElementById('contenidoComunicadoCompleto');
            contenedor.innerHTML = '<p class="text-muted">Cargando comunicado...</p>';

            fetch('../../Controlador/funciones/obtenercomunicado.php?id=' + encodeURIComponent(comunicadoId))
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Respuesta no válida del servidor');
                    }
                    return response.text();
                })
                .then(html => {
                    if (html.includes('ERROR_COMUNICADO')) {
                        throw new Error(html.replace('ERROR_COMUNICADO:', '').trim());
                    }
                    contenedor.innerHTML = html;
                })
                .catch(error => {
                    contenedor.innerHTML = '';
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al cargar',
                        text: error.message || 'No se pudo cargar el comunicado.'
                    });
                });
        });
    });
}
document.addEventListener('DOMContentLoaded', function () {
    const checkboxAdjuntos = document.getElementById('adjuntarDocumentos');
    const fileInput = document.getElementById('fileAdjuntos');

    checkboxAdjuntos.addEventListener('change', function () {
        if (this.checked) {
            fileInput.style.display = 'block';
        } else {
            fileInput.style.display = 'none';
            fileInput.value = ''; // Limpia los archivos seleccionados si se desmarca
        }
    });
});
