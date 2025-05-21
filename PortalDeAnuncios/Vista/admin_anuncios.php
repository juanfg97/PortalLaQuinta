<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Anuncios - Portal Residencial La Quinta</title>
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
        
        .announcements-header {
            margin-bottom: 30px;
        }
        
        .announcements-header h2 {
            color: var(--primary-color);
            font-size: 24px;
            margin-bottom: 10px;
        }
        
        .announcements-header p {
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
        
        .add-announcement-btn {
            margin-bottom: 20px;
            display: inline-flex;
            align-items: center;
            font-size: 15px;
        }
        
        .add-announcement-btn:before {
            content: "+";
            display: inline-block;
            margin-right: 8px;
            font-size: 18px;
            font-weight: bold;
        }
        
        .announcements-card {
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
        
        /* Announcement Form */
        .announcement-form {
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
        
        .priority-options {
            display: flex;
            gap: 15px;
        }
        
        .priority-option {
            display: flex;
            align-items: center;
        }
        
        .priority-option input {
            margin-right: 5px;
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
        
        /* Announcements List */
        .announcements-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        
        .announcement-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }
        
        .announcement-image {
            height: 200px;
            overflow: hidden;
            background-color: var(--gray-color);
            position: relative;
        }
        
        .announcement-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .priority-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            color: white;
        }
        
        .priority-urgent {
            background-color: var(--danger-color);
        }
        
        .priority-important {
            background-color: var(--warning-color);
            color: #856404;
        }
        
        .priority-normal {
            background-color: var(--primary-color);
        }
        
        .announcement-content {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .announcement-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 10px;
        }
        
        .announcement-date {
            color: #666;
            font-size: 14px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        
        .announcement-date:before {
            content: "";
            display: inline-block;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin-right: 8px;
        }
        
        .announcement-description {
            color: #444;
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 15px;
            flex: 1;
        }
        
        .announcement-actions {
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
            .announcements-list {
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
            
            .announcements-list {
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
            <a href="#" class="nav-item active">Anuncios</a>
            <a href="#" class="nav-item">Servicios</a>
        </div>
    </nav>
    
    <!-- Main Content -->
    <main>
        <div class="container">
            <div class="announcements-header">
                <h2>Gestión de Anuncios</h2>
                <p>Administra los anuncios para los residentes del Parque Residencial La Quinta.</p>
            </div>
            
            <!-- Add Announcement Button -->
            <button class="btn btn-primary add-announcement-btn" id="showFormBtn">Agregar Nuevo Anuncio</button>
            
            <!-- Announcement Form (Hidden by default) -->
            <div class="announcement-form" id="announcementForm">
                <div class="form-header">
                    <h3>Crear Nuevo Anuncio</h3>
                    <button class="close-form" id="closeFormBtn">&times;</button>
                </div>
                <form>
                    <div class="form-group">
                        <label for="title">Título del Anuncio</label>
                        <input type="text" class="form-control" id="title" placeholder="Ingrese el título del anuncio">
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <textarea class="form-control" id="description" placeholder="Ingrese la descripción detallada del anuncio"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="date">Fecha</label>
                        <input type="date" class="form-control" id="date">
                    </div>
                    
                    <div class="form-group">
                        <label>Prioridad</label>
                        <div class="priority-options">
                            <div class="priority-option">
                                <input type="radio" id="normal" name="priority" value="normal" checked>
                                <label for="normal">Normal</label>
                            </div>
                            <div class="priority-option">
                                <input type="radio" id="important" name="priority" value="important">
                                <label for="important">Importante</label>
                            </div>
                            <div class="priority-option">
                                <input type="radio" id="urgent" name="priority" value="urgent">
                                <label for="urgent">Urgente</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Imagen del Anuncio</label>
                        <div class="file-upload">
                            <label for="image" class="file-upload-label">Seleccionar Imagen</label>
                            <input type="file" id="image" style="display: none;">
                            <span class="file-name" id="fileName">Ningún archivo seleccionado</span>
                        </div>
                    </div>
                    
                    <div class="form-actions">
                        <button type="button" class="btn btn-cancel" id="cancelFormBtn">Cancelar</button>
                        <button type="submit" class="btn btn-save">Guardar Anuncio</button>
                    </div>
                </form>
            </div>
            
            <!-- Announcements List -->
            <div class="announcements-list">
                <!-- Announcement 1 -->
                <div class="announcement-card">
                    <div class="announcement-image">
                        <img src="/api/placeholder/400/200" alt="Mantenimiento Piscina">
                        <span class="priority-badge priority-urgent">Urgente</span>
                    </div>
                    <div class="announcement-content">
                        <h3 class="announcement-title">Mantenimiento de Piscina</h3>
                        <div class="announcement-date">14/05/2025</div>
                        <p class="announcement-description">Se realizará mantenimiento de la piscina el día viernes 16 de mayo. El área estará cerrada de 8:00 AM a 4:00 PM. Agradecemos su comprensión.</p>
                        <div class="announcement-actions">
                            <button class="btn btn-edit">Editar</button>
                            <button class="btn btn-delete">Eliminar</button>
                        </div>
                    </div>
                </div>
                
                <!-- Announcement 2 -->
                <div class="announcement-card">
                    <div class="announcement-image">
                        <img src="/api/placeholder/400/200" alt="Asamblea de Residentes">
                        <span class="priority-badge priority-important">Importante</span>
                    </div>
                    <div class="announcement-content">
                        <h3 class="announcement-title">Asamblea General de Residentes</h3>
                        <div class="announcement-date">10/05/2025</div>
                        <p class="announcement-description">Invitamos a todos los residentes a la Asamblea General que se llevará a cabo el sábado 24 de mayo a las 10:00 AM en el salón comunal. Se discutirán temas importantes sobre el presupuesto anual.</p>
                        <div class="announcement-actions">
                            <button class="btn btn-edit">Editar</button>
                            <button class="btn btn-delete">Eliminar</button>
                        </div>
                    </div>
                </div>
                
                <!-- Announcement 3 -->
                <div class="announcement-card">
                    <div class="announcement-image">
                        <img src="/api/placeholder/400/200" alt="Corte de Luz">
                        <span class="priority-badge priority-urgent">Urgente</span>
                    </div>
                    <div class="announcement-content">
                        <h3 class="announcement-title">Corte Programado de Energía</h3>
                        <div class="announcement-date">12/05/2025</div>
                        <p class="announcement-description">La empresa eléctrica realizará trabajos de mantenimiento que requerirán un corte de energía el día 17 de mayo de 2:00 PM a 6:00 PM. Por favor tomen las precauciones necesarias.</p>
                        <div class="announcement-actions">
                            <button class="btn btn-edit">Editar</button>
                            <button class="btn btn-delete">Eliminar</button>
                        </div>
                    </div>
                </div>
                
                <!-- Announcement 4 -->
                <div class="announcement-card">
                    <div class="announcement-image">
                        <img src="/api/placeholder/400/200" alt="Nuevo Sistema de Seguridad">
                        <span class="priority-badge priority-normal">Normal</span>
                    </div>
                    <div class="announcement-content">
                        <h3 class="announcement-title">Nuevo Sistema de Seguridad</h3>
                        <div class="announcement-date">08/05/2025</div>
                        <p class="announcement-description">Informamos que se ha instalado un nuevo sistema de cámaras de seguridad en todas las áreas comunes. Esto mejorará la vigilancia y seguridad de nuestro residencial.</p>
                        <div class="announcement-actions">
                            <button class="btn btn-edit">Editar</button>
                            <button class="btn btn-delete">Eliminar</button>
                        </div>
                    </div>
                </div>
                
                <!-- Announcement 5 -->
                <div class="announcement-card">
                    <div class="announcement-image">
                        <img src="/api/placeholder/400/200" alt="Actividades para Niños">
                        <span class="priority-badge priority-normal">Normal</span>
                    </div>
                    <div class="announcement-content">
                        <h3 class="announcement-title">Actividades para Niños</h3>
                        <div class="announcement-date">05/05/2025</div>
                        <p class="announcement-description">Este fin de semana organizamos actividades recreativas para los niños del residencial. Se realizarán juegos, manualidades y más, de 10:00 AM a 1:00 PM en el área verde.</p>
                        <div class="announcement-actions">
                            <button class="btn btn-edit">Editar</button>
                            <button class="btn btn-delete">Eliminar</button>
                        </div>
                    </div>
                </div>
                
                <!-- Announcement 6 -->
                <div class="announcement-card">
                    <div class="announcement-image">
                        <img src="/api/placeholder/400/200" alt="Fumigación">
                        <span class="priority-badge priority-important">Importante</span>
                    </div>
                    <div class="announcement-content">
                        <h3 class="announcement-title">Fumigación General</h3>
                        <div class="announcement-date">01/05/2025</div>
                        <p class="announcement-description">Se realizará una fumigación general en las áreas comunes el próximo lunes 19 de mayo a partir de las 7:00 AM. Recomendamos mantener puertas y ventanas cerradas durante el proceso.</p>
                        <div class="announcement-actions">
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
            const announcementForm = document.getElementById('announcementForm');
            const imageInput = document.getElementById('image');
            const fileName = document.getElementById('fileName');
            
            // Mostrar formulario
            showFormBtn.addEventListener('click', function() {
                announcementForm.style.display = 'block';
                showFormBtn.style.display = 'none';
            });
            
            // Ocultar formulario
            function hideForm() {
                announcementForm.style.display = 'none';
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