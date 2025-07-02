<?php
// Conexión asumida en el archivo principal ($conexion)

$sql = "SELECT 
            CONCAT(e.Terraza, e.Edificio) AS edificio,
            COUNT(DISTINCT d.usuario) AS total_morosos,
            SUM(d.monto) AS total_deuda
        FROM deudas d
        JOIN edificios e ON d.usuario = e.usuario
        WHERE d.estado = 'pendiente' AND d.fecha_vencimiento < CURDATE()
        GROUP BY e.Terraza, e.Edificio
        ORDER BY e.Terraza ASC, e.Edificio ASC";

$stmt = $conexion->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

// Variables para gráfica y totales
$edificios = [];
$morosos = [];
$deudas = [];
$totalMorososGeneral = 0;
$totalDeudaGeneral = 0;

$filas = [];
while ($row = $result->fetch_assoc()) {
    $edificios[] = $row['edificio'];
    $morosos[] = (int)$row['total_morosos'];
    $deudas[] = (float)$row['total_deuda'];
    $totalMorososGeneral += $row['total_morosos'];
    $totalDeudaGeneral += $row['total_deuda'];
    $filas[] = $row;
}
$stmt->close();

// Función para crear gráfico HTML simple para impresión
function crearGraficoHTML($edificios, $morosos, $deudas) {
    if (empty($morosos)) return '';
    
    $maxMorosos = max($morosos);
    $html = '<div class="grafico-container">';
    $html .= '<h4 class="grafico-titulo">Morosos y Deudas por Edificio</h4>';
    $html .= '<div class="grafico-barras">';
    
    foreach ($edificios as $index => $edificio) {
        $alturaMorosos = ($morosos[$index] / $maxMorosos) * 150; // Altura máxima de 150px
        $html .= '<div class="barra-container">';
        $html .= '<div class="barra-valores">';
        $html .= '<div class="valor-morosos">' . $morosos[$index] . ' morosos</div>';
        $html .= '<div class="valor-deuda">' . number_format($deudas[$index], 0) . ' Bs</div>';
        $html .= '</div>';
        $html .= '<div class="barra-morosos" style="height: ' . $alturaMorosos . 'px;"></div>';
        $html .= '<div class="barra-label">' . htmlspecialchars($edificio) . '</div>';
        $html .= '</div>';
    }
    
    $html .= '</div></div>';
    return $html;
}
?>

<div class="dashboard-card grafico-morosos-edificios">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <span class="card-title">Morosos por Edificio</span>
            <div class="estadisticas-generales">
                <span class="stat-item">Total Morosos: <strong><?php echo $totalMorososGeneral; ?></strong></span>
                <span class="stat-item">Total Deuda: <strong><?php echo number_format($totalDeudaGeneral, 0); ?> Bs</strong></span>
                <span class="stat-item">Edificios con Morosos: <strong><?php echo count($filas); ?></strong></span>
            </div>
        </div>
        <button class="btn btn-outline-danger btn-sm no-print" onclick="printGraficoMorosos()">
            <i class="fas fa-file-pdf me-1"></i> Imprimir PDF
        </button>
    </div>

    <!-- Gráfico para pantalla -->
    <div class="grafico-pantalla" style="height: 400px; margin: 20px;">
        <canvas id="morososEdificiosChart"></canvas>
    </div>

    <!-- Gráfico para impresión (oculto en pantalla) -->
    <div class="grafico-impresion" style="display: none;">
        <?php echo crearGraficoHTML($edificios, $morosos, $deudas); ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Gráfico para visualización en pantalla
const ctxEdificios = document.getElementById('morososEdificiosChart');
if (ctxEdificios) {
    const morososEdificiosChart = new Chart(ctxEdificios, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($edificios); ?>,
            datasets: [
                {
                    label: 'Número de Morosos',
                    data: <?php echo json_encode($morosos); ?>,
                    backgroundColor: 'rgba(220, 53, 69, 0.7)',
                    borderColor: 'rgba(220, 53, 69, 1)',
                    borderWidth: 1,
                    borderRadius: 4,
                    yAxisID: 'y'
                },
                {
                    label: 'Total Deuda (Bs)',
                    data: <?php echo json_encode($deudas); ?>,
                    backgroundColor: 'rgba(0, 51, 153, 0.7)',
                    borderColor: 'rgba(0, 51, 153, 1)',
                    borderWidth: 1,
                    borderRadius: 4,
                    yAxisID: 'y1',
                    type: 'line',
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Edificios'
                    },
                    ticks: {
                        maxRotation: 45,
                        minRotation: 45
                    }
                },
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    title: {
                        display: true,
                        text: 'Número de Morosos'
                    },
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    title: {
                        display: true,
                        text: 'Total Deuda (Bs)'
                    },
                    beginAtZero: true,
                    grid: {
                        drawOnChartArea: false,
                    },
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            if (context.datasetIndex === 0) {
                                return 'Morosos: ' + context.parsed.y;
                            } else {
                                return 'Deuda: ' + context.parsed.y.toLocaleString() + ' Bs';
                            }
                        }
                    }
                }
            }
        }
    });
}

function printGraficoMorosos() {
    const fecha = new Date().toLocaleDateString('es-ES');
    
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
            --secondary-color: #dc3545;
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
        
        .estadisticas-resumen {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
            padding: 15px;
            background-color: var(--light-color);
            border-radius: 8px;
            border: 1px solid var(--gray-color);
        }
        
        .stat-box {
            text-align: center;
            padding: 10px;
        }
        
        .stat-number {
            font-size: 24px;
            font-weight: bold;
            color: var(--primary-color);
        }
        
        .stat-label {
            font-size: 12px;
            color: var(--dark-color);
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
            justify-content: flex-start;
            flex-wrap: wrap;
            gap: 8px;
            height: auto;
            min-height: 250px;
            border-bottom: 2px solid var(--gray-color);
            border-left: 2px solid var(--gray-color);
            padding: 20px;
            margin-bottom: 15px;
            background-color: #fafafa;
            overflow-x: auto;
        }
        
        .barra-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0 2px;
            min-width: 35px;
            max-width: 50px;
        }
        
        .barra-valores {
            margin-bottom: 8px;
            text-align: center;
        }
        
        .valor-morosos {
            font-size: 9px;
            font-weight: bold;
            color: var(--secondary-color);
            margin-bottom: 2px;
        }
        
        .valor-deuda {
            font-size: 8px;
            color: var(--primary-color);
            margin-bottom: 2px;
        }
        
        .barra-morosos {
            background: linear-gradient(to top, var(--secondary-color), #ff6b6b);
            width: 100%;
            min-height: 10px;
            border-radius: 4px 4px 0 0;
            margin-bottom: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .barra-label {
            font-size: 8px;
            text-align: center;
            font-weight: 600;
            color: var(--dark-color);
            word-wrap: break-word;
            line-height: 1.1;
            writing-mode: vertical-rl;
            text-orientation: mixed;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        </style>
    `;

    const printContent = `
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Reporte de Morosos por Edificio</title>
            ${styles}
        </head>
        <body>
            <div class="header">
                <img src="../Img/logo.png" alt="Logo La Quinta" class="logo" onerror="this.style.display='none'">
                <div class="titulo">Reporte de Morosos por Edificio</div>
                <div class="subtitulo">Complejo Residencial La Quinta</div>
                <div class="fecha">Fecha de generación: ${fecha}</div>
            </div>
            
            <div class="estadisticas-resumen">
                <div class="stat-box">
                    <div class="stat-number"><?php echo $totalMorososGeneral; ?></div>
                    <div class="stat-label">Total Morosos</div>
                </div>
                <div class="stat-box">
                    <div class="stat-number"><?php echo count($filas); ?></div>
                    <div class="stat-label">Edificios Afectados</div>
                </div>
                <div class="stat-box">
                    <div class="stat-number"><?php echo number_format($totalDeudaGeneral, 0); ?></div>
                    <div class="stat-label">Total Deuda (Bs)</div>
                </div>
            </div>
            
            ${graficoHtml}
            
        </body>
        </html>
    `;

    // Crear ventana de impresión
    const printWindow = window.open('', '_blank', 'width=1200,height=800');
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
.dashboard-card {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}

.card-header {
    padding: 20px;
    border-bottom: 1px solid #e0e5f0;
}

.card-title {
    font-size: 18px;
    font-weight: 600;
    color: #003399;
    margin-bottom: 10px;
    display: block;
}

.estadisticas-generales {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    margin-top: 10px;
}

.stat-item {
    font-size: 14px;
    color: #666;
}

.stat-item strong {
    color: #003399;
}

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