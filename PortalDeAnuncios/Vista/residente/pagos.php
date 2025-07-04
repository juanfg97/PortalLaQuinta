<?php
session_start();
if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'residente') {
    session_destroy();
    header('Location: /PortalDeAnuncios/index.php');
    exit();
}
include  '../../Controlador/conexion_bd_login.php'; 

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagos - Portal Presidente - La Quinta</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/inicio.css">
    <link rel="stylesheet" href="../css/pagos2.css">
    <link rel="shortcut icon" href="../Img/favicon.png" type="image/x-icon">
    
</head>
<body>
   <header class="main-header">
        <div class="container">
            <!-- Móvil: Header reorganizado -->
            <div class="d-md-none">
                <div class="header-top">
                    <div class="logo-section">
                        <div class="logo-image">
                            <img src="../Img/logo.png" alt="Logo La Quinta">
                        </div>
                        <div class="logo-text">
                            <h1>LA QUINTA</h1>
                            <span>Portal Residente</span>
                        </div>
                    </div>
                    <button class="mobile-menu-toggle" id="mobileMenuToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                
                <div class="user-info-mobile">
                    <h5>Bienvenido <?php   echo $_SESSION['nombre_completo']; ?></h5>
                    <a href="../../Controlador/funciones/logout.php" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-sign-out-alt me-1"></i>Cerrar Sesión
                    </a>
                </div>
            </div>

            <!-- Desktop: Header original -->
            <div class="row align-items-center d-none d-md-flex">
                <div class="col-md-6">
                    <div class="logo-section">
                        <div class="logo-image">
                            <img src="../Img/logo.png" alt="Logo La Quinta">
                        </div>
                        <div class="logo-text">
                            <h1>LA QUINTA</h1>
                            <span>Portal Residente</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="user-info">
                        <h5>Bienvenido <?php   echo $_SESSION['nombre_completo']; ?> </h5>
                        <div class="mt-2">
                            <a href="../../Controlador/funciones/logout.php" class="btn btn-outline-primary btn-sm">
                                Cerrar Sesión
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="main-nav" id="mainNav">
        <div class="container">
            <ul class="nav nav-pills flex-column flex-md-row">
                <li class="nav-item">
                    <a class="nav-link " href="inicio.php" onclick="closeMenu()">
                        
                        <span class="nav-text">  Inicio</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="anunciog.php" onclick="closeMenu()">
                        
                        <span class="nav-text">  Anuncios</span>
                    </a>
                </li>
                   <li class="nav-item">
                    <a class="nav-link" href="informacionEdificio.php" onclick="closeMenu()">
                        
                        <span class="nav-text">  Información edificio</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pagos.php" onclick="closeMenu()">
                        
                        <span class="nav-text">  Pagos</span>
                    </a>
                </li>
            
                  <li class="nav-item">
                    <a class="nav-link" href="servicios.php" onclick="closeMenu()">
                    
                        <span class="nav-text">  Servicios</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="configuracion.php" onclick="closeMenu()">
                        
                        <span class="nav-text">  Configuración</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>


    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <!-- Page Header -->
            <div class="welcome-section">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2><i class="fas fa-money-bill-wave me-3"></i>Gestión de Pagos</h2>
                        <p>Registra tus pagos de condominio del Edificio <?php echo $_SESSION['Terraza'].$_SESSION['Edificio']; ?>. Puedes agregar deudas, revisar el estado de pagos y aprobar comprobantes.</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <button class="btn btn-light btn-lg" data-bs-toggle="modal" data-bs-target="#registerPaymentModal">
                            <i class="fas fa-plus me-2"></i>Agregar pago
                        </button>
                    </div>
                </div>
            </div>

            <!-- Dashboard Cards -->
            <div class="row mb-4">
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <div class="card-indicator indicator-pagos">Bs</div>
                            <span class="card-title">Deuda Pendiente</span>
                        </div>
                        <div class="card-content">
                            <div class="stat-number text-warning">
                                <?php include '../../Controlador/funciones/cantidadDeudas.php';
                                
                                $pendientes = obtenerCantidadDeudasPorEstado('pendiente');
                                echo $pendientes; 
                                ?>
                                
                            </div>
                             <div class="stat-label">Pendiente</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <div class="card-indicator indicator-servicios">...</div>
                            <span class="card-title">Pagos en espera </span>
                        </div>
                        <div class="card-content">
                            <div class="stat-number text-success">
                                   <?php 
                              $enProceso = obtenerCantidadDeudasPorEstado('en proceso');
                              echo $enProceso; 
                                ?>
                            </div>
                            <div class="stat-label">En Proceso</div>
                        </div>
                    </div>
                </div>
             

            </div>
            
            
            
<?php include '../../Controlador/funciones/mostrardeuda.php';  ?>    

<!-- Sección de Deudas Mejorada -->
<div class="row mb-4">
    <div class="col-12">
        <div class="payment-card">
            <div class="payment-card-header d-flex justify-content-between align-items-center">
                <h4><i class="fas fa-exclamation-triangle me-2 text-warning"></i>Deudas Pendientes por Pagar</h4>
                <div class="d-flex gap-2">
                    <span class="badge bg-warning text-dark">
                        <i class="fas fa-clock me-1"></i>
                        <?php 
                        $deudas_pendientes = array_filter($deudas ?? [], function($d) {
                            return in_array($d['estado'], ['pendiente', 'en proceso']);
                        });
                        $total_deudas = count($deudas_pendientes);
                        echo $total_deudas . ' pendiente' . ($total_deudas != 1 ? 's' : '');
                        ?>
                    </span>
                    <button class="btn btn-sm btn-outline-primary" onclick="location.reload()">
                        <i class="fas fa-sync-alt me-1"></i>Actualizar
                    </button>
                </div>
            </div>
            
            <div class="payment-card-body p-0">
                <?php if ($total_deudas > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <?php
                            $contador = 1;
                            $total_deuda = 0;

                            // Mostrar columna "Motivo" si alguna deuda aplicable tiene motivo no vacío
                            $mostrarMotivo = false;
                            foreach ($deudas_pendientes as $d) {
                                if (!empty($d['Motivo'])) {
                                    $mostrarMotivo = true;
                                    break;
                                }
                            }
                            ?>
                            <thead class="table-primary">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th><i class="fas fa-tag me-2"></i>Concepto</th>
                                    <th class="text-center"><i class="fas fa-dollar-sign me-2"></i>Monto</th>
                                    <th class="text-center"><i class="fas fa-calendar-alt me-2"></i>Vencimiento</th>
                                    <th><i class="fas fa-info-circle me-2"></i>Descripción</th>
                                    <?php if ($mostrarMotivo): ?>
                                        <th><i class="fas fa-comment-dots me-2"></i>Motivo</th>
                                    <?php endif; ?>
                                    <th class="text-center">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($deudas_pendientes as $deuda):
                                    $monto = floatval($deuda['monto']);
                                    if (in_array($deuda['estado'], ['pendiente', 'en proceso'])) {
                                        $total_deuda += $monto;
                                    }

                                    $fecha_vencimiento = new DateTime($deuda['fecha_vencimiento']);
                                    $fecha_actual = new DateTime();
                                    $esta_vencida = $fecha_vencimiento < $fecha_actual;
                                    $dias_vencida = $esta_vencida ? $fecha_actual->diff($fecha_vencimiento)->days : 0;
                                ?>
                                <tr class="<?= $esta_vencida ? 'table-danger' : '' ?>">
                                    <td class="text-center fw-bold"><?= $contador++ ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="concept-icon me-2">
                                                <?php 
                                                    switch(strtolower($deuda['tipo_deuda'])) {
                                                        case 'condominio':
                                                        case 'condominio mensual':
                                                            echo '<i class="fas fa-home text-primary"></i>';
                                                            break;
                                                        case 'otros':
                                                            echo '<i class="fas fa-star text-info"></i>';
                                                            break;
                                                        default:
                                                            echo '<i class="fas fa-file-invoice-dollar text-secondary"></i>';
                                                    }
                                                ?>
                                            </div>
                                            <div>
                                                <strong><?= htmlspecialchars($deuda['tipo_deuda']) ?></strong>
                                                <?php if ($esta_vencida): ?>
                                                    <br><small class="text-danger"><i class="fas fa-clock me-1"></i>Vencida hace <?= $dias_vencida ?> día<?= $dias_vencida != 1 ? 's' : '' ?></small>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-<?= $esta_vencida ? 'danger' : 'success' ?> fs-6 px-3 py-2">
                                            Bs<?= number_format($monto, 2) ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <?= date('d/m/Y', strtotime($deuda['fecha_vencimiento'])) ?>
                                        <?php if ($esta_vencida): ?>
                                            <br><small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Vencida</small>
                                        <?php else: 
                                            $dias_restantes = $fecha_actual->diff($fecha_vencimiento)->days;
                                            if ($dias_restantes <= 7): ?>
                                                <br><small class="text-warning"><i class="fas fa-clock"></i> <?= $dias_restantes ?> día<?= $dias_restantes != 1 ? 's' : '' ?></small>
                                            <?php endif;
                                        endif; ?>
                                    </td>
                                    <td>
                                        <?php 
                                        $descripcion = htmlspecialchars($deuda['descripcion']);
                                        echo $descripcion ? (strlen($descripcion) > 60 
                                            ? '<span title="' . $descripcion . '">' . substr($descripcion, 0, 60) . '...</span>' 
                                            : $descripcion) 
                                            : '<em class="text-muted">Sin descripción</em>';
                                        ?>
                                    </td>
                                    <?php if ($mostrarMotivo): ?>
                                    <td>
                                        <?= !empty($deuda['Motivo']) 
                                            ? '<span class="text-danger"><i class="fas fa-exclamation-circle me-1"></i>' . htmlspecialchars($deuda['Motivo']) . '</span>' 
                                            : '<span class="text-muted">-</span>'; ?>
                                    </td>
                                    <?php endif; ?>
                                    <td class="text-center">
                                        <?php if ($deuda['estado'] === 'en proceso'): ?>
                                            <span class="badge bg-info text-white"><i class="fas fa-spinner fa-spin me-1"></i> En proceso</span>
                                        <?php elseif ($deuda['estado'] === 'pendiente'): ?>
                                            <span class="badge bg-danger"><i class="fas fa-clock me-1"></i> Pendiente</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <td colspan="2" class="text-end fw-bold">Total Deuda Pendiente:</td>
                                    <td class="text-center">
                                        <span class="badge bg-danger fs-5 px-3 py-2">
                                            Bs<?= number_format($total_deuda, 2) ?>
                                        </span>
                                    </td>
                                    <td colspan="<?= $mostrarMotivo ? '4' : '3' ?>"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="empty-state text-center py-5">
                        <div class="empty-icon mb-3">
                            <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                        </div>
                        <h5 class="text-success mb-2">¡Excelente!</h5>
                        <p class="text-muted mb-3">No tienes deudas pendientes por pagar</p>
                        <div class="alert alert-success d-inline-block">
                            <i class="fas fa-info-circle me-2"></i>
                            Estás al día con tus pagos de condominio
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ($total_deudas > 0): ?>
            <div class="payment-card-footer">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            Las deudas vencidas pueden generar intereses adicionales
                        </small>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

            
                <!-- Cuentas Bancarias -->
                <div class="col-lg-6">
                    <div class="payment-card">
                        <div class="payment-card-header">
                            <h4><i class="fas fa-university me-2"></i>Cuentas Bancarias</h4>
                        </div>
                        <div class="payment-card-body">
                            <div class="debt-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1"><i class="fas fa-credit-card me-2"></i>Banco Venezuela</h6>
                                        <small class="text-muted">Cuenta Corriente</small>
                                    </div>
                                    <div class="text-end">
                                        <strong>0102-1234-5678-9012</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="debt-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1"><i class="fas fa-credit-card me-2"></i>Banesco</h6>
                                        <small class="text-muted">Cuenta Corriente</small>
                                    </div>
                                    <div class="text-end">
                                        <strong>0134-9876-5432-1098</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="debt-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1"><i class="fas fa-mobile-alt me-2"></i>Pago Móvil</h6>
                                        <small class="text-muted">Banesco</small>
                                    </div>
                                    <div class="text-end">
                                        <strong>0424-1234567</strong><br>
                                        <small>CI: V-12345678</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

           
        </div>
    </main>

   

 <!-- Modal Registrar Pago -->
<div class="modal fade modal-payment" id="registerPaymentModal" tabindex="-1" aria-labelledby="registerPaymentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="registerPaymentModalLabel">
          <i class="fas fa-credit-card me-2"></i>Registrar Pago de Condominio
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form id="paymentForm">
         <!-- Información del Pago -->
<div class="form-section">
  <div class="section-title">
    <i class="fas fa-info-circle"></i> Información del Pago
  </div>

  <!-- Pago a Realizar -->
  <div class="mb-3">
    <label for="debtSelect" class="form-label">Pago a Realizar</label>
    <select class="form-select" id="debtSelect" name="debtId" required>
        <option value="">Seleccione una deuda</option>
        <?php
        if (isset($deudas) && count($deudas) > 0) {
            foreach ($deudas as $deuda) {
                if ($deuda['estado'] !== 'pendiente') continue; // Filtrar solo pendientes

                $id = $deuda['id'];
                $tipo = htmlspecialchars($deuda['tipo_deuda']);
                $descripcion = htmlspecialchars($deuda['descripcion']);
                $monto = number_format($deuda['monto'], 2, '.', '');
                echo "<option value=\"$id\" data-monto=\"$monto\">$tipo - $descripcion</option>";
            }
        }
        ?>
    </select>
</div>


  <!-- Monto del Pago -->
  <div class="amount-display">
    <div class="amount-label">Monto a Pagar</div>
    <div class="amount-value" id="paymentAmount">Bs0.00</div>
  </div>
  <input type="hidden" id="hiddenPaymentAmount" name="paymentAmount" value="0">
</div>


          <!-- Método de Pago -->
          <div class="form-section">
            <div class="section-title">
              <i class="fas fa-university"></i> Método de Pago
            </div>
            <div class="mb-3">
              <label for="paymentMethodSelect" class="form-label">Selecciona Método de Pago</label>
              <select class="form-select" id="paymentMethodSelect" name="paymentMethodSelect" required>
                <option value="">Seleccionar método</option>
                <option value="transferencia">Transferencia</option>
                <option value="pago_movil">Pago Móvil</option>
              </select>
            </div>
          </div>

       <!-- Datos del Pago -->
<div class="form-section">
  <div class="section-title">
    <i class="fas fa-receipt"></i> Datos del Pago Realizado
  </div>
  <div class="row">
    <!-- Campos comunes -->
     <div class="mb-3">
    <label for="cedulaInput" class="form-label">Número de Cedula</label>
    <input type="text" id="cedulaInput" name="cedulaNumber" class="form-control" placeholder="Ej: V-" required>
  </div>
    <div class="col-md-6">
      <div class="mb-3">
        <label for="paymentDate" class="form-label">Fecha del Pago</label>
        <input type="date" id="paymentDate" name="paymentDate" class="form-control" required>
      </div>
    </div>

    <div class="col-md-6">
      <div class="mb-3">
        <label for="bankOrigin" class="form-label">Banco Origen</label>
        <input type="text" id="bankOrigin" name="bankOrigin" class="form-control" placeholder="Banco desde donde se realizó el pago" required>
      </div>
    </div>
  </div>

  
  <div class="mb-3">
    <label for="phoneNumberInput" class="form-label">Número de Teléfono</label>
    <input type="text" id="phoneNumberInput" name="phoneNumber" class="form-control" placeholder="Ej: 04241234567" required>
  </div>
<div class="mb-3">
    <label for="referenceNumberInput" class="form-label">Número de Referencia</label>
    <input type="text" id="referenceNumberInput" name="referenceNumber" class="form-control" placeholder="Ej: 123456789" required>
  </div>

  <!-- Monto Pagado (común) -->
  <div class="row">
    <div class="col-md-6">
      <div class="mb-3">
        <label for="paidAmountInput" class="form-label">Monto Pagado</label>
        <div class="input-group">
          <span class="input-group-text">Bs</span>
          <input type="number" step="0.01" id="paidAmountInput" name="paidAmount" class="form-control" placeholder="0.00" required>
        </div>
      </div>
    </div>
  </div>

  <!-- Comentarios opcionales -->
  <div class="mb-3">
    <label for="commentsInput" class="form-label">Comentarios (Opcional)</label>
    <textarea id="commentsInput" name="comments" class="form-control" rows="2" placeholder="Información adicional sobre el pago..."></textarea>
  </div>
</div>

          <!-- Comprobante de Pago -->
          <div class="form-section">
            <div class="section-title">
              <i class="fas fa-file-image"></i> Comprobante de Pago
            </div>
            <div class="file-upload-area" id="fileUploadArea">
              <div class="file-upload-icon">
                <i class="fas fa-cloud-upload-alt"></i>
              </div>
              <div class="file-upload-text">Arrastra tu comprobante aquí</div>
              <div class="file-upload-subtext">o haz clic para seleccionar archivo</div>
              <input type="file" id="fileInput" name="paymentReceipt" accept="image/*,.pdf" style="display: none;">
            </div>
            <div id="uploadedFiles"></div>
          </div>

          <!-- Footer buttons -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              <i class="fas fa-times me-2"></i>Cancelar
            </button>

                 <button type="submit" class="btn btn-primary" id="registerPaymentButton">  <i class="fas fa-paper-plane me-2"></i>Registrar Pago</button>


         
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

    <!-- Footer -->
    <footer class="main-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    LA QUINTA - Parque Residencial
                </div>
                <div class="footer-contact">
                    <span><i class="bi bi-geo-alt"></i> Av. Víctor Baptista, Los Teques</span>
                    <span><i class="bi bi-telephone"></i> Tel: (032) 31.1221</span>
                </div>
            </div>
        </div>
    </footer>
                
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../Modelo/js/menuHamburguesa.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    
    <script>
        
document.addEventListener('DOMContentLoaded', function() {
    // Elementos del DOM
    const paymentTypeSelect = document.getElementById('paymentType');
    const paymentAmountDisplay = document.getElementById('paymentAmount');
    const paymentMethodCards = document.querySelectorAll('.payment-method-card');
    const accountInfo = document.getElementById('accountInfo');
    const accountDetails = document.getElementById('accountDetails');
    const referenceNumber = document.getElementById('referenceNumber');
    const fileUploadArea = document.getElementById('fileUploadArea');
    const fileInput = document.getElementById('fileInput');
    const uploadedFiles = document.getElementById('uploadedFiles');
    const paymentForm = document.getElementById('paymentForm');
    const paymentMethodSelect = document.getElementById('paymentMethodSelect');
    const transferenciaFields = document.getElementById('transferenciaFields');
    const pagoMovilFields = document.getElementById('pagoMovilFields');
    const debtSelect = document.getElementById('debtSelect');
    const hiddenPaymentAmount = document.getElementById('hiddenPaymentAmount');

    // CORREGIR: Manejar el cambio de selección de deuda
    if (debtSelect && paymentAmountDisplay && hiddenPaymentAmount) {
        debtSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            
            if (selectedOption && selectedOption.value) {
                const monto = selectedOption.getAttribute('data-monto');
                
                if (monto) {
                    const montoFormateado = parseFloat(monto).toFixed(2);
                    paymentAmountDisplay.textContent = `Bs${montoFormateado}`;
                    hiddenPaymentAmount.value = monto;
                    
                    // También actualizar el campo de monto pagado
                    const paidAmountInput = document.getElementById('paidAmountInput');
                    if (paidAmountInput) {
                        paidAmountInput.value = montoFormateado;
                    }
                } else {
                    paymentAmountDisplay.textContent = 'Bs0.00';
                    hiddenPaymentAmount.value = '0';
                }
            } else {
                paymentAmountDisplay.textContent = 'Bs0.00';
                hiddenPaymentAmount.value = '0';
                
                // Limpiar el campo de monto pagado
                const paidAmountInput = document.getElementById('paidAmountInput');
                if (paidAmountInput) {
                    paidAmountInput.value = '';
                }
            }
            
            console.log('Deuda seleccionada:', selectedOption.value);
            console.log('Monto:', selectedOption.getAttribute('data-monto'));
        });
    }

    // === MANEJO DE ARCHIVOS ===
    if (fileUploadArea && fileInput) {
        fileUploadArea.addEventListener('click', function(e) {
            if (e.target !== fileInput) {
                e.preventDefault();
                e.stopPropagation();
                fileInput.click();
            }
        });

        fileInput.addEventListener('click', function(e) {
            e.stopPropagation();
        });

        fileUploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            e.stopPropagation();
            this.classList.add('dragover');
        });

        fileUploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            e.stopPropagation();
            if (!this.contains(e.relatedTarget)) {
                this.classList.remove('dragover');
            }
        });

        fileUploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            e.stopPropagation();
            this.classList.remove('dragover');

            const files = e.dataTransfer.files;
            handleFiles(files);
        });

        fileInput.addEventListener('change', function(e) {
            handleFiles(this.files);
        });
    }

    // === MANEJO DEL FORMULARIO ===
    if (paymentForm) {
        paymentForm.addEventListener('submit', function (e) {
            e.preventDefault();

            // Validar selección de deuda
            if (!debtSelect.value) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Deuda no seleccionada',
                    text: 'Por favor selecciona una deuda para pagar.'
                });
                return;
            }

            // Validar monto oculto
            const montoPagado = hiddenPaymentAmount.value.trim();
            if (!/^\d+(\.\d{2})?$/.test(montoPagado) || montoPagado === '0' || montoPagado === '0.00') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Monto inválido',
                    text: 'El monto debe ser un número decimal válido mayor a 0.'
                });
                return;
            }

            // Cédula
            const cedulaInput = document.getElementById('cedulaInput');
            const cedulaValue = cedulaInput.value.trim();
            const cedulaPattern = /^[VEJ]-\d{6,9}$/i;
            if (!cedulaPattern.test(cedulaValue)) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Número de cédula inválido',
                    text: 'Formato válido: V-12345678, E-1234567, J-123456789.'
                });
                return;
            }

            // Método de pago
            if (!paymentMethodSelect.value) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Método de pago',
                    text: 'Por favor selecciona un método de pago.'
                });
                return;
            }

            // Comprobante
            if (!uploadedFiles || uploadedFiles.children.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Comprobante requerido',
                    text: 'Por favor sube el comprobante de pago.'
                });
                return;
            }

            // Fecha de pago
            const paymentDate = document.getElementById('paymentDate').value;
            if (!paymentDate) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Fecha de pago',
                    text: 'Por favor ingresa la fecha del pago.'
                });
                return;
            }

            // Banco origen
            const bankOrigin = document.getElementById('bankOrigin').value.trim();
            if (!bankOrigin) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Banco Origen',
                    text: 'Por favor ingresa el banco desde donde se realizó el pago.'
                });
                return;
            }

            // Teléfono
            const phoneInput = document.getElementById('phoneNumberInput');
            const phoneValue = phoneInput.value.trim();
       if (!/^\d{10,15}$/.test(phoneValue)) {
    Swal.fire({
        icon: 'warning',
        title: 'Número de teléfono inválido',
        text: 'Debe contener entre 10 y 15 dígitos numéricos.'
    });
    return;
}

            // Referencia
            const referenceInput = document.getElementById('referenceNumberInput');
            const referenceValue = referenceInput.value.trim();
            if (!/^\d{13}$/.test(referenceValue)) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Número de referencia inválido',
                    text: 'Debe contener exactamente 13 dígitos numéricos.'
                });
                return;
            }

            // Monto pagado visible
            const paidAmountInput = document.getElementById('paidAmountInput');
            const paidAmountValue = paidAmountInput.value.trim();
            if (!/^\d+(\.\d{2})?$/.test(paidAmountValue)) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Monto pagado inválido',
                    text: 'Debe ser un número decimal válido. Ej: 100.00'
                });
                return;
            }

            // Comentario
            const comments = document.getElementById('commentsInput').value.trim();

            // Crear FormData
            const formData = new FormData();
            formData.append('paymentMethod', paymentMethodSelect.value);
            formData.append('debtId', debtSelect.value);
            formData.append('paymentDate', paymentDate);
            formData.append('bankOrigin', bankOrigin);
            formData.append('phoneNumber', phoneValue);
            formData.append('referenceNumber', referenceValue);
            formData.append('paidAmount', paidAmountValue);
            formData.append('comments', comments);
            formData.append('cedulaInput', cedulaValue);
            if (fileInput.files.length > 0) {
                formData.append('comprobante', fileInput.files[0]);
            }

            // Mostrar formData en consola
            for (const pair of formData.entries()) {
                if (pair[0] === 'comprobante') {
                    console.log(pair[0] + ': ', pair[1].name);
                } else {
                    console.log(pair[0] + ': ' + pair[1]);
                }
            }

            // Confirmación de impresión
            Swal.fire({
                title: '¿Deseas imprimir el resumen del pago?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Sí, imprimir',
                cancelButtonText: 'No, continuar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Obtener usuario desde PHP
                    const userName = "<?php echo $_SESSION['usuario']; ?>";

                    const ventana = window.open('', '', 'width=1000,height=800');
                    ventana.document.write(`
                        <html>
                        <head>
                            <title>Resumen del Pago</title>
                            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
                            <style>
                                body {
                                    font-family: Arial, sans-serif;
                                    padding: 40px;
                                    background-color: #f8f9fa;
                                }
                                h2 {
                                    text-align: center;
                                    margin-bottom: 30px;
                                }
                                .table th {
                                    background-color: #343a40;
                                    color: white;
                                }
                                .table td, .table th {
                                    padding: 10px;
                                    border: 1px solid #dee2e6;
                                }
                                .footer {
                                    margin-top: 40px;
                                    text-align: center;
                                    font-size: 0.85rem;
                                    color: #666;
                                }
                                img.logo {
                                    display: block;
                                    margin: 0 auto 20px auto;
                                    max-width: 150px;
                                }
                            </style>
                        </head>
                        <body>
                            <img src="../../Vista/img/logo.png" alt="Logo" class="logo">
                            <h2>Resumen del Pago Registrado</h2>
                            <table class="table table-bordered">
                                <tr><th>Usuario</th><td>${userName}</td></tr>
                                <tr><th>Cédula</th><td>${cedulaValue}</td></tr>
                                <tr><th>Deuda</th><td>${debtSelect.options[debtSelect.selectedIndex].text}</td></tr>
                                <tr><th>Monto Total</th><td>${paidAmountValue} Bs</td></tr>
                                <tr><th>Fecha de Pago</th><td>${paymentDate}</td></tr>
                                <tr><th>Método de Pago</th><td>${paymentMethodSelect.options[paymentMethodSelect.selectedIndex].text}</td></tr>
                                <tr><th>Banco Origen</th><td>${bankOrigin}</td></tr>
                                <tr><th>Teléfono</th><td>${phoneValue}</td></tr>
                                <tr><th>Referencia</th><td>${referenceValue}</td></tr>
                                <tr><th>Comentario</th><td>${comments}</td></tr>
                            </table>
                            <div class="footer">Comprobante generado automáticamente — Sistema de Pagos</div>
                            <script>
                                window.onload = function() {
                                    window.print();
                                    window.onafterprint = () => window.close();
                                }
                            <\/script>
                        </body>
                        </html>
                    `);

                    enviarFormularioYRecargar();
                } else {
                    enviarFormularioYRecargar();
                }
            });

            // Función para enviar y recargar
            function enviarFormularioYRecargar() {
                fetch('../../Controlador/formularios/registrarpago.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Pago registrado',
                            text: result.message || 'El pago fue registrado exitosamente.'
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: result.message || 'Ocurrió un error al registrar el pago.'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error al enviar el formulario:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No se pudo enviar el formulario. Intenta nuevamente.'
                    });
                });
            }
        });
    }
});

// === FUNCIONES GLOBALES PARA MANEJO DE ARCHIVOS ===

function handleFiles(files) {
    if (!files || files.length === 0) {
        return;
    }

    const uploadedFiles = document.getElementById('uploadedFiles');
    if (uploadedFiles) {
        uploadedFiles.innerHTML = '';
    }

    // Solo tomar el primer archivo válido
    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        if (isValidFileType(file)) {
            displayUploadedFile(file);
            break;  // salir después de mostrar el primer válido
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Archivo no válido',
                text: `Archivo "${file.name}" no es válido. Solo se permiten imágenes (JPG, PNG, GIF) y archivos PDF.`,
            });
            break;  // si el primero no es válido, no continuar
        }
    }
}

function isValidFileType(file) {
    const validTypes = [
        'image/jpeg',
        'image/jpg', 
        'image/png',
        'image/gif',
        'application/pdf'
    ];
    return validTypes.includes(file.type);
}

function displayUploadedFile(file) {
    const uploadedFiles = document.getElementById('uploadedFiles');
    if (!uploadedFiles) return;

    const fileDiv = document.createElement('div');
    fileDiv.className = 'uploaded-file d-flex justify-content-between align-items-center p-3 mb-2 border rounded bg-light';

    const fileSize = (file.size / 1024 / 1024).toFixed(2);
    const fileIcon = getFileIcon(file.type);

    fileDiv.innerHTML = `
        <div class="file-info d-flex align-items-center">
            <div class="file-icon me-3">
                <i class="fas ${fileIcon} fa-2x text-primary"></i>
            </div>
            <div class="file-details">
                <h6 class="mb-0">${file.name}</h6>
                <small class="text-muted">${fileSize} MB</small>
            </div>
        </div>
        <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeFile(this)">
            <i class="fas fa-trash"></i>
        </button>
    `;

    uploadedFiles.appendChild(fileDiv);
    updateUploadAreaText(true);
}

function getFileIcon(fileType) {
    if (fileType.startsWith('image/')) {
        return 'fa-image';
    } else if (fileType === 'application/pdf') {
        return 'fa-file-pdf';
    }
    return 'fa-file';
}

function removeFile(button) {
    const fileDiv = button.closest('.uploaded-file');
    if (fileDiv) {
        fileDiv.remove();
    }

    const fileInput = document.getElementById('fileInput');
    if (fileInput) {
        fileInput.value = '';
    }

    const uploadedFiles = document.getElementById('uploadedFiles');
    if (uploadedFiles && uploadedFiles.children.length === 0) {
        updateUploadAreaText(false);
    }
}

function updateUploadAreaText(hasFiles) {
    const fileUploadArea = document.getElementById('fileUploadArea');
    const uploadText = fileUploadArea.querySelector('.file-upload-text');
    const uploadSubtext = fileUploadArea.querySelector('.file-upload-subtext');

    if (hasFiles) {
        if (uploadText) uploadText.textContent = 'Archivo seleccionado correctamente';
        if (uploadSubtext) uploadSubtext.textContent = 'Haz clic para cambiar archivo';
    } else {
        if (uploadText) uploadText.textContent = 'Arrastra tu comprobante aquí';
        if (uploadSubtext) uploadSubtext.textContent = 'o haz clic para seleccionar archivo';
    }
}
</script>
</body>
</html>