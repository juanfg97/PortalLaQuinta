document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('form-login');

    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        const usuario = document.getElementById("username").value.trim();
        const password = document.getElementById("password").value.trim();
        const tipoUsuario = document.querySelector('input[name="user-type"]:checked').value;

        // Validación básica
        if (!usuario || !password) {
            await Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Por favor, complete todos los campos.',
                confirmButtonColor: '#003399'
            });
            return;
        }

        // Mostrar carga
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        submitBtn.disabled = true;
        submitBtn.textContent = 'Cargando...';

        try {
            const response = await fetch('Controlador/controlador_login.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `usuario=${encodeURIComponent(usuario)}&password=${encodeURIComponent(password)}&user-type=${encodeURIComponent(tipoUsuario)}`
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || 'Error en el servidor');
            }

            if (data.success) {
                window.location.href = data.redirect;
            } else {
                await Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message || 'Credenciales incorrectas',
                    confirmButtonColor: '#003399'
                });
            }
        } catch (error) {
            console.error('Error:', error);
            await Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message || 'Error de conexión con el servidor',
                confirmButtonColor: '#003399'
            });
        } finally {
            submitBtn.disabled = false;
            submitBtn.textContent = originalText;
        }
    });
});