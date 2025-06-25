<?php
session_start();
$fechaUltimoLogin = $_SESSION['ultimo_login'] ?? null;

$conexion = new mysqli("localhost", "root", "", "urbanizacion");
$conexion->set_charset("utf8");

$iconos_prioridad = [
    'baja' => '🟢 Baja - Informativo',
    'media' => '🟡 Media - Requiere Atención',
    'alta' => '🔴 Alta - Urgente'
];

$iconos_tipo = [
    'mantenimiento' => '🔧 Mantenimiento',
    'seguridad' => '🛡️ Seguridad',
    'financiero' => '💰 Financiero',
    'limpieza' => '🧹 Limpieza',
    'servicios' => '⚡ Servicios Públicos',
    'reparaciones' => '🔨 Reparaciones',
    'general' => '📋 General'
];

$query = "
    SELECT 
        i.id, i.tipo, i.asunto, i.descripcion, i.prioridad, i.remitente, i.fecha_creacion,
        a.nombre_archivo, a.ruta_archivo
    FROM informes i
    LEFT JOIN archivos_adjuntos a ON i.id = a.informe_id
    ORDER BY i.fecha_creacion DESC
";

$resultado = $conexion->query($query);

$informes = [];
while ($row = $resultado->fetch_assoc()) {
    $id = $row['id'];
    if (!isset($informes[$id])) {
        $informes[$id] = [
            'tipo' => $row['tipo'],
            'asunto' => $row['asunto'],
            'descripcion' => $row['descripcion'],
            'prioridad' => $row['prioridad'],
            'remitente' => $row['remitente'],
            'fecha' => $row['fecha_creacion'],
            'adjuntos' => []
        ];
    }

    if (!empty($row['nombre_archivo'])) {
        $informes[$id]['adjuntos'][] = [
            'nombre' => $row['nombre_archivo'],
            'ruta' => $row['ruta_archivo']
        ];
    }
}

$conexion->close();
// Agrega esto justo al final del archivo

header('Content-Type: application/json');
echo json_encode(['informes' => array_values($informes)]);
exit;


?>