document.addEventListener('DOMContentLoaded', function() {
    const formulario = document.getElementById('registration-form');
    const mensajeErrorGlobal = document.createElement('div');
    mensajeErrorGlobal.className = 'mensaje-error-global';
    formulario.parentNode.insertBefore(mensajeErrorGlobal, formulario.nextSibling);

    formulario.addEventListener('submit', function(e) {
        e.preventDefault();
        limpiarErrores();
        
        const datos = {
            nombreCompleto: document.getElementById('fullname').value.trim(),
            correo: document.getElementById('email').value.trim(),
            telefono: document.getElementById('phone').value.trim(),
            password: document.getElementById('password').value,
            confirmPassword: document.getElementById('confirm-password').value
        };

        const { esValido, errores } = validarFormulario(datos);
        
        if (!esValido) {
            mostrarErrores(errores);
            return;
        }

        enviarFormulario(datos);
    });

    function validarFormulario(datos) {
        const errores = {};
        let esValido = true;

        // Validaciones
        if (datos.nombreCompleto.length < 5) {
            errores.nombreCompleto = 'El nombre debe tener al menos 5 caracteres';
            esValido = false;
        }

        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(datos.correo)) {
            errores.correo = 'Ingrese un correo electrónico válido';
            esValido = false;
        }

        if (!/^[0-9]{10,15}$/.test(datos.telefono)) {
            errores.telefono = 'Teléfono debe tener 10-15 dígitos';
            esValido = false;
        }

        if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/.test(datos.password)) {
            errores.password = 'La password debe tener 8+ caracteres, 1 mayúscula, 1 minúscula y 1 número';
            esValido = false;
        }

        if (datos.password !== datos.confirmPassword) {
            errores.confirmPassword = 'Las passwords no coinciden';
            esValido = false;
        }

        return { esValido, errores };
    }

    function mostrarErrores(errores) {
        for (const [campo, mensaje] of Object.entries(errores)) {
            const input = document.getElementById(campo);
            const errorElement = document.createElement('div');
            errorElement.className = 'mensaje-error';
            errorElement.textContent = mensaje;
            input.parentNode.appendChild(errorElement);
            input.classList.add('error');
        }
    }

    function limpiarErrores() {
        document.querySelectorAll('.mensaje-error').forEach(el => el.remove());
        document.querySelectorAll('.error').forEach(el => el.classList.remove('error'));
        mensajeErrorGlobal.textContent = '';
        mensajeErrorGlobal.style.display = 'none';
    }

    async function enviarFormulario(datos) {
        try {
            const response = await fetch('../../Controlador/controlador_ActualizarDatos.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    nombreCompleto: datos.nombreCompleto,
                    correo: datos.correo,
                    telefono: datos.telefono,
                    password: datos.password,
                    'confirm-password': datos.confirmPassword
                })
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.mensaje || 'Error en el servidor');
            }

            if (data.exito) {
                window.location.href = data.redireccion;
            } else {
                mostrarErrorGlobal(data.mensaje);
            }
        } catch (error) {
            console.error('Error:', error);
            mostrarErrorGlobal(error.message || 'Error al conectar con el servidor');
        }
    }

    function mostrarErrorGlobal(mensaje) {
        mensajeErrorGlobal.textContent = mensaje;
        mensajeErrorGlobal.style.display = 'block';
        mensajeErrorGlobal.style.color = 'red';
        mensajeErrorGlobal.style.margin = '10px 0';
        mensajeErrorGlobal.style.padding = '10px';
        mensajeErrorGlobal.style.border = '1px solid red';
    }
});