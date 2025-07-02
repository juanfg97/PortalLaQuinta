
document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("reporteForm");

    // Variables de sesión pasadas desde PHP
    const telefono = "<?php echo isset($_SESSION['telefono']) ? $_SESSION['telefono'] : ''; ?>";
    const usuario = "<?php echo isset($_SESSION['usuario']) ? $_SESSION['usuario'] : ''; ?>";

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const asunto = document.getElementById("asunto").value.trim();
        const descripcion = document.getElementById("descripcion").value.trim();

        // Validaciones
        if (asunto === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Campo obligatorio',
                text: 'El campo "Asunto" es obligatorio.'
            });
            return;
        }

        if (descripcion === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Campo obligatorio',
                text: 'El campo "Descripción Detallada" es obligatorio.'
            });
            return;
        }

        if (asunto.length > 100) {
            Swal.fire({
                icon: 'error',
                title: 'Asunto demasiado largo',
                text: 'El asunto no puede superar los 100 caracteres.'
            });
            return;
        }

        if (descripcion.length > 1000) {
            Swal.fire({
                icon: 'error',
                title: 'Descripción muy extensa',
                text: 'La descripción no puede superar los 1000 caracteres.'
            });
            return;
        }

        const formData = new FormData();
        formData.append("asunto", asunto);
        formData.append("descripcion", descripcion);
        formData.append("telefono", telefono);
        formData.append("usuario", usuario);

        try {
            const response = await fetch("../../Controlador/formularios/reportes.php", {
                method: "POST",
                body: formData
            });

            const result = await response.text();

            if (response.ok) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Reporte enviado!',
                    text: 'Tu reporte ha sido enviado correctamente.'
                });
                form.reset();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error al enviar',
                    text: result || 'Hubo un problema al enviar tu reporte.'
                });
            }
        } catch (error) {
            console.error("Error en el envío:", error);
            Swal.fire({
                icon: 'error',
                title: 'Error de red',
                text: 'No se pudo enviar el reporte. Intenta nuevamente.'
            });
        }
    });
});

