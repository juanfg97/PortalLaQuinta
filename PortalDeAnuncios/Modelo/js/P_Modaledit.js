

  const REGEX_NOMBRE_VALIDO = /^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s']+$/;
    const REGEX_CORREO_VALIDO = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const REGEX_TELEFONO_VALIDO = /^[0-9]{10,15}$/;
    const REGEX_PASSWORD_VALIDO = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
    

document.addEventListener('DOMContentLoaded', function() {
    
    // Crear modales dinámicamente
    createModals();
    
    // Configurar event listeners para botones de editar
    setupEditButtons();
    
   
    // Configurar botones de seguridad
    setupSecurityButtons();
});

// Crear los modales HTML dinámicamente
function createModals() {
    const modalsHTML = `

          <!-- Modal para editar usuario -->
        <div class="modal fade" id="editUserModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: var(--primary-color); color: white;">
                        <h5 class="modal-title">
                            <span style="margin-right: 10px;"></span>
                            Editar Usuario
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="userForm" method="post">
                            <div class="mb-3">
                                <label for="user" class="form-label">Usuario</label>
                                <input type="text" class="form-control" id="user" name="user" required>
                                <div class="form-text">Ingrese su usuario.</div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="saveUser()" 
                                style="background-color: var(--primary-color); border-color: var(--primary-color);">
                            💾 Guardar Cambios
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal para editar nombre -->
        <div class="modal fade" id="editNameModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: var(--primary-color); color: white;">
                        <h5 class="modal-title">
                            <span style="margin-right: 10px;"></span>
                            Editar Nombre Completo
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="nameForm" method="post">
                            <div class="mb-3">
                                <label for="fullName" class="form-label">Nombre Completo</label>
                                <input type="text" class="form-control" id="fullName" name="fullname" required>
                                <div class="form-text">Ingresa tu nombre completo como aparece en tu documento de identidad.</div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="saveName()" 
                                style="background-color: var(--primary-color); border-color: var(--primary-color);">
                            💾 Guardar Cambios
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para editar email -->
        <div class="modal fade" id="editEmailModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: var(--primary-color); color: white;">
                        <h5 class="modal-title">
                            <span style="margin-right: 10px;"></span>
                            Editar Correo Electrónico
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="emailForm" method ="post">
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <div class="form-text">Este correo se usará para notificaciones y recuperación de contraseña.</div>
                            </div>
                            <div class="mb-3">
                                <label for="confirmEmail" class="form-label">Confirmar Correo Electrónico</label>
                                <input type="email" class="form-control" id="confirmEmail" name="confirmEmail" required>
                                <div class="form-text">Vuelve a escribir tu correo para confirmarlo.</div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="saveEmail()" 
                                style="background-color: var(--primary-color); border-color: var(--primary-color);">
                            💾 Guardar Cambios
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para editar teléfono -->
        <div class="modal fade" id="editPhoneModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: var(--primary-color); color: white;">
                        <h5 class="modal-title">
                            <span style="margin-right: 10px;"></span>
                            Editar Número de Teléfono
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="phoneForm" method = "post">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Número de Teléfono</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required>
                                <div class="form-text">Ejemplo:04141234567</div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="savePhone()" 
                                style="background-color: var(--primary-color); border-color: var(--primary-color);">
                            💾 Guardar Cambios
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para cambiar contraseña -->
        <div class="modal fade" id="changePasswordModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: var(--warning-color); color: var(--dark-color);">
                        <h5 class="modal-title">
                            <span style="margin-right: 10px;">🔑</span>
                            Cambiar Contraseña
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="passwordForm" method ="post">
                            <div class="mb-3">
                                <label for="currentPassword" class="form-label">Contraseña Actual</label>
                                <input type="password" class="form-control" id="currentPassword" required>
                            </div>
                            <div class="mb-3">
                                <label for="newPassword" class="form-label">Nueva Contraseña</label>
                                <input type="password" class="form-control" id="newPassword" required>
                                <div class="form-text">La contraseña debe tener al menos 8 caracteres.</div>
                            </div>
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Confirmar Nueva Contraseña</label>
                                <input type="password" class="form-control" id="confirmPassword" required>
                            </div>
                            <div class="password-strength">
                                <small id="passwordStrength" class="form-text"></small>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-warning" onclick="savePassword()">
                            🔐 Cambiar Contraseña
                        </button>
                    </div>
                </div>
            </div>
        </div>

     
    `;
    
    // Insertar modales en el body
    document.body.insertAdjacentHTML('beforeend', modalsHTML);
}

// Configurar botones de editar
function setupEditButtons() {
     // Botón de editar usuario
    document.querySelector('.info-item:nth-child(1) .edit-btn').addEventListener('click', function() {
        const modal = new bootstrap.Modal(document.getElementById('editUserModal'));
        modal.show();
    });
    // Botón de editar nombre
    document.querySelector('.info-item:nth-child(2) .edit-btn').addEventListener('click', function() {
        const modal = new bootstrap.Modal(document.getElementById('editNameModal'));
        modal.show();
    });
    
    // Botón de editar email
    document.querySelector('.info-item:nth-child(3) .edit-btn').addEventListener('click', function() {
        const modal = new bootstrap.Modal(document.getElementById('editEmailModal'));
        modal.show();
    });
    
    // Botón de editar teléfono
    document.querySelector('.info-item:nth-child(4) .edit-btn').addEventListener('click', function() {
        const modal = new bootstrap.Modal(document.getElementById('editPhoneModal'));
        modal.show();
    });
}

// Configurar botones de seguridad
function setupSecurityButtons() {
    // Botón cambiar contraseña
    document.querySelector('.change-password-btn').addEventListener('click', function() {
        const modal = new bootstrap.Modal(document.getElementById('changePasswordModal'));
        modal.show();
    });
   
    
    // Verificador de fortaleza de contraseña
    document.getElementById('newPassword').addEventListener('input', checkPasswordStrength);
}



// Funciones para guardar datos (aquí conectarías con tu backend)
function saveUser() {
    const user = document.getElementById('user').value.trim();

    if (!user) {
        showErrorMessage('El usuario no puede estar vacío');
        return;
    }
  
    fetch('../../Controlador/guardados/P_guardarusuario.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ user: user })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.querySelector('.info-item:nth-child(1) .info-value').textContent = user;
            bootstrap.Modal.getInstance(document.getElementById('editUserModal')).hide();
            showSuccessMessage('Nombre actualizado correctamente');
        } else {
            showErrorMessage(data.message || 'Error al guardar el nombre');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showErrorMessage('Error de red o del servidor');
    });
}
function saveName() {
    const name = document.getElementById('fullName').value.trim();

    if (!name) {
        showErrorMessage('El nombre completo no puede estar vacío');
        return;
    }
    if(!REGEX_NOMBRE_VALIDO.test(name)){

        showErrorMessage('El nombre completo solo puede contener letras, espacios y apostrofes');
        return;
    }

    fetch('../../Controlador/guardados/P_guardarnombre.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ fullname: name })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.querySelector('.info-item:nth-child(2) .info-value').textContent = name;
            bootstrap.Modal.getInstance(document.getElementById('editNameModal')).hide();
            showSuccessMessage('Nombre actualizado correctamente');
        } else {
            showErrorMessage(data.message || 'Error al guardar el nombre');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showErrorMessage('Error de red o del servidor');
    });
}

function saveEmail() {
    const email = document.getElementById('email').value.trim();
    const confirmEmail = document.getElementById('confirmEmail').value.trim();
    
    if (!email || !confirmEmail) {
        showErrorMessage('Todos los campos son obligatorios');
        return;
    }
    
    if (email !== confirmEmail) {
        showErrorMessage('Los correos no coinciden');
        return;
    }
    
    if (!REGEX_CORREO_VALIDO.test(email)) {
        showErrorMessage('Ingresa un correo válido');
        return;
    }
      

    fetch('../../Controlador/guardados/P_guardarcorreo.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ email: email , confirmEmail: confirmEmail })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.querySelector('.info-item:nth-child(3) .info-value').textContent = email;
            bootstrap.Modal.getInstance(document.getElementById('editEmailModal')).hide();
            showSuccessMessage('Correo actualizado correctamente');
        } else {
            showErrorMessage(data.message || 'Error al guardar el correo');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showErrorMessage('Error de red o del servidor');
    });
}

function savePhone() {
    const phone = document.getElementById('phone').value.trim();
    
    if (!phone) {
        showErrorMessage('El teléfono no puede estar vacío');
        return;
    }
    if(!REGEX_TELEFONO_VALIDO.test(phone)){
         showErrorMessage('El numero de telefono no es valido');
        return;

    }
    
       fetch('../../Controlador/guardados/P_guardartelefono.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ phone: phone })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.querySelector('.info-item:nth-child(4) .info-value').textContent = phone;
            bootstrap.Modal.getInstance(document.getElementById('editPhoneModal')).hide();
            showSuccessMessage('Teléfono actualizado correctamente');
        } else {
            showErrorMessage(data.message || 'Error al guardar el número de teléfono');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showErrorMessage('Error de red o del servidor');
    });
}

function savePassword() {
    const currentPassword = document.getElementById('currentPassword').value;
    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword= document.getElementById('confirmPassword').value;
    
    if (!currentPassword || !newPassword || !confirmPassword) {
        showErrorMessage('Todos los campos son obligatorios');
        return;
    }
    
    if (newPassword !== confirmPassword) {
        showErrorMessage('Las contraseñas nuevas no coinciden');
        return;
    }
    
    if (!REGEX_PASSWORD_VALIDO.test(newPassword)) {
        showErrorMessage('La contraseña debe tener mínimo 8 caracteres, 1 mayúscula, 1 minúscula y 1 número');
        return;
    }
    
   fetch('../../Controlador/guardados/P_guardarpassword.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ currentPassword: currentPassword,
        newPassword: newPassword,
        confirmPassword:confirmPassword


         })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            bootstrap.Modal.getInstance(document.getElementById('changePasswordModal')).hide();
            showSuccessMessage('Contraseña actualizada correctamente');
        } else {
            showErrorMessage(data.message || 'Error al actualizar la contraseña');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showErrorMessage('Error de red o del servidor');
    });
}



// Funciones auxiliares
function checkPasswordStrength() {
    const password = document.getElementById('newPassword').value;
    const strengthElement = document.getElementById('passwordStrength');
    
    let strength = 0;
    let message = '';
    
    if (password.length >= 8) strength++;
    if (/[a-z]/.test(password)) strength++;
    if (/[A-Z]/.test(password)) strength++;
    if (/[0-9]/.test(password)) strength++;
    if (/[^A-Za-z0-9]/.test(password)) strength++;
    
    switch (strength) {
        case 0:
        case 1:
            message = '🔴 Muy débil';
            strengthElement.style.color = '#dc3545';
            break;
        case 2:
            message = '🟡 Débil';
            strengthElement.style.color = '#ffc107';
            break;
        case 3:
            message = '🟠 Regular';
            strengthElement.style.color = '#fd7e14';
            break;
        case 4:
            message = '🟢 Fuerte';
            strengthElement.style.color = '#28a745';
            break;
        case 5:
            message = '🟢 Muy fuerte';
            strengthElement.style.color = '#28a745';
            break;
    }
    
    strengthElement.textContent = message;
}


function showSuccessMessage(message) {
    // Crear y mostrar mensaje de éxito
    const alert = document.createElement('div');
    alert.className = 'alert alert-success alert-dismissible fade show position-fixed';
    alert.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    alert.innerHTML = `
        <strong>✅ ${message}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(alert);
    
    // Auto-remover después de 5 segundos
    setTimeout(() => {
        if (alert.parentNode) {
            alert.remove();
        }
    }, 5000);
}

function showErrorMessage(message) {
    // Crear y mostrar mensaje de error
    const alert = document.createElement('div');
    alert.className = 'alert alert-danger alert-dismissible fade show position-fixed';
    alert.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    alert.innerHTML = `
        <strong>❌ ${message}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(alert);
    
    // Auto-remover después de 5 segundos
    setTimeout(() => {
        if (alert.parentNode) {
            alert.remove();
        }
    }, 5000);
}