<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Residencial La Quinta - Inicio</title>
    <style>
        :root {
            --primary-color: #003399;
            --secondary-color: #001f5f;
            --accent-color: #0055cc;
            --light-color: #f5f8ff;
            --gray-color: #e0e5f0;
            --dark-color: #333;
            --error-color: #e74c3c;
            --success-color: #27ae60;
            --warning-color: #f39c12;
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
            height: 60px;
            width: auto;
            object-fit: contain;
        }
        
        .logo-text {
            display: flex;
            flex-direction: column;
        }
        
        .logo-text h1 {
            color: var(--primary-color);
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }
        
        .logo-text span {
            color: var(--secondary-color);
            font-size: 14px;
        }
        
        .user-info {
            display: flex;
            align-items: center;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--gray-color);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            color: var(--primary-color);
            font-weight: bold;
        }
        
        .user-details {
            display: flex;
            flex-direction: column;
        }
        
        .user-name {
            font-weight: 500;
            color: var(--dark-color);
        }
        
        .user-apartment {
            font-size: 12px;
            color: #666;
        }
        
        /* Navigation */
        nav {
            background-color: var(--primary-color);
        }
        
        .nav-container {
            display: flex;
            justify-content: space-between;
        }
        
        .nav-menu {
            display: flex;
            list-style: none;
        }
        
        .nav-menu li {
            position: relative;
        }
        
        .nav-menu a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 15px 20px;
            font-weight: 500;
            transition: background-color 0.3s;
        }
        
        .nav-menu a:hover,
        .nav-menu a.active {
            background-color: var(--secondary-color);
        }
        
        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            padding: 15px;
        }
        
        /* Main Content */
        main {
            flex: 1;
            padding: 30px 0;
        }
        
        .welcome-banner {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }
        
        .welcome-banner h2 {
            color: var(--primary-color);
            margin-bottom: 10px;
        }
        
        .welcome-banner p {
            color: var(--dark-color);
            line-height: 1.6;
        }
        
        .section-title {
            margin-bottom: 20px;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .section-title h2 {
            font-size: 24px;
        }
        
        .view-all {
            color: var(--accent-color);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
        }
        
        .view-all:hover {
            text-decoration: underline;
        }
        
        .announcements {
            margin-bottom: 30px;
        }
        
        .announcement-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        
        .announcement-card {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .announcement-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .announcement-header {
            padding: 15px;
            background-color: var(--primary-color);
            color: white;
        }
        
        .announcement-type {
            font-size: 12px;
            text-transform: uppercase;
            margin-bottom: 5px;
            color: rgba(255, 255, 255, 0.8);
        }
        
        .announcement-title {
            font-size: 18px;
            font-weight: 500;
        }
        
        .announcement-content {
            padding: 15px;
        }
        
        .announcement-description {
            color: var(--dark-color);
            margin-bottom: 15px;
            line-height: 1.5;
        }
        
        .announcement-date {
            color: #666;
            font-size: 12px;
            display: flex;
            align-items: center;
        }
        
        .announcement-date i {
            margin-right: 5px;
        }
        
        /* Quick Access */
        .quick-access {
            margin-bottom: 30px;
        }
        
        .quick-access-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }
        
        .quick-access-card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .quick-access-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .quick-access-icon {
            width: 50px;
            height: 50px;
            background-color: var(--light-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: var(--primary-color);
            font-size: 24px;
        }
        
        .quick-access-title {
            color: var(--dark-color);
            font-weight: 500;
            margin-bottom: 5px;
        }
        
        .quick-access-description {
            color: #666;
            font-size: 14px;
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
            .announcement-grid,
            .quick-access-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                text-align: center;
            }
            
            .logo {
                margin-bottom: 10px;
            }
            
            .nav-container {
                position: relative;
            }
            
            .mobile-menu-toggle {
                display: block;
            }
            
            .nav-menu {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background-color: var(--primary-color);
                z-index: 100;
            }
            
            .nav-menu.show {
                display: flex;
            }
            
            .announcement-grid,
            .quick-access-grid {
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
                    <img src="/api/placeholder/120/80" alt="Logo La Quinta">
                </div>
                <div class="logo-text">
                    <h1>LA QUINTA</h1>
                    <span>Portal Residencial</span>
                </div>
            </div>
            <div class="user-info">
                <div class="user-avatar">MR</div>
                <div class="user-details">
                    <span class="user-name">María Rodríguez</span>
                    <span class="user-apartment">Torre A - Apto 503</span>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Navigation -->
    <nav>
        <div class="container nav-container">
            <button class="mobile-menu-toggle">☰</button>
            <ul class="nav-menu">
                <li><a href="#" class="active">Inicio</a></li>
                <li><a href="#">Pagos</a></li>
                <li><a href="#">Comunicados</a></li>
                <li><a href="#">Novedades del Edificio</a></li>
                <li><a href="#">Servicios</a></li>
                <li><a href="#">Configuración</a></li>
            </ul>
        </div>
    </nav>
    
    <!-- Main Content -->
    <main>
        <div class="container">
            <!-- Welcome Banner -->
            <div class="welcome-banner">
                <h2>Bienvenido(a), María</h2>
                <p>Consulta las últimas novedades y comunicados importantes para los residentes de Parque Residencial La Quinta.</p>
            </div>
            
            <!-- Announcements Section -->
            <section class="announcements">
                <div class="section-title">
                    <h2>Comunicados Recientes</h2>
                    <a href="#" class="view-all">Ver todos</a>
                </div>
                <div class="announcement-grid">
                    <!-- Announcement Card 1 -->
                    <div class="announcement-card">
                        <div class="announcement-header">
                            <div class="announcement-type">Importante</div>
                            <h3 class="announcement-title">Corte de agua programado</h3>
                        </div>
                        <div class="announcement-content">
                            <p class="announcement-description">Se realizará un corte de agua en todo el residencial el día 22 de Mayo para mantenimiento del sistema hidráulico. Se recomienda almacenar agua para uso doméstico.</p>
                            <div class="announcement-date">
                                <i>📅</i> Publicado: 18 de Mayo, 2025
                            </div>
                        </div>
                    </div>
                    
                    <!-- Announcement Card 2 -->
                    <div class="announcement-card">
                        <div class="announcement-header">
                            <div class="announcement-type">Comunidad</div>
                            <h3 class="announcement-title">Asamblea anual de residentes</h3>
                        </div>
                        <div class="announcement-content">
                            <p class="announcement-description">La asamblea anual de residentes se llevará a cabo el próximo 25 de Mayo a las 10:00 AM en el salón de usos múltiples. Se requiere la presencia de al menos un representante por apartamento.</p>
                            <div class="announcement-date">
                                <i>📅</i> Publicado: 15 de Mayo, 2025
                            </div>
                        </div>
                    </div>
                    
                    <!-- Announcement Card 3 -->
                    <div class="announcement-card">
                        <div class="announcement-header">
                            <div class="announcement-type">Actividades</div>
                            <h3 class="announcement-title">Torneo de dominó</h3>
                        </div>
                        <div class="announcement-content">
                            <p class="announcement-description">Este sábado 24 de Mayo se realizará un torneo de dominó en el área social. Las inscripciones están abiertas hasta el viernes. Premios para los primeros lugares.</p>
                            <div class="announcement-date">
                                <i>📅</i> Publicado: 12 de Mayo, 2025
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Quick Access Section -->
            <section class="quick-access">
                <div class="section-title">
                    <h2>Accesos Rápidos</h2>
                </div>
                <div class="quick-access-grid">
                    <!-- Quick Access Card 1 -->
                    <div class="quick-access-card">
                        <div class="quick-access-icon">💰</div>
                        <h3 class="quick-access-title">Estado de Cuenta</h3>
                        <p class="quick-access-description">Consulta tu estado de cuenta actual</p>
                    </div>
                    
                    <!-- Quick Access Card 2 -->
                    <div class="quick-access-card">
                        <div class="quick-access-icon">📋</div>
                        <h3 class="quick-access-title">Registrar Visitante</h3>
                        <p class="quick-access-description">Pre-autoriza el ingreso de visitantes</p>
                    </div>
                    
                    <!-- Quick Access Card 3 -->
                    <div class="quick-access-card">
                        <div class="quick-access-icon">🏊</div>
                        <h3 class="quick-access-title">Reservar Áreas</h3>
                        <p class="quick-access-description">Reserva áreas comunes del residencial</p>
                    </div>
                    
                    <!-- Quick Access Card 4 -->
                    <div class="quick-access-card">
                        <div class="quick-access-icon">🛠️</div>
                        <h3 class="quick-access-title">Reportar Falla</h3>
                        <p class="quick-access-description">Informa sobre fallas en áreas comunes</p>
                    </div>
                </div>
            </section>
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
        // Mobile menu toggle
        document.querySelector('.mobile-menu-toggle').addEventListener('click', function() {
            document.querySelector('.nav-menu').classList.toggle('show');
        });
    </script>
</body>
</html>