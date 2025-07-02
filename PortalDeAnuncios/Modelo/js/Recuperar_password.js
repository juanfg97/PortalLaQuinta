document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('login-form');
    const usuarioInput = document.getElementById('usuario');
    const correoInput = document.getElementById('correo');
    const userTypeRadios = document.querySelectorAll('input[name="user-type"]'); // 🔄 NUEVO
    const submitButton = document.querySelector('.submit-button');
    const mensajeErrorGlobal = document.getElementById('mensaje-error-global');
    
    // Elementos del modal
    const modalToken = document.getElementById('modal-token');
    const closeModal = document.getElementById('close-modal');
    const btnCancel = document.getElementById('btn-cancel');
    const btnVerify = document.getElementById('btn-verify');
    const tokenInput = document.getElementById('token-input');
    const modalError = document.getElementById('modal-error');

    // Función para mostrar errores
    function mostrarError(input, mensaje) {
        const formGroup = input.closest('.form-group');
        input.classList.remove('valid');
        input.classList.add('error');
        formGroup.classList.add('has-error');
        formGroup.classList.remove('has-success');

        const mensajeExistente = formGroup.querySelector('.mensaje-error');
        if (mensajeExistente) {
            mensajeExistente.remove();
        }

        const mensajeError = document.createElement('div');
        mensajeError.className = 'mensaje-error';
        mensajeError.textContent = mensaje;
        formGroup.appendChild(mensajeError);
    }

    function mostrarValido(input) {
        const formGroup = input.closest('.form-group');
        input.classList.remove('error');
        input.classList.add('valid');
        formGroup.classList.remove('has-error');
        formGroup.classList.add('has-success');

        const mensajeError = formGroup.querySelector('.mensaje-error');
        if (mensajeError) {
            mensajeError.remove();
        }
    }

    function limpiarErrores() {
        const inputs = form.querySelectorAll('input');
        inputs.forEach(input => {
            input.classList.remove('error', 'valid');
            const formGroup = input.closest('.form-group');
            formGroup.classList.remove('has-error', 'has-success');
        });

        const mensajesError = form.querySelectorAll('.mensaje-error');
        mensajesError.forEach(mensaje => mensaje.remove());

        mensajeErrorGlobal.classList.remove('show');
        mensajeErrorGlobal.textContent = '';
    }

    function mostrarModal() {
        modalToken.classList.add('show');
        tokenInput.value = '';
        tokenInput.focus();
        modalError.style.display = 'none';
    }

    function ocultarModal() {
        modalToken.classList.remove('show');
        tokenInput.value = '';
        modalError.style.display = 'none';
    }

    usuarioInput.addEventListener('input', function() {
    const valor = this.value.trim();
    if (valor.length === 0) return;

    if (!/^[0-9]{1,2}[A-Z]-[0-9]{2}$/.test(valor)) {
        mostrarError(this, 'El usuario debe tener formato 1A-11');
    } else {
        mostrarValido(this);
    }
});


    correoInput.addEventListener('input', function() {
        const valor = this.value.trim();
        if (valor.length === 0) return;

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(valor)) {
            mostrarError(this, 'Por favor ingresa un correo electrónico válido');
        } else {
            mostrarValido(this);
        }
    });

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        limpiarErrores();

        let esValido = true;
        const usuario = usuarioInput.value.trim();
        const correo = correoInput.value.trim();

        // 🔄 NUEVO: Obtener el tipo de usuario seleccionado
        let userType = '';
        userTypeRadios.forEach(radio => {
            if (radio.checked) userType = radio.value;
        });

        if (usuario === '') {
            mostrarError(usuarioInput, 'El usuario es obligatorio');
            esValido = false;
        }else if (!/^[a-zA-Z0-9]+$/.test(usuario) && !/^[0-9]{1,2}[A-Z]-[0-9]{2}$/.test(usuario)) {
    mostrarError(usuarioInput, 'El usuario debe ser alfanumérico o tener el formato 1A-11');
    esValido = false;
}
 else {
            mostrarValido(usuarioInput);
        }

        if (correo === '') {
            mostrarError(correoInput, 'El correo electrónico es obligatorio');
            esValido = false;
        } else {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(correo)) {
                mostrarError(correoInput, 'Por favor ingresa un correo electrónico válido');
                esValido = false;
            } else {
                mostrarValido(correoInput);
            }
        }

        if (!esValido) {
            mensajeErrorGlobal.classList.add('show');
            mensajeErrorGlobal.textContent = 'Por favor corrige los errores.';
            return;
        }

        submitButton.classList.add('loading');
        submitButton.textContent = 'Enviando código...';
        submitButton.disabled = true;

        fetch('Controlador/formularios/controlador_recuperar.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ usuario, correo, tipo: userType }) // 🔄 NUEVO
        })
        .then(response => response.json())
        .then(data => {
            if (data.exito) {
                mostrarToast('Código de verificación enviado a ' + correo, 'success');
                mostrarModal();
            } else {
                if (data.campo === 'correo') {
                    mostrarError(correoInput, data.mensaje || 'Error con el correo');
                } else if (data.campo === 'usuario') {
                    mostrarError(usuarioInput, data.mensaje || 'Error con el usuario');
                } else {
                    mensajeErrorGlobal.textContent = data.mensaje || 'Ocurrió un error';
                    mensajeErrorGlobal.classList.add('show');
                }
            }
        })
        .catch(error => {
            mensajeErrorGlobal.textContent = 'Error al contactar el servidor. Inténtalo de nuevo.';
            mensajeErrorGlobal.classList.add('show');
        })
        .finally(() => {
            submitButton.classList.remove('loading');
            submitButton.textContent = 'Continuar';
            submitButton.disabled = false;
        });
    });

    closeModal.addEventListener('click', ocultarModal);
    btnCancel.addEventListener('click', ocultarModal);

    modalToken.addEventListener('click', function(e) {
        if (e.target === modalToken) {
            ocultarModal();
        }
    });

    tokenInput.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
        if (this.value.length > 0) {
            modalError.style.display = 'none';
            this.style.borderColor = '#e1e5e9';
        }
    });

    btnVerify.addEventListener('click', function () {
        const token = tokenInput.value.trim();

        if (token.length !== 6) {
            modalError.textContent = 'El código debe tener 6 dígitos';
            modalError.style.display = 'block';
            tokenInput.style.borderColor = 'var(--error-color)';
            tokenInput.focus();
            return;
        }

        btnVerify.classList.add('loading');
        btnVerify.textContent = 'Verificando...';
        btnVerify.disabled = true;
        btnCancel.disabled = true;

        fetch('Controlador/funciones/Verificar_codigo.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                correo: correoInput.value.trim(),
                codigo: token
            })
        })
        .then(res => res.json())
        .then(data => {
            btnVerify.classList.remove('loading');
            btnVerify.textContent = 'Verificar';
            btnVerify.disabled = false;
            btnCancel.disabled = false;

            if (data.exito) {
                Swal.fire({
                    icon: 'success',
                    title: 'Verificado',
                    text: 'Código correcto, redirigiendo...',
                    confirmButtonText: 'Continuar'
                }).then(() => {
                    window.location.href = 'Actualizarpassword.php';
                });
            } else {
                modalError.textContent = data.mensaje || 'Código incorrecto. Intenta nuevamente.';
                modalError.style.display = 'block';
                tokenInput.style.borderColor = 'var(--error-color)';
                tokenInput.focus();
            }
        })
        .catch(err => {
            console.error('Error en la verificación', err);
            btnVerify.classList.remove('loading');
            btnVerify.textContent = 'Verificar';
            btnVerify.disabled = false;
            btnCancel.disabled = false;

            Swal.fire({
                icon: 'error',
                title: 'Error de red',
                text: 'Hubo un problema al conectar con el servidor',
                confirmButtonText: 'Ok'
            });
        });
    });

    tokenInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            btnVerify.click();
        }
    });

    function mostrarToast(mensaje, tipo = 'success') {
        const toast = document.createElement('div');
        toast.className = `toast ${tipo}`;
        toast.textContent = mensaje;
        document.body.appendChild(toast);

        setTimeout(() => {
            toast.remove();
        }, 4000);
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modalToken.classList.contains('show')) {
            if (!btnVerify.disabled) {
                ocultarModal();
            }
        }
    });
});
