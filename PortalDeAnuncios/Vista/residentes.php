<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Residentes - Portal Residencial La Quinta</title>
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
        
        .residents-header {
            margin-bottom: 30px;
        }
        
        .residents-header h2 {
            color: var(--primary-color);
            font-size: 24px;
            margin-bottom: 10px;
        }
        
        .residents-header p {
            color: var(--dark-color);
        }
        
        .residents-card {
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
        
        .search-container {
            display: flex;
            margin-bottom: 20px;
        }
        
        .search-input {
            flex: 1;
            padding: 10px 15px;
            border: 1px solid var(--gray-color);
            border-radius: 4px;
            font-size: 14px;
        }
        
        .search-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 4px;
            padding: 0 20px;
            margin-left: 10px;
            cursor: pointer;
            font-weight: 500;
        }
        
        /* Table Styles */
        .residents-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .residents-table th {
            background-color: var(--gray-color);
            color: var(--dark-color);
            text-align: left;
            padding: 12px 15px;
            font-weight: 600;
        }
        
        .residents-table td {
            padding: 12px 15px;
            border-bottom: 1px solid var(--gray-color);
        }
        
        .residents-table tr:last-child td {
            border-bottom: none;
        }
        
        .residents-table tr:hover {
            background-color: var(--light-color);
        }
        
        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .status-badge.pending {
            background-color: var(--warning-color);
            color: #856404;
        }
        
        .status-badge.active {
            background-color: var(--success-color);
            color: white;
        }
        
        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 8px;
        }
        
        .btn {
            padding: 8px 16px;
            border-radius: 4px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s;
            font-size: 14px;
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
        
        .btn-view {
            background-color: var(--accent-color);
            color: white;
        }
        
        .btn-view:hover {
            background-color: #0047b3;
        }
        
        .btn-delete {
            background-color: var(--danger-color);
            color: white;
        }
        
        .btn-delete:hover {
            background-color: #c82333;
        }
        
        /* Pagination */
        .pagination {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
            gap: 5px;
        }
        
        .pagination-btn {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--gray-color);
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            color: var(--dark-color);
            background-color: white;
        }
        
        .pagination-btn.active {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
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
            .search-container {
                flex-direction: column;
            }
            
            .search-btn {
                margin-left: 0;
                margin-top: 10px;
            }
        }
        
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                text-align: center;
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
            
            .residents-table {
                display: block;
                overflow-x: auto;
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
            <a href="admin_inicio.php" class="nav-item">Inicio</a>
            <a href="residentes.php" class="nav-item active">Residentes</a>
            <a href="#" class="nav-item">Anuncios</a>
            <a href="#" class="nav-item">Servicios</a>
        </div>
    </nav>
    
    <!-- Main Content -->
    <main>
        <div class="container">
            <div class="residents-header">
                <h2>Gestión de Residentes</h2>
                <p>Administra los residentes del Parque Residencial La Quinta.</p>
            </div>
            
            <!-- Pending Residents -->
            <div class="residents-card">
                <div class="card-header">
                    <h3>Residentes Pendientes de Aprobación</h3>
                </div>
                
                <table class="residents-table">
                    <thead>
                        <tr>
                            <th>Nombre Completo</th>
                            <th>Apartamento</th>
                            <th>Correo Electrónico</th>
                            <th>Fecha Solicitud</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Carlos Rodríguez</td>
                            <td>14-B</td>
                            <td>carlos.rodriguez@email.com</td>
                            <td>10/05/2025</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-approve">Aprobar</button>
                                    <button class="btn btn-reject">Rechazar</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>María González</td>
                            <td>23-A</td>
                            <td>maria.gonzalez@email.com</td>
                            <td>11/05/2025</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-approve">Aprobar</button>
                                    <button class="btn btn-reject">Rechazar</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>José Mendoza</td>
                            <td>8-C</td>
                            <td>jose.mendoza@email.com</td>
                            <td>12/05/2025</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-approve">Aprobar</button>
                                    <button class="btn btn-reject">Rechazar</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Ana Hernández</td>
                            <td>17-D</td>
                            <td>ana.hernandez@email.com</td>
                            <td>14/05/2025</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-approve">Aprobar</button>
                                    <button class="btn btn-reject">Rechazar</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- All Residents -->
            <div class="residents-card">
                <div class="card-header">
                    <h3>Todos los Residentes</h3>
                </div>
                
                <div class="search-container">
                    <input type="text" class="search-input" placeholder="Buscar por nombre, apartamento o correo...">
                    <button class="search-btn">Buscar</button>
                </div>
                
                <table class="residents-table">
                    <thead>
                        <tr>
                            <th>Nombre Completo</th>
                            <th>Apartamento</th>
                            <th>Correo Electrónico</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Alejandro Pérez</td>
                            <td>5-A</td>
                            <td>alejandro.perez@email.com</td>
                            <td><span class="status-badge active">Activo</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-view">Ver</button>
                                    <button class="btn btn-delete">Eliminar</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Sofía Ramírez</td>
                            <td>10-B</td>
                            <td>sofia.ramirez@email.com</td>
                            <td><span class="status-badge active">Activo</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-view">Ver</button>
                                    <button class="btn btn-delete">Eliminar</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Daniel Torres</td>
                            <td>15-C</td>
                            <td>daniel.torres@email.com</td>
                            <td><span class="status-badge active">Activo</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-view">Ver</button>
                                    <button class="btn btn-delete">Eliminar</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Valentina Morales</td>
                            <td>20-A</td>
                            <td>valentina.morales@email.com</td>
                            <td><span class="status-badge active">Activo</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-view">Ver</button>
                                    <button class="btn btn-delete">Eliminar</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Gabriel Lara</td>
                            <td>25-D</td>
                            <td>gabriel.lara@email.com</td>
                            <td><span class="status-badge active">Activo</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-view">Ver</button>
                                    <button class="btn btn-delete">Eliminar</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Isabella Soto</td>
                            <td>12-B</td>
                            <td>isabella.soto@email.com</td>
                            <td><span class="status-badge active">Activo</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-view">Ver</button>
                                    <button class="btn btn-delete">Eliminar</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Mateo Vásquez</td>
                            <td>7-C</td>
                            <td>mateo.vasquez@email.com</td>
                            <td><span class="status-badge active">Activo</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-view">Ver</button>
                                    <button class="btn btn-delete">Eliminar</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Camila Rivera</td>
                            <td>18-A</td>
                            <td>camila.rivera@email.com</td>
                            <td><span class="status-badge active">Activo</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-view">Ver</button>
                                    <button class="btn btn-delete">Eliminar</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Javier Mendoza</td>
                            <td>3-D</td>
                            <td>javier.mendoza@email.com</td>
                            <td><span class="status-badge active">Activo</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-view">Ver</button>
                                    <button class="btn btn-delete">Eliminar</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Lucía Fernández</td>
                            <td>21-B</td>
                            <td>lucia.fernandez@email.com</td>
                            <td><span class="status-badge active">Activo</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-view">Ver</button>
                                    <button class="btn btn-delete">Eliminar</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <div class="pagination">
                    <button class="pagination-btn">«</button>
                    <button class="pagination-btn active">1</button>
                    <button class="pagination-btn">2</button>
                    <button class="pagination-btn">3</button>
                    <button class="pagination-btn">»</button>
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