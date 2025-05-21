<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador - Portal Residencial La Quinta</title>
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
        
        .dashboard-header {
            margin-bottom: 30px;
        }
        
        .dashboard-header h2 {
            color: var(--primary-color);
            font-size: 24px;
            margin-bottom: 10px;
        }
        
        .dashboard-header p {
            color: var(--dark-color);
        }
        
        .dashboard-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
        }
        
        .dashboard-card {
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
        
        .view-all {
            color: var(--accent-color);
            text-decoration: none;
            font-size: 14px;
        }
        
        .view-all:hover {
            text-decoration: underline;
        }
        
        /* Pending Users */
        .user-request {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid var(--gray-color);
        }
        
        .user-info {
            flex: 1;
        }
        
        .user-name {
            font-weight: 500;
            color: var(--dark-color);
            margin-bottom: 5px;
        }
        
        .user-details {
            display: flex;
            color: #666;
            font-size: 14px;
        }
        
        .user-details span {
            margin-right: 20px;
        }
        
        .user-actions {
            display: flex;
            gap: 10px;
        }
        
        .btn {
            padding: 8px 16px;
            border-radius: 4px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s;
        }
        
        .btn-approve {
            background-color: var(--success-color);
            color: white;
        }
        
        .btn-approve:hover {
            background-color: #218838;
        }
        
        .btn-reject {
            background-color: var(--danger-color);
            color: white;
        }
        
        .btn-reject:hover {
            background-color: #c82333;
        }
        
        /* Announcements */
        .announcement {
            padding: 15px 0;
            border-bottom: 1px solid var(--gray-color);
        }
        
        .announcement:last-child {
            border-bottom: none;
        }
        
        .announcement-title {
            font-weight: 500;
            color: var(--dark-color);
            margin-bottom: 8px;
        }
        
        .announcement-meta {
            display: flex;
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }
        
        .announcement-meta span {
            margin-right: 20px;
        }
        
        .announcement-date {
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
        
        .announcement-date.urgent:before {
            background-color: var(--danger-color);
        }
        
        .announcement-date.normal:before {
            background-color: var(--warning-color);
        }
        
        .announcement-content {
            color: #444;
            line-height: 1.5;
        }
        
        /* Dashboard Stats */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 20px;
            text-align: center;
        }
        
        .stat-number {
            font-size: 36px;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 10px;
        }
        
        .stat-title {
            color: #666;
            font-size: 16px;
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
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
            
            .stats-grid {
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
            
            .stats-grid {
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
                    <img src="Img/logoarreglado.jpg" alt="Logo La Quinta">
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
            <a href="admin_inicio.php" class="nav-item active">Inicio</a>
            <a href="residentes.php" class="nav-item">Residentes</a>
            <a href="admin_anuncios.php" class="nav-item">Anuncios</a>
            <a href="admin_servicios.php" class="nav-item">Servicios</a>
           
        </div>
    </nav>
    
    <!-- Main Content -->
    <main>
        <div class="container">
            <div class="dashboard-header">
                <h2>Panel de Administración</h2>
                <p>Bienvenido al panel de administración de Parque Residencial La Quinta.</p>
            </div>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">138</div>
                    <div class="stat-title">Residentes Activos</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">4</div>
                    <div class="stat-title">Solicitudes Pendientes</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">7</div>
                    <div class="stat-title">Anuncios Recientes</div>
                </div>
           
            </div>
            
            <div class="dashboard-grid">
                <!-- Left Column -->
                <div>
                    <!-- Pending Users -->
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h3>Usuarios Pendientes de Aprobación</h3>
                            <a href="#" class="view-all">Ver todos</a>
                        </div>
                        
                        <div class="user-request">
                            <div class="user-info">
                                <div class="user-name">Carlos Rodríguez</div>
                                <div class="user-details">
                                    <span>Apto: 14-B</span>
                                    <span>Email: carlos.rodriguez@email.com</span>
                                </div>
                            </div>
                            <div class="user-actions">
                                <button class="btn btn-approve">Aprobar</button>
                                <button class="btn btn-reject">Rechazar</button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Recent Announcements -->
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h3>Anuncios Recientes</h3>
                            <a href="#" class="view-all">Ver todos</a>
                        </div>
                        
                        <div class="announcement">
                            <div class="announcement-title">Interrupción del servicio de agua</div>
                            <div class="announcement-meta">
                                <span class="announcement-date urgent">Urgente - 12/05/2025</span>
                            </div>
                            <div class="announcement-content">
                                Estimados residentes, debido a trabajos de mantenimiento en la tubería principal, se suspenderá el servicio de agua mañana 15/05 de 9:00 AM a 3:00 PM. Por favor, tomen las precauciones necesarias. Agradecemos su comprensión.
                            </div>
                        </div>
                        
                        <div class="announcement">
                            <div class="announcement-title">Problemas con el drenaje en área común</div>
                            <div class="announcement-meta">
                                <span class="announcement-date normal">10/05/2025</span>
                            </div>
                            <div class="announcement-content">
                                Se ha detectado un problema de drenaje en la zona de la piscina después de las recientes lluvias. El área estará cerrada temporalmente mientras se realizan las reparaciones necesarias. Esperamos resolver el problema antes del fin de semana.
                            </div>
                        </div>
                        
                        <div class="announcement">
                            <div class="announcement-title">Actualización de seguridad en accesos</div>
                            <div class="announcement-meta">
                                <span class="announcement-date normal">05/05/2025</span>
                            </div>
                            <div class="announcement-content">
                                Con el objetivo de mejorar la seguridad del residencial, se instalarán nuevos lectores de tarjetas en todas las entradas. Los residentes deberán actualizar sus credenciales en la oficina administrativa antes del 20/05/2025.
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Column -->
                <div>
                    <!-- Quick Actions -->
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h3>Acciones Rápidas</h3>
                        </div>
                        
                        <div style="display: grid; gap: 15px;">
                            <button class="btn" style="background-color: var(--primary-color); color: white; width: 100%;">Crear Nuevo Anuncio</button>
                            <button class="btn" style="background-color: var(--secondary-color); color: white; width: 100%;">Enviar Notificación</button>
                        </div>
                    </div>
                    
                    <!-- Recent Activity -->
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h3>Actividad Reciente</h3>
                        </div>
                        
                        <div style="display: flex; flex-direction: column; gap: 15px;">
                            <div style="display: flex; align-items: center;">
                                <div style="width: 40px; height: 40px; border-radius: 50%; background-color: var(--gray-color); display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                    <span style="color: var(--primary-color); font-weight: bold;">U</span>
                                </div>
                                <div>
                                    <div style="font-weight: 500;">Usuario aprobado</div>
                                    <div style="color: #666; font-size: 14px;">Hace 2 horas</div>
                                </div>
                            </div>
                            
                            <div style="display: flex; align-items: center;">
                                <div style="width: 40px; height: 40px; border-radius: 50%; background-color: var(--gray-color); display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                    <span style="color: var(--primary-color); font-weight: bold;">A</span>
                                </div>
                                <div>
                                    <div style="font-weight: 500;">Anuncio publicado</div>
                                    <div style="color: #666; font-size: 14px;">Hace 5 horas</div>
                                </div>
                            </div>
                      
                            </div>
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
</body>
</html>
