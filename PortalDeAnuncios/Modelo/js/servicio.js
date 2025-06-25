document.getElementById('ServicioForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const requiredFields = ['nombre_servicio', 'descripcion', 'proveedor', 'contacto', 'servicioCategory'];
    let isValid = true;
    let errorMessages = [];

    // Limpiar clases previas
    requiredFields.forEach(id => document.getElementById(id).classList.remove('is-invalid'));

    requiredFields.forEach(field => {
        const input = document.getElementById(field);
        const value = input.value.trim();

        if (!value) {
            isValid = false;
            input.classList.add('is-invalid');
            errorMessages.push(`El campo "${obtenerNombreCampo(field)}" es obligatorio.`);
            return;
        }

        // Validaciones específicas
        switch (field) {
            case 'nombre_servicio':
                if (!/^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]{5,255}$/.test(value)) {
                    isValid = false;
                    input.classList.add('is-invalid');
                    errorMessages.push('El nombre del servicio debe contener solo letras y tener máximo 255 caracteres.');
                }
                break;
            case 'descripcion':
                if (value.length < 10) {
                    isValid = false;
                    input.classList.add('is-invalid');
                    errorMessages.push('La descripción debe tener al menos 20 caracteres.');
                }
                break;
            case 'proveedor':
                if (value.length > 150 || value.length < 5) {
                    isValid = false;
                    input.classList.add('is-invalid');
                    errorMessages.push('El nombre del proveedor debe tener entre 5 y 150 caracteres.');
                }
                break;
            case 'contacto':
                if (value.length > 255 || value.length < 5) {
                    isValid = false;
                    input.classList.add('is-invalid');
                    errorMessages.push('El contacto debe tener entre 5 y 255 caracteres.');
                }
                break;
        }
    });

    if (!isValid) {
        Swal.fire({
            icon: 'error',
            title: 'Errores en el formulario',
            html: errorMessages.map(msg => `<p>• ${msg}</p>`).join(''),
            confirmButtonText: 'Entendido'
        });
        return;
    }

    const modo = document.getElementById('formMode').value || 'crear';
    const servicioId = document.getElementById('announcementId').value || '';
    const formData = new FormData();

    requiredFields.forEach(field => {
        formData.append(field, document.getElementById(field).value.trim());
    });

    formData.append('modo', modo);
    formData.append('id_servicio', servicioId);

    const imageInput = document.getElementById('servicioImage');
    if (imageInput && imageInput.files.length > 0) {
        formData.append('servicioImage', imageInput.files[0]);
    }

    const url = modo === 'editar'
        ? '../../Controlador/formularios/modificarservicio.php'
        : '../../Controlador/formularios/agregarservicio.php';

    fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: modo === 'editar' ? '¡Servicio actualizado!' : '¡Servicio agregado!',
                text: data.message,
                confirmButtonText: 'Excelente'
            }).then(() => {
                const modal = bootstrap.Modal.getInstance(document.getElementById('addAnnouncementModal'));
                modal.hide();
                document.getElementById('ServicioForm').reset();
                document.getElementById('formMode').value = 'crear';
                document.getElementById('announcementId').value = '';
                document.getElementById('addAnnouncementModalLabel').textContent = '📝 Crear Nuevo Servicio';
                const submitBtn = document.getElementById('submitAnnouncementBtn');
                submitBtn.textContent = '📤 Publicar Servicio';
                submitBtn.classList.remove('btn-azul');
                submitBtn.classList.add('btn-primary');
                location.reload();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.message,
                confirmButtonText: 'Entendido'
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error de conexión',
            text: 'No se pudo conectar con el servidor.',
            confirmButtonText: 'Entendido'
        });
    });
});

// Función para mostrar nombres más amigables
function obtenerNombreCampo(id) {
    const nombres = {
        nombre_servicio: 'Nombre del servicio',
        descripcion: 'Descripción',
        proveedor: 'Proveedor',
        contacto: 'Contacto',
        servicioCategory: 'Categoría'
    };
    return nombres[id] || id;
}

function eliminarservicio(Id) {
    console.log(Id);
    Swal.fire({
        title: '¿Eliminar este servicio?',
        text: "Esta acción no se puede deshacer",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#aaa',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('../../Controlador/formularios/eliminarservicio.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'id_servicio=' + encodeURIComponent(Id)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Eliminado', data.message, 'success');
                    const servicio = document.getElementById('servicio-' + Id);
                    if (servicio) servicio.remove();
                } else {
                    Swal.fire('Error', data.message, 'error');
                }
            })
            .catch(error => {
                Swal.fire('Error', 'Ocurrió un error al eliminar.', 'error');
                console.error(error);
            });
        }
    });
}

function modificarservicio(id) {
    console.log(id);
    fetch(`../../Controlador/formularios/obtenerservicio.php?id=${id}`)
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const servicio = data.servicio;

                // Rellenar formulario
                document.getElementById('formMode').value = 'editar';
                document.getElementById('announcementId').value = servicio.Id;
                document.getElementById('nombre_servicio').value = servicio.Nombre;
                document.getElementById('descripcion').value = servicio.Descripcion;
                document.getElementById('proveedor').value = servicio.Proveedor;
                document.getElementById('contacto').value = servicio.Contacto;
                document.getElementById('servicioCategory').value = servicio.Categoria;

                // Vista previa de imagen
                if (servicio.Imagen) {
                    document.getElementById('imagePreview').src = servicio.Imagen;
                    document.getElementById('imagePreview').style.display = 'block';
                } else {
                    document.getElementById('imagePreview').style.display = 'none';
                }

                // Cambiar título del modal y botón
                document.getElementById('addAnnouncementModalLabel').textContent = '✏️ Modificar Servicio';
                const submitBtn = document.getElementById('submitAnnouncementBtn');
                submitBtn.textContent = '💾 Guardar Cambios';
                submitBtn.classList.remove('btn-primary');
                submitBtn.classList.add('btn-azul');

                // Abrir modal
                const modal = new bootstrap.Modal(document.getElementById('addAnnouncementModal'));
                modal.show();
            } else {
                Swal.fire('Error', data.message, 'error');
            }
        })
        .catch(err => {
            console.error(err);
            Swal.fire('Error', 'No se pudo cargar el servicio.', 'error');
        });
}
document.addEventListener('DOMContentLoaded', () => {
    const filtro = document.getElementById('categoriaFiltro');
    filtro.addEventListener('change', () => {
        const categoriaSeleccionada = filtro.value;
        const servicios = document.querySelectorAll('.announcement-card');

        servicios.forEach(servicio => {
            const categoriaServicio = servicio.getAttribute('data-categoria');
            if (categoriaSeleccionada === 'Todos' || categoriaServicio === categoriaSeleccionada) {
                servicio.style.display = '';
            } else {
                servicio.style.display = 'none';
            }
        });
    });
});
document.getElementById('addAnnouncementModal').addEventListener('hidden.bs.modal', () => {
    // Limpiar formulario
    document.getElementById('ServicioForm').reset();

    // Restablecer valores ocultos
    document.getElementById('formMode').value = 'crear';
    document.getElementById('announcementId').value = '';

    // Ocultar vista previa de imagen
    document.getElementById('imagePreview').style.display = 'none';

    // Restablecer estilos del botón y título
    document.getElementById('addAnnouncementModalLabel').textContent = '📝 Crear Nuevo Servicio';
    const submitBtn = document.getElementById('submitAnnouncementBtn');
    submitBtn.textContent = '📤 Publicar Servicio';
    submitBtn.classList.remove('btn-azul');
    submitBtn.classList.add('btn-primary');

    // Eliminar clases de error
    ['nombre_servicio', 'descripcion', 'proveedor', 'contacto', 'servicioCategory'].forEach(id => {
        document.getElementById(id).classList.remove('is-invalid');
    });
});
