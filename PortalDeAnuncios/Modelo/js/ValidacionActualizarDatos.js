//Obtiene el formulario del DOM
document.addEventListener('DOMContentLoaded', function() {
    const formulario = document.getElementById('registration-form');
    const mensajeErrorGlobal = document.createElement('div');
    mensajeErrorGlobal.className = 'mensaje-error-global';
    formulario.parentNode.insertBefore(mensajeErrorGlobal, formulario.nextSibling);
    
    // Expresiones regulares para validación
    const REGEX_NOMBRE_VALIDO = /^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s']+$/;
    const REGEX_CORREO_VALIDO = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const REGEX_TELEFONO_VALIDO = /^[0-9]{10,15}$/;
    const REGEX_PASSWORD_VALIDO = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
    
    // Variables para controlar el estado del formulario
    let validacionTiempoReal = false;
    
    // Agregar validación en tiempo real después del primer intento de envío
    formulario.addEventListener('submit', function(e) {
        e.preventDefault();
        validacionTiempoReal = true;
        procesarFormulario();
    });
    
    // Event listeners para validación en tiempo real
    const inputs = formulario.querySelectorAll('input');
    inputs.forEach(input => {
        // Validación al perder el foco (blur) - SIEMPRE activa
        input.addEventListener('blur', function() {
            validarCampoIndividual(input);
        });
        
        // Validación mientras escribe - solo después del primer envío
        input.addEventListener('input', function() {
            if (validacionTiempoReal) {
                validarCampoIndividual(input);
            }
        });
        
        // Validación especial para contraseñas
        if (input.id === 'password') {
            input.addEventListener('input', function() {
                mostrarFuerzaPassword(input.value);
                if (validacionTiempoReal) {
                    validarConfirmacionPassword();
                }
            });
            
            input.addEventListener('blur', function() {
                validarCampoIndividual(input);
                validarConfirmacionPassword();
            });
        }
        
        if (input.id === 'confirmarPassword') {
            input.addEventListener('input', function() {
                if (validacionTiempoReal) {
                    validarConfirmacionPassword();
                }
            });
            
            input.addEventListener('blur', function() {
                validarConfirmacionPassword();
            });
        }
    });

    function procesarFormulario() {
        limpiarErrores();
        mostrarCargando(true);
        
        const datos = {
            nombreCompleto: document.getElementById('nombreCompleto').value.trim(),
            correo: document.getElementById('correo').value.trim(),
            telefono: document.getElementById('telefono').value.trim(),
            password: document.getElementById('password').value,
            confirmarPassword: document.getElementById('confirmarPassword').value
        };

        const { esValido, errores } = validarFormulario(datos);
        
        mostrarCargando(false);
        
        if (!esValido) {
            mostrarErrores(errores);
            mostrarToast('Por favor corrige los errores antes de continuar', 'error');
            return;
        }

        enviarFormulario(datos);
    }

    function validarFormulario(datos) {
        const errores = {};
        let esValido = true;

        // Validación de nombre completo
        if (datos.nombreCompleto.length < 5) {
            errores.nombreCompleto = 'El nombre debe tener al menos 5 caracteres';
            esValido = false;
        } else if (!REGEX_NOMBRE_VALIDO.test(datos.nombreCompleto)) {
            errores.nombreCompleto = 'El nombre solo puede contener letras, espacios y apostrofes';
            esValido = false;
        }

        // Validación de correo
        if (!datos.correo) {
            errores.correo = 'El correo electrónico es obligatorio';
            esValido = false;
        } else if (!REGEX_CORREO_VALIDO.test(datos.correo)) {
            errores.correo = 'Ingrese un correo electrónico válido (ejemplo@dominio.com)';
            esValido = false;
        }

        // Validación de teléfono
        if (!datos.telefono) {
            errores.telefono = 'El teléfono es obligatorio';
            esValido = false;
        } else if (!REGEX_TELEFONO_VALIDO.test(datos.telefono)) {
            errores.telefono = 'El teléfono debe contener entre 10 y 15 dígitos';
            esValido = false;
        }

        // Validación de contraseña
        if (!datos.password) {
            errores.password = 'La contraseña es obligatoria';
            esValido = false;
        } else if (!REGEX_PASSWORD_VALIDO.test(datos.password)) {
            errores.password = 'La contraseña debe tener mínimo 8 caracteres, 1 mayúscula, 1 minúscula y 1 número';
            esValido = false;
        }

        // Validación de confirmación de contraseña
        if (!datos.confirmarPassword) {
            errores.confirmarPassword = 'Debes confirmar tu contraseña';
            esValido = false;
        } else if (datos.password !== datos.confirmarPassword) {
            errores.confirmarPassword = 'Las contraseñas no coinciden';
            esValido = false;
        }

        return { esValido, errores };
    }

    function validarCampoIndividual(input) {
        const valor = input.value.trim();
        const campo = input.id;
        const formGroup = input.closest('.form-group');
        
        // Limpiar errores previos del campo
        limpiarErrorCampo(campo);
        
        let esValido = true;
        let mensajeError = '';

        // Validar campos obligatorios vacíos
        if (valor.length === 0) {
            esValido = false;
            switch (campo) {
                case 'nombreCompleto':
                    mensajeError = 'El nombre completo es obligatorio';
                    break;
                case 'correo':
                    mensajeError = 'El correo electrónico es obligatorio';
                    break;
                case 'telefono':
                    mensajeError = 'El teléfono es obligatorio';
                    break;
                case 'password':
                    mensajeError = 'La contraseña es obligatoria';
                    break;
                case 'confirmarPassword':
                    mensajeError = 'Debes confirmar tu contraseña';
                    break;
            }
        } else {
            // Validar formato cuando el campo tiene contenido
            switch (campo) {
                case 'nombreCompleto':
                    if (valor.length < 5) {
                        esValido = false;
                        mensajeError = 'El nombre debe tener al menos 5 caracteres';
                    } else if (!REGEX_NOMBRE_VALIDO.test(valor)) {
                        esValido = false;
                        mensajeError = 'El nombre solo puede contener letras, espacios y apostrofes';
                    }
                    break;
                    
                case 'correo':
                    if (!REGEX_CORREO_VALIDO.test(valor)) {
                        esValido = false;
                        mensajeError = 'Ingrese un correo electrónico válido (ejemplo@dominio.com)';
                    }
                    break;
                    
                case 'telefono':
                    if (!REGEX_TELEFONO_VALIDO.test(valor)) {
                        esValido = false;
                        mensajeError = 'El teléfono debe contener entre 10 y 15 dígitos';
                    }
                    break;
                    
                case 'password':
                    if (!REGEX_PASSWORD_VALIDO.test(valor)) {
                        esValido = false;
                        mensajeError = 'La contraseña debe tener mínimo 8 caracteres, 1 mayúscula, 1 minúscula y 1 número';
                    }
                    break;
            }
        }

        if (esValido && valor.length > 0) {
            marcarCampoValido(input, formGroup);
        } else if (!esValido) {
            marcarCampoInvalido(input, mensajeError, formGroup);
        }
    }

    function validarConfirmacionPassword() {
        const password = document.getElementById('password').value;
        const confirmar = document.getElementById('confirmarPassword').value;
        const input = document.getElementById('confirmarPassword');
        const formGroup = input.closest('.form-group');
        
        limpiarErrorCampo('confirmarPassword');
        
        if (confirmar.length === 0) {
            marcarCampoInvalido(input, 'Debes confirmar tu contraseña', formGroup);
        } else if (password !== confirmar) {
            marcarCampoInvalido(input, 'Las contraseñas no coinciden', formGroup);
        } else {
            marcarCampoValido(input, formGroup);
        }
    }

    function mostrarFuerzaPassword(password) {
        let existingStrength = document.querySelector('.password-strength');
        if (existingStrength) {
            existingStrength.remove();
        }
        
        if (password.length === 0) return;
        
        const passwordGroup = document.getElementById('password').closest('.form-group');
        const strengthDiv = document.createElement('div');
        strengthDiv.className = 'password-strength';
        
        let fuerza = 0;
        let mensaje = '';
        
        if (password.length >= 8) fuerza++;
        if (/[a-z]/.test(password)) fuerza++;
        if (/[A-Z]/.test(password)) fuerza++;
        if (/\d/.test(password)) fuerza++;
        if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) fuerza++;
        
        if (fuerza <= 2) {
            strengthDiv.classList.add('weak');
            mensaje = '🔴 Contraseña débil - Agrega más caracteres y variedad';
        } else if (fuerza <= 3) {
            strengthDiv.classList.add('medium');
            mensaje = '🟡 Contraseña media - Casi ahí, mejora un poco más';
        } else {
            strengthDiv.classList.add('strong');
            mensaje = '🟢 Contraseña fuerte - ¡Excelente seguridad!';
        }
        
        strengthDiv.textContent = mensaje;
        passwordGroup.appendChild(strengthDiv);
    }

    function mostrarErrores(errores) {
        for (const [campo, mensaje] of Object.entries(errores)) {
            const input = document.getElementById(campo);
            const formGroup = input.closest('.form-group');
            marcarCampoInvalido(input, mensaje, formGroup);
        }
        
        // Scroll al primer error
        const primerError = document.querySelector('.error');
        if (primerError) {
            primerError.scrollIntoView({ 
                behavior: 'smooth', 
                block: 'center' 
            });
        }
    }

    function marcarCampoInvalido(input, mensaje, formGroup) {
        input.classList.add('error');
        input.classList.remove('valid');
        formGroup.classList.add('has-error');
        formGroup.classList.remove('has-success');
        
        const errorElement = document.createElement('div');
        errorElement.className = 'mensaje-error';
        errorElement.textContent = mensaje;
        formGroup.appendChild(errorElement);
    }

    function marcarCampoValido(input, formGroup) {
        input.classList.remove('error');
        input.classList.add('valid');
        formGroup.classList.remove('has-error');
        formGroup.classList.add('has-success');
    }

    function limpiarErrorCampo(campo) {
        const input = document.getElementById(campo);
        const formGroup = input.closest('.form-group');
        const errorElement = formGroup.querySelector('.mensaje-error');
        
        if (errorElement) {
            errorElement.remove();
        }
        
        input.classList.remove('error');
        formGroup.classList.remove('has-error');
    }

    function limpiarErrores() {
        document.querySelectorAll('.mensaje-error').forEach(el => el.remove());
        document.querySelectorAll('.error').forEach(el => el.classList.remove('error'));
        document.querySelectorAll('.valid').forEach(el => el.classList.remove('valid'));
        document.querySelectorAll('.has-error').forEach(el => el.classList.remove('has-error'));
        document.querySelectorAll('.has-success').forEach(el => el.classList.remove('has-success'));
        document.querySelectorAll('.password-strength').forEach(el => el.remove());
        
        mensajeErrorGlobal.textContent = '';
        mensajeErrorGlobal.classList.remove('show');
        mensajeErrorGlobal.style.display = 'none';
    }

    function mostrarCargando(mostrar) {
        const boton = document.querySelector('.submit-button');
        if (mostrar) {
            boton.classList.add('loading');
            boton.disabled = true;
            boton.textContent = 'Procesando...';
        } else {
            boton.classList.remove('loading');
            boton.disabled = false;
            boton.textContent = 'Completar Registro';
        }
    }

    async function enviarFormulario(datos) {
        mostrarCargando(true);
        
        try {
            const response = await fetch('../../Controlador/formularios/controlador_ActualizarDatos.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                credentials: 'include',
                body: JSON.stringify({
                    nombreCompleto: datos.nombreCompleto,
                    correo: datos.correo,
                    telefono: datos.telefono,
                    password: datos.password,
                    confirmarPassword: datos.confirmarPassword
                })
            });

            const responseText = await response.text();

            let data;
            try {
                data = JSON.parse(responseText);
            } catch (e) {
                console.error('Respuesta del servidor:', responseText);
                mostrarErrorGlobal('Error al procesar la respuesta del servidor. Intenta nuevamente.');
                return;
            }

            if (!response.ok) {
                throw new Error(data.mensaje || 'Error en el servidor');
            }

        if (data.exito) {
                mostrarToast('¡Registro completado exitosamente!', 'success');
                setTimeout(() => {
                    window.location.href = data.redireccion;
                }, 1500);
            } else {
                if (data.campo && data.mensaje) {
                    const input = document.getElementById(data.campo);
                    const formGroup = input.closest('.form-group');
                    limpiarErrorCampo(data.campo);
                    marcarCampoInvalido(input, data.mensaje, formGroup);
                    input.scrollIntoView({ behavior: 'smooth', block: 'center' });
                } else {
                    mostrarErrorGlobal(data.mensaje || 'Ocurrió un error inesperado.');
                }
            }

        } catch (error) {
            console.error('Error:', error);
            mostrarErrorGlobal(error.message || 'Error al conectar con el servidor. Verifica tu conexión e intenta nuevamente.');
        } finally {
            mostrarCargando(false);
        }
    }

    function mostrarErrorGlobal(mensaje) {
        mensajeErrorGlobal.textContent = mensaje;
        mensajeErrorGlobal.classList.add('show');
        mensajeErrorGlobal.style.display = 'block';
        
        // Scroll al mensaje de error
        mensajeErrorGlobal.scrollIntoView({ 
            behavior: 'smooth', 
            block: 'center' 
        });
    }

    function mostrarToast(mensaje, tipo = 'error') {
        // Remover toast anterior si existe
        const toastExistente = document.querySelector('.toast');
        if (toastExistente) {
            toastExistente.remove();
        }
        
        const toast = document.createElement('div');
        toast.className = `toast ${tipo}`;
        toast.textContent = mensaje;
        
        document.body.appendChild(toast);
        
        // Remover el toast después de 4 segundos
        setTimeout(() => {
            if (toast.parentNode) {
                toast.style.animation = 'slideInRight 0.4s ease-out reverse';
                setTimeout(() => toast.remove(), 400);
            }
        }, 4000);
    }

    // Función para limpiar todos los indicadores visuales al recargar
    function inicializarFormulario() {
        limpiarErrores();
        inputs.forEach(input => {
            input.value = input.value.trim();
        });
    }
    
    // Inicializar el formulario cuando se carga la página
    inicializarFormulario();
});