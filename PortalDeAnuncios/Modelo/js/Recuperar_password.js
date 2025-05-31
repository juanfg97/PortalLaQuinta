document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('login-form');
    const usuarioInput = document.getElementById('usuario');
    const correoInput = document.getElementById('correo');
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
        
        // Remover errores previos
        input.classList.remove('valid');
        input.classList.add('error');
        formGroup.classList.add('has-error');
        formGroup.classList.remove('has-success');
        
        // Remover mensaje de error existente
        const mensajeExistente = formGroup.querySelector('.mensaje-error');
        if (mensajeExistente) {
            mensajeExistente.remove();
        }
        
        // Agregar nuevo mensaje de error
        const mensajeError = document.createElement('div');
        mensajeError.className = 'mensaje-error';
        mensajeError.textContent = mensaje;
        formGroup.appendChild(mensajeError);
    }

    // Función para mostrar campo válido
    function mostrarValido(input) {
        const formGroup = input.closest('.form-group');
        
        input.classList.remove('error');
        input.classList.add('valid');
        formGroup.classList.remove('has-error');
        formGroup.classList.add('has-success');
        
        // Remover mensaje de error
        const mensajeError = formGroup.querySelector('.mensaje-error');
        if (mensajeError) {
            mensajeError.remove();
        }
    }

    // Función para limpiar todos los errores
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

    // Función para mostrar modal
    function mostrarModal() {
        modalToken.classList.add('show');
        tokenInput.value = '';
        tokenInput.focus();
        modalError.style.display = 'none';
    }

    // Función para ocultar modal
    function ocultarModal() {
        modalToken.classList.remove('show');
        tokenInput.value = '';
        modalError.style.display = 'none';
    }

    // Validación en tiempo real usuario
    usuarioInput.addEventListener('input', function() {
        const valor = this.value.trim();
        if (valor.length === 0) {
            return; // No validar si está vacío mientras escribe
        }
        
        if (!/^[0-9]{1,2}[A-Z]-[0-9]{2}$/.test(valor)) {
            mostrarError(this, 'El usuario debe tener formato 1A-11');
        } else {
            mostrarValido(this);
        }
    });

    // Validación en tiempo real correo
    correoInput.addEventListener('input', function() {
        const valor = this.value.trim();
        if (valor.length === 0) {
            return; // No validar si está vacío mientras escribe
        }
        
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(valor)) {
            mostrarError(this, 'Por favor ingresa un correo electrónico válido');
        } else {
            mostrarValido(this);
        }
    });

    // Validación del formulario al enviar
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        limpiarErrores();
        
        let esValido = true;
        const usuario = usuarioInput.value.trim();
        const correo = correoInput.value.trim();

        // Validar usuario
        if (usuario === '') {
            mostrarError(usuarioInput, 'El usuario es obligatorio');
            esValido = false;
        } else if (!/^[0-9]{1,2}[A-Z]-[0-9]{2}$/.test(usuario)) {
            mostrarError(usuarioInput, 'El usuario debe tener formato 1A-11');
            esValido = false;
        } else {
            mostrarValido(usuarioInput);
        }

        // Validar correo
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

        // Si todo es válido, mostrar loading y después el modal
        submitButton.classList.add('loading');
        submitButton.textContent = 'Enviando código...';
        submitButton.disabled = true;

        // Enviar solicitud real al servidor
        fetch('../Controlador/controlador_recuperar.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ usuario, correo })
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

    // Event listeners del modal
    closeModal.addEventListener('click', ocultarModal);
    btnCancel.addEventListener('click', ocultarModal);

    // Cerrar modal al hacer click en el overlay
    modalToken.addEventListener('click', function(e) {
        if (e.target === modalToken) {
            ocultarModal();
        }
    });

    // Validación del input token (solo números)
    tokenInput.addEventListener('input', function() {
        // Solo permitir números
        this.value = this.value.replace(/[^0-9]/g, '');
        
        // Ocultar error cuando empiece a escribir
        if (this.value.length > 0) {
            modalError.style.display = 'none';
            this.style.borderColor = '#e1e5e9';
        }
    });

    // Verificación del token (único listener sin anidar)
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

    fetch('../Controlador/Verificar_codigo.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            correo: correoInput.value.trim(),
            codigo: token
        })
    })
    .then(res => res.json())
    .then(data => {
        console.log('Respuesta del servidor:', data); // 🔍 DEBUG

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
                window.location.href = '../Vista/Actualizarpassword.php';
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

    // Permitir envío con Enter en el input del token
    tokenInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            btnVerify.click();
        }
    });

    // Función para mostrar toast
    function mostrarToast(mensaje, tipo = 'success') {
        const toast = document.createElement('div');
        toast.className = `toast ${tipo}`;
        toast.textContent = mensaje;
        document.body.appendChild(toast);

        setTimeout(() => {
            toast.remove();
        }, 4000);
    }

    // Prevenir cierre del modal con ESC si se está procesando
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modalToken.classList.contains('show')) {
            if (!btnVerify.disabled) {
                ocultarModal();
            }
        }
    });
});
