document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("reporteForm");

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
        if (asunto.length < 10) {
            Swal.fire({
                icon: 'error',
                title: 'Asunto demasiado corto',
                text: 'El asunto debe tener al menos 10 caracteres.'
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
        
        if (descripcion.length < 100) {
            Swal.fire({
                icon: 'error',
                title: 'Descripción muy corta',
                text: 'La descripción no puede ser menor de 100 caracteres.'
            });
            return;
        }

        const formData = new FormData();
        formData.append("asunto", asunto);
        formData.append("descripcion", descripcion);

        try {
            const response = await fetch("../../Controlador/formularios/reportespc.php", {
                method: "POST",
                body: formData
            });

            const result = await response.json(); // Esperamos JSON del backend

            if (response.ok && result.success) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Reporte enviado!',
                    text: result.message || 'Tu reporte ha sido enviado correctamente.'
                });
                form.reset();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error al enviar',
                    text: result.message || 'Hubo un problema al enviar tu reporte.'
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
