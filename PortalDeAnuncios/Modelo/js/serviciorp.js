
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