<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . '/PortalDeAnuncios/vendor/autoload.php';
require '../conexion_bd_login.php';

use Dompdf\Dompdf;
use Dompdf\Options;

header('Content-Type: application/pdf');

// Sanitizar entrada
$estado = $_POST['estado'] ?? 'todos';
$fechaInicio = $_POST['fechaInicio'] ?? '';
$fechaFin = $_POST['fechaFin'] ?? '';

// Construir consulta
$query = "SELECT usuario, nombre_completo, ubicacion, asunto, descripcion, telefono, fecha, estado FROM reportes WHERE 1=1";
$params = [];
$types = "";

// Filtros dinámicos
if ($estado !== 'todos') {
    $query .= " AND estado = ?";
    $params[] = $estado;
    $types .= "s";
}
if (!empty($fechaInicio) && !empty($fechaFin)) {
    $query .= " AND DATE(fecha) BETWEEN ? AND ?";
    $params[] = $fechaInicio;
    $params[] = $fechaFin;
    $types .= "ss";
}
$query .= " ORDER BY fecha DESC";

// Preparar consulta segura
$stmt = $conexion->prepare($query);
if (!$stmt) {
    http_response_code(500);
    exit("Error preparando consulta: " . $conexion->error);
}

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();
$logoPath = __DIR__ . '/../../Vista/Img/logo.png';

if (!file_exists($logoPath)) {
    exit("Error: No se encontró el logo en la ruta: $logoPath");
}

$logoData = file_get_contents($logoPath);
if ($logoData === false) {
    exit("Error: No se pudo leer el archivo del logo.");
}

$logoBase64 = base64_encode($logoData);
$logoSrc = 'data:image/png;base64,' . $logoBase64;

// Construir HTML para PDF con CSS y logo
$html = '
<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
        margin: 20px;
    }
    .header {
        text-align: left;
        margin-bottom: 20px;
    }
    .header img {
        width: 300px;
        margin-bottom: 10px;
    }
    h2 {
        margin: 0;
        font-weight: bold;
        font-size: 18px;
    }
    table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 10px;
    }
    th, td {
        border: 1px solid #555;
        padding: 6px 8px;
        text-align: left;
        vertical-align: top;
    }
    thead tr {
        background-color: #f2f2f2;
    }
    tbody tr:nth-child(even) {
        background-color: #fafafa;
    }
</style>

<div class="header">
      <img src="' . $logoSrc . '" alt="Logo">
    <h2>Reporte de Incidencias</h2>
</div>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Usuario</th>
            <th>Nombre completo</th>
            <th>Ubicación</th>
            <th>Asunto</th>
            <th>Descripción</th>
            <th>Teléfono</th>
            <th>Fecha</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>';

// Rellenar filas con datos
$contador = 1;
while ($row = $result->fetch_assoc()) {
    $descripcion = nl2br(htmlspecialchars($row['descripcion']));
    $fecha = date('d/m/Y H:i', strtotime($row['fecha']));
    $estadoNombre = ucfirst(str_replace('_', ' ', $row['estado']));

    $html .= "<tr>
        <td>{$contador}</td>
        <td>" . htmlspecialchars($row['usuario']) . "</td>
        <td>" . htmlspecialchars($row['nombre_completo']) . "</td>
        <td>" . htmlspecialchars($row['ubicacion']) . "</td>
        <td>" . htmlspecialchars($row['asunto']) . "</td>
        <td>{$descripcion}</td>
        <td>" . htmlspecialchars($row['telefono']) . "</td>
        <td>{$fecha}</td>
        <td>{$estadoNombre}</td>
    </tr>";
    $contador++;
}

if ($contador === 1) {
    $html .= '<tr><td colspan="9" style="text-align:center;">No se encontraron reportes con los filtros aplicados.</td></tr>';
}

$html .= '</tbody></table>';

// Configurar y generar PDF
$options = new Options();
$options->set('isRemoteEnabled', true);

$dompdf = new Dompdf($options);
$dompdf->loadHtml($html, 'UTF-8');
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();

// Limpiar buffer para evitar caracteres extras
if (ob_get_length()) {
    ob_end_clean();
}

$dompdf->stream("reportes_" . date("Ymd_His") . ".pdf", ["Attachment" => false]);
exit;
