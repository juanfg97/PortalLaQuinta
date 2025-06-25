function filterTable(searchTerm) {
            const tableRows = document.querySelectorAll('#presidentTableBody tr');
            let found = false;

            tableRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                    found = true;
                } else {
                    row.style.display = 'none';
                }
            });

            return found;
        }

        // Buscar mientras escribe (muestra mensaje inferior si no hay coincidencias)
        document.getElementById('searchInput').addEventListener('keyup', function () {
            const searchTerm = this.value.toLowerCase();
            const found = filterTable(searchTerm);
            const message = document.getElementById('noResultsMessage');

            if (searchTerm.trim() === '') {
                message.style.display = 'none';
            } else {
                message.style.display = found ? 'none' : 'block';
            }
        });

        // Buscar con botón (solo SweetAlert si no encuentra nada y resetea)
        document.getElementById('searchBtn').addEventListener('click', function () {
            const input = document.getElementById('searchInput');
            const searchTerm = input.value.toLowerCase();
            const found = filterTable(searchTerm);

            if (!found) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Sin coincidencias',
                    text: 'No se ha encontrado lo ingresado.',
                    confirmButtonText: 'Cerrar'
                }).then(() => {
                    // Limpiar campo y mostrar todos los registros
                    input.value = '';
                    document.querySelectorAll('#presidentTableBody tr').forEach(row => {
                        row.style.display = '';
                    });
                });
            }
        });

        // Validación en tiempo real para el campo Edificio
        document.getElementById('edificio').addEventListener('input', function () {
    this.value = this.value.replace(/[^A-Z]/g, '').toUpperCase().substring(0, 1);
    if (this.value.length === 0) this.value = '';
});

        // Validación en tiempo real para el campo Teléfono
        document.getElementById('telefono').addEventListener('input', function () {
            this.value = this.value.replace(/[^0-9\-\+\(\)\s]/g, '');
        });

        // Validación en tiempo real para el campo Terraza
        document.getElementById('terraza').addEventListener('input', function () {
            if (this.value < 1) this.value = 1;
            if (this.value > 13) this.value = 13;
        });

        // Manejar el envío del formulario
        document.getElementById('addPresidentForm').addEventListener('submit', function (e) {
            e.preventDefault();
            
            // Validar que todos los campos estén llenos
            const requiredFields = ['terraza', 'edificio', 'usuario', 'nombreCompleto', 'correo', 'telefono', 'password','repeatpassword'];
            let isValid = true;
            
            requiredFields.forEach(field => {
                const input = document.getElementById(field);
                if (!input.value.trim()) {
                    isValid = false;
                    input.classList.add('is-invalid');
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            if (!isValid) {
                Swal.fire({
                    icon: 'error',
                    title: 'Campos incompletos',
                    text: 'Por favor, complete todos los campos obligatorios.',
                    confirmButtonText: 'Entendido'
                });
                return;
            }

            // Validar formato de correo
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(document.getElementById('correo').value)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Correo inválido',
                    text: 'Por favor, ingrese un correo electrónico válido.',
                    confirmButtonText: 'Entendido'
                });
                return;
            }
            //Validar contraseña
            const REGEX_PASSWORD_VALIDO = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
            if(!REGEX_PASSWORD_VALIDO.test(document.getElementById('password').value)){
                 Swal.fire({
                    icon: 'error',
                    title: 'Contraseña inválida',
                    text: 'Por favor, ingrese una contraseña con mas de 8 digitos, y al menos una letra mayuscula, una minuscula, y un número.',
                    confirmButtonText: 'Entendido'
                });

            }
            if(!document.getElementById('password').value === document.getElementById('repeatpassword').value){
                Swal.fire({
                    icon: 'error',
                    title: 'Contraseña diferentes',
                    text: 'Las contraseñas no coinciden.',
                    confirmButtonText: 'Entendido'
                });
            }

            // Recopilar datos del formulario
            const formData = new FormData();
            requiredFields.forEach(field => {
                formData.append(field, document.getElementById(field).value);
            }); 
            
            fetch('../../Controlador/formularios/agregarpresidente.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Presidente agregado!',
                        text: data.message,
                        confirmButtonText: 'Excelente'
                    }).then(() => {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('addPresidentModal'));
                        modal.hide();
                        document.getElementById('addPresidentForm').reset();
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message,
                        confirmButtonText: 'Entendido'
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error de conexión',
                    text: 'No se pudo conectar con el servidor.',
                    confirmButtonText: 'Entendido'
                });
            });
            
        });

        // Limpiar validaciones cuando se cierra el modal
        document.getElementById('addPresidentModal').addEventListener('hidden.bs.modal', function () {
            document.getElementById('addPresidentForm').reset();
            document.querySelectorAll('.is-invalid').forEach(input => {
                input.classList.remove('is-invalid');
            });
        });