<?php
session_start();
header('Content-Type: application/json');

include '../conexion_bd_login.php';

// Validar existencia de datos requeridos desde POST
if (!isset($_POST['asunto'], $_POST['descripcion'])) {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "message" => "Faltan campos obligatorios."
    ]);
    exit;
}

// Validar sesión
if (!isset($_SESSION['usuario'], $_SESSION['telefono'], $_SESSION['nombre_completo'])) {
    http_response_code(403);
    echo json_encode([
        "success" => false,
        "message" => "Sesión no válida o expirada. Por favor inicia sesión."
    ]);
    exit;
}

// Limpiar y asignar valores
$asunto = trim($_POST['asunto']);
$descripcion = trim($_POST['descripcion']);
$usuario = trim($_SESSION['usuario']);
$telefono = trim($_SESSION['telefono']);
$nombre_completo = trim($_SESSION['nombre_completo']);
$fecha = date('Y-m-d H:i:s');
$estado = 'pendiente';
$ubicacion = $_SESSION['Terraza'].$_SESSION['Edificio'];

// Validaciones básicas
if ($asunto === '' || $descripcion === '') {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "message" => "Asunto y descripción son obligatorios."
    ]);
    exit;
}

if (strlen($asunto) > 100 || strlen($descripcion) > 1000) {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "message" => "Longitud excedida en asunto o descripción."
    ]);
    exit;
}

// Preparar consulta SQL
$stmt = $conexion->prepare("INSERT INTO reportes 
    (usuario, nombre_completo, asunto, descripcion, telefono, fecha, estado, ubicacion) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "Error al preparar la consulta: " . $conexion->error
    ]);
    exit;
}

// Enlazar parámetros
$stmt->bind_param("ssssssss", 
    $usuario, 
    $nombre_completo, 
    $asunto, 
    $descripcion, 
    $telefono, 
    $fecha, 
    $estado, 
    $ubicacion
);

// Ejecutar e informar
if ($stmt->execute()) {
    echo json_encode([
        "success" => true,
        "message" => "Tu reporte ha sido enviado correctamente."
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "Error al guardar el reporte: " . $stmt->error
    ]);
}

$stmt->close();
