<?php
// Conexión asumida en el archivo principal ($conexion)
$terraza = $_SESSION['Terraza'] ?? '';
$edificio = $_SESSION['Edificio'] ?? '';

$sql = "SELECT d.usuario, e.Terraza, e.Edificio, SUM(d.monto) AS total_deuda, COUNT(*) AS cantidad_deudas
        FROM deudas d
        JOIN edificios e ON d.usuario = e.usuario
        WHERE d.estado = 'pendiente' AND d.fecha_vencimiento < CURDATE()
          AND e.Terraza = ? AND e.Edificio = ?
        GROUP BY d.usuario
        ORDER BY d.usuario ASC";

$stmt = $conexion->prepare($sql);
$stmt->bind_param('ss', $terraza, $edificio);
$stmt->execute();
$result = $stmt->get_result();

// Variables para gráfica y totales
$usuarios = [];
$deudas = [];
$totalDeudaGeneral = 0;
$totalCantidadDeudas = 0;

$filas = [];
while ($row = $result->fetch_assoc()) {
    $usuarios[] = $row['usuario'];
    $deudas[] = (float)$row['total_deuda'];
    $totalDeudaGeneral += $row['total_deuda'];
    $totalCantidadDeudas += $row['cantidad_deudas'];
    $filas[] = $row;
}
$stmt->close();

// Función para crear gráfico HTML simple para impresión
function crearGraficoHTML($usuarios, $deudas) {
    if (empty($deudas)) return '';
    
    $maxDeuda = max($deudas);
    $html = '<div class="grafico-container">';
    $html .= '<h4 class="grafico-titulo">Distribución de Deudas por Usuario</h4>';
    $html .= '<div class="grafico-barras">';
    
    foreach ($usuarios as $index => $usuario) {
        $altura = ($deudas[$index] / $maxDeuda) * 180; // Altura máxima de 180px
        $html .= '<div class="barra-container">';
        $html .= '<div class="barra-valor">' . number_format($deudas[$index], 2) . ' Bs</div>';
        $html .= '<div class="barra" style="height: ' . $altura . 'px;"></div>';
        $html .= '<div class="barra-label">' . htmlspecialchars($usuario) . '</div>';
        $html .= '</div>';
    }
    
    $html .= '</div></div>';
    return $html;
}
?>

<div class="dashboard-card tabla-morosos">
    <div class="card-header d-flex flex-column align-items-start">
        <span class="card-title">Morosos del Edificio <?php echo htmlspecialchars($terraza.$edificio) ?></span>
        <button class="btn btn-outline-danger btn-sm no-print mt-2" onclick="printMorosos()">
            <i class="fas fa-file-pdf me-1"></i> Imprimir PDF
        </button>
    </div>

    <!-- Gráfico para pantalla -->
    <div class="grafico-pantalla" style="max-width: 700px; margin-bottom: 20px;">
        <canvas id="morososChart"></canvas>
    </div>

    <!-- Gráfico para impresión (oculto en pantalla) -->
    <div class="grafico-impresion" style="display: none;">
        <?php echo crearGraficoHTML($usuarios, $deudas); ?>
    </div>

    <div class="card-content table-responsive">
        <table class="table table-bordered table-striped text-center tabla-principal">
            <thead class="table-dark">
                <tr>
                    <th>Usuario</th>
                    <th>Deudas Pendientes</th>
                    <th>Total Deuda</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($filas as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['usuario']); ?></td>
                    <td><?php echo $row['cantidad_deudas']; ?></td>
                    <td><?php echo number_format($row['total_deuda'], 2); ?> Bs</td>
                </tr>
                <?php endforeach; ?>
                <tr class="table-secondary fw-bold">
                    <td>Total</td>
                    <td><?php echo $totalCantidadDeudas; ?></td>
                    <td><?php echo number_format($totalDeudaGeneral, 2); ?> Bs</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Gráfico para visualización en pantalla
const ctx = document.getElementById('morososChart');
if (ctx) {
    const morososChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($usuarios); ?>,
            datasets: [{
                label: 'Deuda Pendiente (Bs)',
                data: <?php echo json_encode($deudas); ?>,
                backgroundColor: 'rgba(0, 51, 153, 0.7)',
                borderColor: 'rgba(0, 51, 153, 1)',
                borderWidth: 1,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true }
            },
            plugins: { legend: { display: false } }
        }
    });
}

function printMorosos() {
    const fecha = new Date().toLocaleDateString('es-ES');
    
    // Obtener el contenido de la tabla
    const tabla = document.querySelector('.tabla-principal');
    const tablaHtml = tabla ? tabla.outerHTML : '';
    
    // Obtener el gráfico de impresión
    const graficoImpresion = document.querySelector('.grafico-impresion');
    const graficoHtml = graficoImpresion ? graficoImpresion.innerHTML : '';

    const styles = `
        <style>
        @media print {
            body { margin: 0; }
        }
        
        :root {
            --primary-color: #003399;
            --secondary-color: #001f5f;
            --accent-color: #0055cc;
            --light-color: #f5f8ff;
            --gray-color: #e0e5f0;
            --dark-color: #333;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: white;
            color: var(--dark-color);
            padding: 20px;
            line-height: 1.4;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 20px;
        }
        
        .logo {
            max-height: 80px;
            max-width: 200px;
            margin-bottom: 15px;
        }
        
        .titulo {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-color);
            margin: 10px 0;
        }
        
        .subtitulo {
            font-size: 16px;
            color: var(--dark-color);
            margin-bottom: 5px;
        }
        
        .fecha {
            font-size: 14px;
            color: #666;
        }
        
        /* Estilos del gráfico HTML */
        .grafico-container {
            margin: 30px 0;
            page-break-inside: avoid;
        }
        
        .grafico-titulo {
            text-align: center;
            color: var(--primary-color);
            margin-bottom: 20px;
            font-size: 18px;
        }
        
        .grafico-barras {
            display: flex;
            align-items: end;
            justify-content: space-around;
            height: 250px;
            border-bottom: 2px solid var(--gray-color);
            border-left: 2px solid var(--gray-color);
            padding: 20px;
            margin-bottom: 15px;
            background-color: #fafafa;
        }
        
        .barra-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0 8px;
            min-width: 60px;
        }
        
        .barra-valor {
            font-size: 11px;
            font-weight: bold;
            margin-bottom: 8px;
            text-align: center;
            color: var(--dark-color);
            word-break: break-word;
        }
        
        .barra {
            background: linear-gradient(to top, var(--primary-color), var(--accent-color));
            width: 45px;
            min-height: 20px;
            border-radius: 4px 4px 0 0;
            margin-bottom: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .barra-label {
            font-size: 11px;
            text-align: center;
            font-weight: 600;
            color: var(--dark-color);
            max-width: 60px;
            word-wrap: break-word;
            line-height: 1.2;
        }
        
        /* Estilos de la tabla */
        .tabla-principal {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 14px;
        }
        
        .tabla-principal th,
        .tabla-principal td {
            border: 1px solid var(--gray-color);
            padding: 10px;
            text-align: center;
        }
        
        .tabla-principal th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
        }
        
        .tabla-principal .table-secondary {
            background-color: var(--gray-color);
            font-weight: bold;
        }
        
        .resumen {
            margin-top: 30px;
            padding: 15px;
            background-color: var(--light-color);
            border-left: 4px solid var(--primary-color);
        }
        </style>
    `;

    const printContent = `
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Reporte de Morosos - Edificio <?php echo htmlspecialchars($terraza.$edificio); ?></title>
            ${styles}
        </head>
        <body>
            <div class="header">
                <img src="../Img/logo.png" alt="Logo La Quinta" class="logo" onerror="this.style.display='none'">
                <div class="titulo">Reporte de Morosos</div>
                <div class="subtitulo">Edificio <?php echo htmlspecialchars($terraza.$edificio); ?></div>
                <div class="fecha">Fecha de generación: ${fecha}</div>
            </div>
            
            ${graficoHtml}
            
            ${tablaHtml}
            
            <div class="resumen">
                <strong>Resumen:</strong><br>
                Total de usuarios morosos: <?php echo count($filas); ?><br>
                Total de deudas pendientes: <?php echo $totalCantidadDeudas; ?><br>
                Monto total adeudado: <?php echo number_format($totalDeudaGeneral, 2); ?> Bs
            </div>
        </body>
        </html>
    `;

    // Crear ventana de impresión
    const printWindow = window.open('', '_blank', 'width=900,height=700');
    printWindow.document.write(printContent);
    printWindow.document.close();

    // Esperar a que se cargue y luego imprimir
    printWindow.onload = function() {
        setTimeout(function() {
            printWindow.focus();
            printWindow.print();
        }, 500);
    };
}
</script>

<style>
/* Estilos adicionales para la vista en pantalla */
@media screen {
    .grafico-impresion {
        display: none !important;
    }
}

@media print {
    .grafico-pantalla {
        display: none !important;
    }
    .grafico-impresion {
        display: block !important;
    }
    .no-print {
        display: none !important;
    }
}
</style>