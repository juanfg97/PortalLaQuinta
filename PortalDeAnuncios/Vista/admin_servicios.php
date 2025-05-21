
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Servicios - Portal Residencial La Quinta</title>
    <style>
        :root {
            --primary-color: #003399;
            --secondary-color: #001f5f;
            --accent-color: #0055cc;
            --light-color: #f5f8ff;
            --gray-color: #e0e5f0;
            --dark-color: #333;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: var(--light-color);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            width: 100%;
        }
        
        /* Header */
        header {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
        }
        
        .logo {
            display: flex;
            align-items: center;
        }
        
        .logo-image {
            margin-right: 15px;
        }
        
        .logo-image img {
            height: 80px;
            width: auto;
            object-fit: contain;
        }
        
        .logo-text {
            display: flex;
            flex-direction: column;
        }
        
        .logo-text h1 {
            color: var(--primary-color);
            font-size: 28px;
            font-weight: bold;
            margin: 0;
        }
        
        .logo-text span {
            color: var(--secondary-color);
            font-size: 16px;
        }
        
        .user-menu {
            display: flex;
            align-items: center;
        }
        
        .admin-badge {
            background-color: var(--accent-color);
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            margin-right: 15px;
            font-size: 14px;
            font-weight: 500;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--gray-color);
            margin-right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            font-weight: bold;
        }
        
        .logout-btn {
            background: none;
            border: none;
            color: var(--accent-color);
            cursor: pointer;
            font-weight: 500;
        }
        
        /* Navigation */
        nav {
            background-color: var(--primary-color);
        }
        
        .nav-container {
            display: flex;
        }
        
        .nav-item {
            color: white;
            padding: 15px 20px;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.3s;
        }
        
        .nav-item:hover, .nav-item.active {
            background-color: var(--secondary-color);
        }
        
        /* Main Content */
        main {
            flex: 1;
            padding: 30px 0;
        }
        
        .services-header {
            margin-bottom: 30px;
        }
        
        .services-header h2 {
            color: var(--primary-color);
            font-size: 24px;
            margin-bottom: 10px;
        }
        
        .services-header p {
            color: var(--dark-color);
        }
        
        .btn {
            padding: 8px 16px;
            border-radius: 4px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
        }
        
        .add-service-btn {
            margin-bottom: 20px;
            display: inline-flex;
            align-items: center;
            font-size: 15px;
        }
        
        .add-service-btn:before {
            content: "+";
            display: inline-block;
            margin-right: 8px;
            font-size: 18px;
            font-weight: bold;
        }
        
        .services-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 25px;
            margin-bottom: 30px;
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 1px solid var(--gray-color);
            padding-bottom: 15px;
        }
        
        .card-header h3 {
            color: var(--primary-color);
            font-size: 18px;
        }
        
        /* Service Form */
        .service-form {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 25px;
            margin-bottom: 30px;
            display: none; /* Hidden by default */
        }
        
        .form-header {
            margin-bottom: 20px;
            border-bottom: 1px solid var(--gray-color);
            padding-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .form-header h3 {
            color: var(--primary-color);
            font-size: 18px;
        }
        
        .close-form {
            background: none;
            border: none;
            font-size: 20px;
            color: var(--dark-color);
            cursor: pointer;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark-color);
        }
        
        .form-control {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid var(--gray-color);
            border-radius: 4px;
            font-size: 14px;
        }
        
        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }
        
        .file-upload {
            display: flex;
            flex-direction: column;
        }
        
        .file-upload-label {
            display: inline-block;
            background-color: var(--primary-color);
            color: white;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            margin-bottom: 10px;
            text-align: center;
            font-weight: 500;
            max-width: 200px;
        }
        
        .file-name {
            font-size: 14px;
            color: #666;
        }
        
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }
        
        .btn-cancel {
            background-color: #6c757d;
            color: white;
        }
        
        .btn-cancel:hover {
            background-color: #5a6268;
        }
        
        .btn-save {
            background-color: var(--success-color);
            color: white;
        }
        
        .btn-save:hover {
            background-color: #218838;
        }
        
        /* Services List */
        .services-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        
        .service-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }
        
        .service-image {
            height: 200px;
            overflow: hidden;
            background-color: var(--gray-color);
            position: relative;
        }
        
        .service-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .service-content {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .service-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 10px;
        }
        
        .service-phone {
            color: var(--primary-color);
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        
        .service-phone:before {
            content: "☎";
            display: inline-block;
            margin-right: 8px;
            font-size: 16px;
        }
        
        .service-description {
            color: #444;
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 15px;
            flex: 1;
        }
        
        .service-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: auto;
        }
        
        .btn-edit {
            background-color: var(--accent-color);
            color: white;
            font-size: 14px;
            padding: 6px 12px;
        }
        
        .btn-edit:hover {
            background-color: #0047b3;
        }
        
        .btn-delete {
            background-color: var(--danger-color);
            color: white;
            font-size: 14px;
            padding: 6px 12px;
        }
        
        .btn-delete:hover {
            background-color: #c82333;
        }
        
        /* Footer */
        footer {
            background-color: var(--secondary-color);
            color: white;
            padding: 20px 0;
            margin-top: auto;
        }
        
        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .footer-logo {
            font-weight: bold;
            font-size: 18px;
        }
        
        .footer-contact span {
            margin-right: 15px;
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .services-list {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                text-align: center;
                padding: 15px 0;
            }
            
            .user-menu {
                margin-top: 15px;
            }
            
            .nav-container {
                flex-wrap: wrap;
            }
            
            .nav-item {
                flex-basis: 50%;
                text-align: center;
            }
            
            .services-list {
                grid-template-columns: 1fr;
            }
            
            .footer-content {
                flex-direction: column;
                text-align: center;
            }
            
            .footer-logo {
                margin-bottom: 10px;
            }
            
            .footer-contact span {
                display: block;
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container header-container">
            <div class="logo">
                <div class="logo-image">
                    <!-- Logo de La Quinta -->
                    <img src="/api/placeholder/120/80" alt="Logo La Quinta">
                </div>
                <div class="logo-text">
                    <h1>LA QUINTA</h1>
                    <span>Portal Residencial</span>
                </div>
            </div>
            <div class="user-menu">
                <div class="admin-badge">Administrador</div>
                <div class="user-avatar">A</div>
                <button class="logout-btn">Cerrar sesión</button>
            </div>
        </div>
    </header>
    
    <!-- Navigation -->
    <nav>
        <div class="container nav-container">
            <a href="#" class="nav-item">Inicio</a>
            <a href="#" class="nav-item">Residentes</a>
            <a href="#" class="nav-item">Anuncios</a>
            <a href="#" class="nav-item active">Servicios</a>
        </div>
    </nav>
    
    <!-- Main Content -->
    <main>
        <div class="container">
            <div class="services-header">
                <h2>Gestión de Servicios</h2>
                <p>Administra los servicios disponibles para los residentes del Parque Residencial La Quinta.</p>
            </div>
            
            <!-- Add Service Button -->
            <button class="btn btn-primary add-service-btn" id="showFormBtn">Agregar Nuevo Servicio</button>
            
            <!-- Service Form (Hidden by default) -->
            <div class="service-form" id="serviceForm">
                <div class="form-header">
                    <h3>Crear Nuevo Servicio</h3>
                    <button class="close-form" id="closeFormBtn">&times;</button>
                </div>
                <form>
                    <div class="form-group">
                        <label for="title">Título del Servicio</label>
                        <input type="text" class="form-control" id="title" placeholder="Ingrese el título del servicio">
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <textarea class="form-control" id="description" placeholder="Ingrese la descripción detallada del servicio"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Teléfono de Contacto</label>
                        <input type="tel" class="form-control" id="phone" placeholder="Ingrese el teléfono de contacto">
                    </div>
                    
                    <div class="form-group">
                        <label>Imagen del Servicio</label>
                        <div class="file-upload">
                            <label for="image" class="file-upload-label">Seleccionar Imagen</label>
                            <input type="file" id="image" style="display: none;">
                            <span class="file-name" id="fileName">Ningún archivo seleccionado</span>
                        </div>
                    </div>
                    
                    <div class="form-actions">
                        <button type="button" class="btn btn-cancel" id="cancelFormBtn">Cancelar</button>
                        <button type="submit" class="btn btn-save">Guardar Servicio</button>
                    </div>
                </form>
            </div>
            
            <!-- Services List -->
            <div class="services-list">
                <!-- Service 1 -->
                <div class="service-card">
                    <div class="service-image">
                        <img src="/api/placeholder/400/200" alt="Plomería">
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">Plomería y Fontanería</h3>
                        <div class="service-phone">(032) 555-4321</div>
                        <p class="service-description">Servicio de plomería profesional para reparaciones de emergencia, instalación de tuberías, detección de fugas y mantenimiento general de sistemas hidráulicos residenciales.</p>
                        <div class="service-actions">
                            <button class="btn btn-edit">Editar</button>
                            <button class="btn btn-delete">Eliminar</button>
                        </div>
                    </div>
                </div>
                
                <!-- Service 2 -->
                <div class="service-card">
                    <div class="service-image">
                        <img src="/api/placeholder/400/200" alt="Electricidad">
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">Electricidad Residencial</h3>
                        <div class="service-phone">(032) 555-7890</div>
                        <p class="service-description">Servicios eléctricos para hogares incluyendo reparaciones, instalaciones, actualización de sistemas eléctricos, iluminación y solución de problemas de emergencia.</p>
                        <div class="service-actions">
                            <button class="btn btn-edit">Editar</button>
                            <button class="btn btn-delete">Eliminar</button>
                        </div>
                    </div>
                </div>
                
                <!-- Service 3 -->
                <div class="service-card">
                    <div class="service-image">
                        <img src="/api/placeholder/400/200" alt="Jardinería">
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">Jardinería y Paisajismo</h3>
                        <div class="service-phone">(032) 555-2468</div>
                        <p class="service-description">Servicio completo de jardinería, diseño paisajístico, mantenimiento de áreas verdes, poda de árboles y arbustos, y sistemas de riego automático.</p>
                        <div class="service-actions">
                            <button class="btn btn-edit">Editar</button>
                            <button class="btn btn-delete">Eliminar</button>
                        </div>
                    </div>
                </div>
                
                <!-- Service 4 -->
                <div class="service-card">
                    <div class="service-image">
                        <img src="/api/placeholder/400/200" alt="Cerrajería">
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">Cerrajería 24 Horas</h3>
                        <div class="service-phone">(032) 555-1357</div>
                        <p class="service-description">Servicio de cerrajería disponible las 24 horas para emergencias, cambio de cerraduras, duplicado de llaves, apertura de puertas y asesoramiento en seguridad.</p>
                        <div class="service-actions">
                            <button class="btn btn-edit">Editar</button>
                            <button class="btn btn-delete">Eliminar</button>
                        </div>
                    </div>
                </div>
                
                <!-- Service 5 -->
                <div class="service-card">
                    <div class="service-image">
                        <img src="/api/placeholder/400/200" alt="Limpieza">
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">Servicio de Limpieza</h3>
                        <div class="service-phone">(032) 555-9876</div>
                        <p class="service-description">Limpieza profesional para hogares incluyendo limpieza general, profunda, de ventanas, alfombras y tapicería. Servicio regular o por demanda según sus necesidades.</p>
                        <div class="service-actions">
                            <button class="btn btn-edit">Editar</button>
                            <button class="btn btn-delete">Eliminar</button>
                        </div>
                    </div>
                </div>
                
                <!-- Service 6 -->
                <div class="service-card">
                    <div class="service-image">
                        <img src="/api/placeholder/400/200" alt="Mantenimiento de Aires Acondicionados">
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">Mantenimiento de Aires Acondicionados</h3>
                        <div class="service-phone">(032) 555-3698</div>
                        <p class="service-description">Instalación, reparación y mantenimiento preventivo de sistemas de aire acondicionado. Limpieza de filtros, revisión de fugas y recarga de gas refrigerante.</p>
                        <div class="service-actions">
                            <button class="btn btn-edit">Editar</button>
                            <button class="btn btn-delete">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <!-- Footer -->
    <footer>
        <div class="container footer-content">
            <div class="footer-logo">
                LA QUINTA - Parque Residencial
            </div>
            <div class="footer-contact">
                <span>Av. Víctor Baptista, Los Teques</span>
                <span>Tel: (032) 31.1221</span>
            </div>
        </div>
    </footer>
    
    <script>
        // JavaScript para mostrar/ocultar el formulario
        document.addEventListener('DOMContentLoaded', function() {
            const showFormBtn = document.getElementById('showFormBtn');
            const closeFormBtn = document.getElementById('closeFormBtn');
            const cancelFormBtn = document.getElementById('cancelFormBtn');
            const serviceForm = document.getElementById('serviceForm');
            const imageInput = document.getElementById('image');
            const fileName = document.getElementById('fileName');
            
            // Mostrar formulario
            showFormBtn.addEventListener('click', function() {
                serviceForm.style.display = 'block';
                showFormBtn.style.display = 'none';
            });
            
            // Ocultar formulario
            function hideForm() {
                serviceForm.style.display = 'none';
                showFormBtn.style.display = 'inline-flex';
            }
            
            closeFormBtn.addEventListener('click', hideForm);
            cancelFormBtn.addEventListener('click', hideForm);
            
            // Mostrar nombre del archivo seleccionado
            imageInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    fileName.textContent = this.files[0].name;
                } else {
                    fileName.textContent = 'Ningún archivo seleccionado';
                }
            });
        });
    </script>
</body>
</html>