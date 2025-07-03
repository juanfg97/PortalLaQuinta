document.addEventListener("DOMContentLoaded", () => {
    const tabla = document.getElementById("tablaReportes");
    const cuerpoTabla = document.getElementById("cuerpoTablaReportes");

    // Filtro: estado y usuario
    const filtroEstado = document.getElementById("filtroEstado");
    const filtroUsuario = document.getElementById("filtroUsuario");

    // Función para filtrar reportes
    window.filtrarReportes = () => {
        const estadoFiltro = filtroEstado.value.toLowerCase();
        const usuarioFiltro = filtroUsuario.value.toLowerCase();

        const filas = cuerpoTabla.querySelectorAll("tr");

        filas.forEach(fila => {
            const estado = fila.getAttribute("data-estado").toLowerCase();
            const usuario = fila.getAttribute("data-usuario").toLowerCase();

            const coincideEstado = estadoFiltro === "todos" || estado === estadoFiltro;
            const coincideUsuario = usuario.includes(usuarioFiltro);

            if (coincideEstado && coincideUsuario) {
                fila.style.display = "";
            } else {
                fila.style.display = "none";
            }
        });
    };

    // Limpiar filtros
    window.limpiarFiltros = () => {
        filtroEstado.value = "todos";
        filtroUsuario.value = "";
        filtrarReportes();
    };

    // Cambiar estado del reporte
    window.cambiarEstado = async (id, nuevoEstado) => {
        const confirmar = await Swal.fire({
            title: "¿Estás seguro?",
            text: `El estado se cambiará a "${nuevoEstado.replace("_", " ")}".`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí, cambiar",
            cancelButtonText: "Cancelar"
        });

        if (!confirmar.isConfirmed) return;

        try {
            const response = await fetch(`../../Controlador/formularios/cambiar_estados.php`, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ id, estado: nuevoEstado })
            });

            const result = await response.json();

            if (response.ok && result.success) {
                Swal.fire("Actualizado", result.message, "success").then(() => {
                    location.reload(); // recarga para ver el nuevo estado
                });
            } else {
                throw new Error(result.message || "No se pudo cambiar el estado.");
            }
        } catch (error) {
            Swal.fire("Error", error.message, "error");
        }
    };

    // Ver detalles del reporte (puedes ajustar esta función a tu modal o sistema de detalles)
       window.verDetalle = async (id) => {
        try {
            const response = await fetch(`../../Controlador/formularios/obtener_detalle_reporte.php?id=${id}`);
            if (!response.ok) throw new Error('Error al obtener detalles');

            const resultado = await response.json();

            if (!resultado.success) throw new Error(resultado.message || 'No se pudo obtener el detalle');

            // Llenar modal con datos
            document.getElementById('detalleId').textContent = resultado.data.id || '';
            document.getElementById('detalleUsuario').textContent = resultado.data.usuario || '';
            document.getElementById('detalleNombreCompleto').textContent = resultado.data.nombre_completo || '';
            document.getElementById('detalleAsunto').textContent = resultado.data.asunto || '';
            document.getElementById('detalleDescripcion').textContent = resultado.data.descripcion || '';
            document.getElementById('detalleTelefono').textContent = resultado.data.telefono || '';
            document.getElementById('detalleFecha').textContent = resultado.data.fecha || '';
            document.getElementById('detalleEstado').textContent = resultado.data.estado || '';
            document.getElementById('detalleUbicacion').textContent = resultado.data.ubicacion || '';

            // Mostrar modal Bootstrap
            const detalleModal = new bootstrap.Modal(document.getElementById('detalleModal'));
            detalleModal.show();

        } catch (error) {
            Swal.fire('Error', error.message, 'error');
        }
    };

    
});
function imprimirReportesPDF() {
    Swal.fire({
        title: 'Filtrar reportes para imprimir',
        html:
            `<select id="filtroEstado" class="swal2-input">
                <option value="todos">Todos los estados</option>
                <option value="pendiente">Pendiente</option>
                <option value="en_proceso">En Proceso</option>
                <option value="resuelto">Resuelto</option>
            </select>
            <label>Desde: <input type="date" id="fechaInicio" class="swal2-input"></label>
            <label>Hasta: <input type="date" id="fechaFin" class="swal2-input"></label>`,
        showCancelButton: true,
        confirmButtonText: 'Generar PDF',
        preConfirm: () => {
            const estado = document.getElementById('filtroEstado').value;
            const desde = document.getElementById('fechaInicio').value;
            const hasta = document.getElementById('fechaFin').value;

            // Validación opcional
            if (desde && hasta && desde > hasta) {
                Swal.showValidationMessage('La fecha "Desde" no puede ser mayor que "Hasta"');
                return false;
            }

            // Crear un formulario y enviarlo como POST
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '../../Controlador/funciones/generar_pdf_reportes.php';
            form.target = '_blank';

            const inputs = [
                { name: 'estado', value: estado },
                { name: 'fechaInicio', value: desde },
                { name: 'fechaFin', value: hasta }
            ];

            inputs.forEach(({ name, value }) => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = name;
                input.value = value;
                form.appendChild(input);
            });

            document.body.appendChild(form);
            form.submit();
            document.body.removeChild(form);
        }
    });
}
