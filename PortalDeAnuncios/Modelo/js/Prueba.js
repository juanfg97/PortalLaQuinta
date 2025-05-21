// Obtiene el formulario del DOM por su ID
const formulario = document.getElementById('registration-form');

// Crea un contenedor para mensajes de error globales
const mensajeErrorGlobal = document.createElement('div');
mensajeErrorGlobal.className = 'mensaje-error-global';

// Inserta el contenedor de errores justo después del formulario
formulario.parentNode.insertBefore(mensajeErrorGlobal, formulario.nextSibling);

// Expresión regular para validar nombres (letras, espacios, caracteres especiales en español)
const REGEX_NOMBRE_VALIDO = /^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s']+$/;

// Event listener para el envío del formulario
formulario.addEventListener('submit', function(e) {
    e.preventDefault(); // Evita el envío tradicional del formulario
    limpiarErrores(); // Limpia errores anteriores
    
    // Recolecta los datos del formulario (solo nombreCompleto en este caso)
    const datos = {
        nombreCompleto: document.getElementById('fullname').value.trim(), // Obtiene y limpia espacios
    };

    // Valida el formulario y obtiene resultado
    const { esValido, errores } = validarFormulario(datos);
    
    // Si hay errores, los muestra y detiene el envío
    if (!esValido) {
        mostrarErrores(errores);
        return;
    }

    // Si todo es válido, envía el formulario
    enviarFormulario(datos);
});

// Función de validación del formulario
function validarFormulario(datos) {
    const errores = {}; // Objeto para almacenar errores
    let esValido = true; // Bandera de validación

    // Validación de longitud mínima (5 caracteres)
    if (datos.nombreCompleto.length < 5) {
        errores.nombreCompleto = 'El nombre debe tener al menos 5 caracteres';
        esValido = false;
    }
    // Validación de caracteres permitidos usando regex
    else if (!REGEX_NOMBRE_VALIDO.test(datos.nombreCompleto)) {
        errores.nombreCompleto = 'El nombre solo puede contener letras y espacios';
        esValido = false;
    }

    return { esValido, errores };
}

// Función para mostrar errores bajo los campos correspondientes
function mostrarErrores(errores) {
    // Itera sobre cada error
    for (const [campo, mensaje] of Object.entries(errores)) {
        const input = document.getElementById(campo); // Encuentra el input
        const errorElement = document.createElement('div'); // Crea contenedor de error
        errorElement.className = 'mensaje-error'; // Asigna clase CSS
        errorElement.textContent = mensaje; // Establece mensaje
        input.parentNode.appendChild(errorElement); // Añade mensaje al DOM
        input.classList.add('error'); // Marca input como inválido
    }
}

// Función para limpiar errores previos
function limpiarErrores() {
    // Elimina todos los mensajes de error
    document.querySelectorAll('.mensaje-error').forEach(el => el.remove());
    // Quita clases 'error' de inputs
    document.querySelectorAll('.error').forEach(el => el.classList.remove('error'));
    // Limpia y oculta mensaje global
    mensajeErrorGlobal.textContent = '';
    mensajeErrorGlobal.style.display = 'none';
}

// Función para enviar datos al servidor
async function enviarFormulario(datos) {
    try {
        // Envía datos por POST al servidor
        const response = await fetch('../Controlador/controlador_prueba.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                nombreCompleto: datos.nombreCompleto
            })
        });

        // Primero captura el texto de la respuesta
        const responseText = await response.text();
        
        // Intenta parsear como JSON, con manejo de errores
        let data;
        try {
            data = JSON.parse(responseText);
        } catch (e) {
            
            console.log('Respuesta del servidor:', responseText);
            mostrarErrorGlobal('Error al procesar la respuesta del servidor');
            return;
        }

        if (!response.ok) { // Si hay error HTTP
            throw new Error(data.mensaje || 'Error en el servidor');
        }

        if (data.exito) { // Si el servidor reporta éxito
            window.location.href = data.redireccion; // Redirecciona
        } else { // Si el servidor reporta fallo
            mostrarErrorGlobal(data.mensaje); // Muestra mensaje de error
        }
    } catch (error) { // Captura errores de red/conexión
        console.error('Error:', error);
        mostrarErrorGlobal(error.message || 'Error al conectar con el servidor');
    }
}

// Función para mostrar errores globales (no de campo específico)
function mostrarErrorGlobal(mensaje) {
    mensajeErrorGlobal.textContent = mensaje; // Establece mensaje
    mensajeErrorGlobal.style.display = 'block'; // Hace visible
    // Estilos CSS inline para el mensaje de error
    mensajeErrorGlobal.style.color = 'red';
    mensajeErrorGlobal.style.margin = '10px 0';
    mensajeErrorGlobal.style.padding = '10px';
    mensajeErrorGlobal.style.border = '1px solid red';
}