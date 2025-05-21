document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('form-login');
    const mensaje = document.getElementById('mensaje');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const usuario = document.getElementById("username").value;
        const password = document.getElementById("password").value;
        const tipoUsuario = document.querySelector('input[name="user-type"]:checked').value;

        if (!usuario || !password) {
            mensaje.textContent = 'Por favor, complete todos los campos.';
            return;
        }


        fetch('../Controlador/controlador_login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `usuario=${encodeURIComponent(usuario)}&password=${encodeURIComponent(password)}&user-type=${encodeURIComponent(tipoUsuario)}`
        })
        .then(res => {
            if (!res.ok) throw new Error('Error en la respuesta del servidor');
            return res.json();
        })
        .then(data => {
            if (data.success) {
                window.location.href = data.redirect;
            } else {
                mensaje.textContent = data.message;
            }
        })
        .catch(err => {
            console.error('Error:', err);
            mensaje.textContent = 'Error de conexión con el servidor. Verifica la consola para más detalles.';
        });
    });
});
