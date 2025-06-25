// Función para eliminar presidente
document.addEventListener('DOMContentLoaded', function() {
    // Manejar clics en botones de eliminar
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-delete') || e.target.closest('.btn-delete')) {
            const button = e.target.classList.contains('btn-delete') ? e.target : e.target.closest('.btn-delete');
            const terraza = button.getAttribute('data-terraza');
            const edificio = button.getAttribute('data-edificio');
            const name = button.getAttribute('data-name');
            const building = button.getAttribute('data-building');
            
            // Mostrar confirmación con SweetAlert2
            Swal.fire({
                title: '¿Estás seguro?',
                html: `¿Deseas eliminar al presidente:<br><strong>${name}</strong><br>del edificio <strong>${building}</strong>?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    eliminarPresidente(terraza, edificio, button);
                }
            });
        }
    });
});

// Función para eliminar presidente
function eliminarPresidente(terraza, edificio, button) {
    // Mostrar loading
    Swal.fire({
        title: 'Eliminando...',
        text: 'Por favor espera',
        allowOutsideClick: false,
        showConfirmButton: false,
        willOpen: () => {
            Swal.showLoading();
        }
    });

    // Crear FormData
    const formData = new FormData();
    formData.append('terraza', terraza);
    formData.append('edificio', edificio);
    formData.append('action', 'delete');

    // Realizar petición AJAX
    fetch('../../Controlador/formularios/eliminarPresidente.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Eliminar la fila de la tabla
            const row = button.closest('tr');
            row.style.transition = 'all 0.3s ease';
            row.style.opacity = '0';
            
            setTimeout(() => {
                row.remove();
                
                // Verificar si quedan filas con presidentes (excluyendo mensajes)
                const tableBody = document.getElementById('presidentTableBody');
                const presidentRows = tableBody.querySelectorAll('tr[data-terraza]');
                
                if (presidentRows.length === 0) {
                    tableBody.innerHTML = `
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                No hay presidentes registrados
                            </td>
                        </tr>
                    `;
                }
            }, 300);

            // Mostrar mensaje de éxito
            Swal.fire({
                title: '¡Eliminado!',
                text: 'El presidente ha sido eliminado correctamente',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
            });
        } else {
            // Mostrar error
            Swal.fire({
                title: 'Error',
                text: data.message || 'No se pudo eliminar el presidente',
                icon: 'error',
                confirmButtonText: 'Entendido'
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            title: 'Error',
            text: 'Ocurrió un error al intentar eliminar el presidente',
            icon: 'error',
            confirmButtonText: 'Entendido'
        });
    });
}

// Función para recargar la tabla después de agregar un presidente
function reloadAfterAdd() {
    if (typeof loadPresidentes === 'function') {
        loadPresidentes();
    }
}

// Exponer funciones globalmente
window.eliminarPresidente = eliminarPresidente;
window.reloadAfterAdd = reloadAfterAdd;