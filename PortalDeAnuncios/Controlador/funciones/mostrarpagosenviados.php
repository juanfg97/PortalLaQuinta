<?php
session_start();
header('Content-Type: application/json');

$conexion = new mysqli("localhost", "root", "", "urbanizacion", "3306");
$conexion->set_charset("utf8");

if ($conexion->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Conexión fallida']);
    exit;
}

if (!isset($_SESSION['Terraza']) || !isset($_SESSION['Edificio'])) {
    echo json_encode(['success' => false, 'message' => 'Faltan datos de sesión']);
    exit;
}

$terraza = $_SESSION['Terraza'];
$edificio = $_SESSION['Edificio'];

// 1. Obtener usuarios permitidos
$stmt = $conexion->prepare("SELECT usuario FROM edificios WHERE Terraza = ? AND Edificio = ?");
$stmt->bind_param("ss", $terraza, $edificio);
$stmt->execute();
$resUsuarios = $stmt->get_result();

$usuariosPermitidos = [];
while ($row = $resUsuarios->fetch_assoc()) {
    $usuariosPermitidos[] = $row['usuario'];
}
$stmt->close();

// Si no hay usuarios permitidos, retornar vacío
if (empty($usuariosPermitidos)) {
    echo json_encode(['success' => true, 'pagos' => []]);
    exit;
}

// 2. Generar placeholders (?, ?, ?...)
$placeholders = implode(',', array_fill(0, count($usuariosPermitidos), '?'));
$tipos = str_repeat('s', count($usuariosPermitidos));

// 3. Query con JOIN para obtener todos los datos
$sql = "
    SELECT 
        p.id,
        p.deudaid,
        p.usuario AS apartamento,
        e.nombre_completo AS nombre,
        p.monto_pagado AS monto,
        d.descripcion,
        p.banco_origen AS banco,
        p.referencia,
        p.fecha_pago,
        p.telefono,
        p.cedula,
        p.archivo_comprobante AS archivo,
        p.comentario,
        p.metodo_pago,
        p.estado
    FROM pagos p
    INNER JOIN edificios e ON p.usuario = e.usuario
    LEFT JOIN deudas d ON p.deudaid = d.id
    WHERE p.usuario IN ($placeholders)
      AND p.estado != 'rechazado'
    ORDER BY 
        CASE p.estado 
            WHEN 'en proceso' THEN 1
            WHEN 'aprobado' THEN 2
            ELSE 3
        END,
        p.fecha_pago DESC
";

$stmt = $conexion->prepare($sql);
$stmt->bind_param($tipos, ...$usuariosPermitidos);
$stmt->execute();
$result = $stmt->get_result();

$pagos = [];

while ($p = $result->fetch_assoc()) {
    $fecha = (new DateTime($p['fecha_pago']))->format('d/m/Y');

    $pagos[] = [
        'id'          => $p['id'],
        'deudaid'     => $p['deudaid'],
        'apartamento' => $p['apartamento'],
        'nombre'      => $p['nombre'],
        'monto'       => number_format($p['monto'], 2, '.', ','),
        'descripcion' => $p['descripcion'],
        'banco'       => $p['banco'],
        'referencia'  => $p['referencia'],
        'fecha_pago'  => $fecha,
        'telefono'    => $p['telefono'],
        'cedula'      => $p['cedula'],
        'archivo'     => $p['archivo'],
        'comentario'  => $p['comentario'],
        'metodo_pago' => $p['metodo_pago'],
        'estado'      => $p['estado']
    ];
}

echo json_encode(['success' => true, 'pagos' => $pagos]);
$conexion->close();
