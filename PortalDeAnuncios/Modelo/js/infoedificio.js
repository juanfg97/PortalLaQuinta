document.getElementById('announcementForm').addEventListener('submit', function (e) {
    e.preventDefault();

    // Validar campos obligatorios
    const tituloInput = document.getElementById('announcementTitle');
    const descripcionInput = document.getElementById('announcementContent');
    let isValid = true;

    // Validar título
    if (!tituloInput.value.trim() || tituloInput.value.length < 5) {
        isValid = false;
        tituloInput.classList.add('is-invalid');
        document.getElementById('tituloError').style.display = 'block';
    } else {
        tituloInput.classList.remove('is-invalid');
        document.getElementById('tituloError').style.display = 'none';
    }

    // Validar descripción
    if (!descripcionInput.value.trim() || descripcionInput.value.length < 20) {
        isValid = false;
        descripcionInput.classList.add('is-invalid');
        document.getElementById('descripcionError').style.display = 'block';
    } else {
        descripcionInput.classList.remove('is-invalid');
        document.getElementById('descripcionError').style.display = 'none';
    }

    if (!isValid) {
        Swal.fire({
            icon: 'error',
            title: 'Campos inválidos',
            text: 'Por favor, corrija los errores en el formulario.',
            confirmButtonText: 'Entendido'
        });
        return;
    }

    const modo = document.getElementById('formMode').value || 'crear';
    const anuncioId = document.getElementById('announcementId').value || '';

    const formData = new FormData();
    formData.append('announcementTitle', tituloInput.value);
    formData.append('announcementContent', descripcionInput.value);
    formData.append('modo', modo);
    formData.append('id_anuncio', anuncioId);

    const imageInput = document.getElementById('announcementImage');
    if (imageInput && imageInput.files.length > 0) {
        formData.append('announcementImage', imageInput.files[0]);
    }

    const url = modo === 'editar'
        ? '../../Controlador/formularios/modificarinfoEdificio.php'
        : '../../Controlador/formularios/agregarinfoEdificio.php';

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

                document.getElementById('formMode').value = 'crear';
                document.getElementById('announcementId').value = '';
                document.getElementById('addAnnouncementModalLabel').textContent = '📝 Crear Nuevo Anuncio del edificio';

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
            fetch('../../Controlador/formularios/eliminarinfoEdificio.php', {
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
    fetch(`../../Controlador/formularios/obtenerinfoEdificio.php?id=${id}`)
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const anuncio = data.anuncio;

                document.getElementById('formMode').value = 'editar';
                document.getElementById('announcementId').value = anuncio.Id;
                document.getElementById('announcementTitle').value = anuncio.Titulo;
                document.getElementById('announcementContent').value = anuncio.Descripcion;

                if (anuncio.Imagen) {
                    document.getElementById('imagePreview').src = anuncio.Imagen;
                    document.getElementById('imagePreview').style.display = 'block';
                } else {
                    document.getElementById('imagePreview').style.display = 'none';
                }

                document.getElementById('addAnnouncementModalLabel').textContent = '✏️ Modificar Anuncio';
                const submitBtn = document.getElementById('submitAnnouncementBtn');
                submitBtn.textContent = '💾 Guardar Cambios';
                submitBtn.classList.remove('btn-primary');
                submitBtn.classList.add('btn-azul');

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

function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        preview.src = '';
        preview.style.display = 'none';
    }
}
// Limpia el formulario cada vez que se cierra el modal
document.getElementById('addAnnouncementModal').addEventListener('hidden.bs.modal', function () {
    document.getElementById('announcementForm').reset();

    // Limpiar errores visuales
    document.getElementById('announcementTitle').classList.remove('is-invalid');
    document.getElementById('announcementContent').classList.remove('is-invalid');
    document.getElementById('tituloError').style.display = 'none';
    document.getElementById('descripcionError').style.display = 'none';

    // Ocultar vista previa de imagen
    document.getElementById('imagePreview').src = '';
    document.getElementById('imagePreview').style.display = 'none';

    // Resetear valores ocultos y texto de botones
    document.getElementById('formMode').value = 'crear';
    document.getElementById('announcementId').value = '';
    document.getElementById('addAnnouncementModalLabel').textContent = '📝 Crear Nuevo Anuncio del edificio';

    const submitBtn = document.getElementById('submitAnnouncementBtn');
    submitBtn.textContent = '📤 Publicar Anuncio';
    submitBtn.classList.remove('btn-azul');
    submitBtn.classList.add('btn-primary');
});
