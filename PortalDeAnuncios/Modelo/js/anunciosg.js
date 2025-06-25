document.getElementById('announcementForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const requiredFields = ['announcementTitle', 'announcementContent', 'authorName', 'announcementCategory'];
    let isValid = true;

    // Limpiar errores previos
    requiredFields.forEach(field => {
        document.getElementById(field).classList.remove('is-invalid');
    });

    // Validar campos obligatorios
    requiredFields.forEach(field => {
        const input = document.getElementById(field);
        if (!input.value.trim()) {
            isValid = false;
            input.classList.add('is-invalid');
        }
    });

    if (!isValid) {
        Swal.fire({
            icon: 'error',
            title: 'Campos incompletos',
            text: 'Por favor, complete todos los campos obligatorios.',
            confirmButtonText: 'Entendido'
        });
        return;
    }

    // Validar longitud del título (5-100 caracteres)
    const title = document.getElementById('announcementTitle').value.trim();
    if (title.length < 5 || title.length > 100) {
        Swal.fire({
            icon: 'warning',
            title: 'Título inválido',
            text: 'El título debe tener entre 5 y 100 caracteres.',
            confirmButtonText: 'Entendido'
        });
        document.getElementById('announcementTitle').classList.add('is-invalid');
        return;
    }

    // Validar longitud del contenido (10-2000 caracteres)
    const content = document.getElementById('announcementContent').value.trim();
    if (content.length < 10 || content.length > 6000) {
        Swal.fire({
            icon: 'warning',
            title: 'Contenido inválido',
            text: 'El contenido debe tener entre 10 y 6000 caracteres.',
            confirmButtonText: 'Entendido'
        });
        document.getElementById('announcementContent').classList.add('is-invalid');
        return;
    }

    // Validar categoría permitida
    const allowedCategories = ['info', 'alert', 'event']; // Cambia según tus categorías reales
    const category = document.getElementById('announcementCategory').value;
    if (!allowedCategories.includes(category)) {
        Swal.fire({
            icon: 'warning',
            title: 'Categoría inválida',
            text: 'Por favor, selecciona una categoría válida.',
            confirmButtonText: 'Entendido'
        });
        document.getElementById('announcementCategory').classList.add('is-invalid');
        return;
    }

    // Validar imagen si existe
    const imageInput = document.getElementById('announcementImage');
    if (imageInput && imageInput.files.length > 0) {
        const file = imageInput.files[0];
        const allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        const maxSize = 3 * 1024 * 1024; // 3MB
        const fileExtension = file.name.split('.').pop().toLowerCase();

        if (!allowedExtensions.includes(fileExtension)) {
            Swal.fire({
                icon: 'warning',
                title: 'Formato de imagen no permitido',
                text: 'Solo se permiten imágenes JPG, JPEG, PNG o GIF.',
                confirmButtonText: 'Entendido'
            });
            return;
        }

        if (file.size > maxSize) {
            Swal.fire({
                icon: 'warning',
                title: 'Imagen demasiado grande',
                text: 'La imagen no debe superar los 3MB.',
                confirmButtonText: 'Entendido'
            });
            return;
        }
    }

    // Obtener modo y id del anuncio
    const modo = document.getElementById('formMode').value || 'crear';
    const anuncioId = document.getElementById('announcementId').value || '';

    // Recopilar datos del formulario
    const formData = new FormData();

    // Agregar campos obligatorios
    requiredFields.forEach(field => {
        formData.append(field, document.getElementById(field).value.trim());
    });

    // Agregar modo y id
    formData.append('modo', modo);
    formData.append('id_anuncio', anuncioId);

    // Agregar imagen si existe
    if (imageInput && imageInput.files.length > 0) {
        formData.append('announcementImage', imageInput.files[0]);
    }

    // Elegir URL según modo
    const url = modo === 'editar'
        ? '../../Controlador/formularios/modificaranuncio.php'
        : '../../Controlador/formularios/agregarAnunciog.php';

    fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: modo === 'editar' ? '¡Anuncio actualizado!' : '¡Anuncio agregado!',
                text: data.message,
                confirmButtonText: 'Excelente'
            }).then(() => {
                const modal = bootstrap.Modal.getInstance(document.getElementById('addAnnouncementModal'));
                modal.hide();
                document.getElementById('announcementForm').reset();

                // Resetear formulario a modo creación
                document.getElementById('formMode').value = 'crear';
                document.getElementById('announcementId').value = '';
                document.getElementById('addAnnouncementModalLabel').textContent = '📝 Crear Nuevo Anuncio General';
                const submitBtn = document.getElementById('submitAnnouncementBtn');
                submitBtn.textContent = '📤 Publicar Anuncio';
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

function formatearFecha(fecha) {
    const opciones = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(fecha).toLocaleDateString('es-ES', opciones);
}

function eliminarAnuncio(Id) {
    Swal.fire({
        title: '¿Eliminar este anuncio?',
        text: "Esta acción no se puede deshacer",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#aaa',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('../../Controlador/formularios/eliminaranunciog.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'id_anuncio=' + encodeURIComponent(Id)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Eliminado', data.message, 'success');
                    const anuncio = document.getElementById('anuncio-' + Id);
                    if (anuncio) anuncio.remove();
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

function modificarAnuncio(id) {
    fetch(`../../Controlador/formularios/obteneranuncio.php?id=${id}`)
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const anuncio = data.anuncio;

                // Rellenar formulario
                document.getElementById('formMode').value = 'editar';
                document.getElementById('announcementId').value = anuncio.Id;
                document.getElementById('announcementTitle').value = anuncio.Titulo;
                document.getElementById('announcementContent').value = anuncio.Descripcion;
                document.getElementById('authorName').value = anuncio.Autor;
                document.getElementById('announcementCategory').value = anuncio.Categoria;

                // Vista previa de imagen
                if (anuncio.Imagen) {
                    document.getElementById('imagePreview').src = anuncio.Imagen;
                    document.getElementById('imagePreview').style.display = 'block';
                } else {
                    document.getElementById('imagePreview').style.display = 'none';
                }

                // Cambiar título del modal y botón
                document.getElementById('addAnnouncementModalLabel').textContent = '✏️ Modificar Anuncio';
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
            Swal.fire('Error', 'No se pudo cargar el anuncio.', 'error');
        });
}
