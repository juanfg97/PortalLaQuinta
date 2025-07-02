<?php
session_start();
header('Content-Type: application/json'); 

include '../conexion_bd_login.php'; 

// Validar existencia de datos en POST
if (!isset($_POST['asunto'], $_POST['descripcion'], $_POST['usuario'])) {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "message" => "Faltan campos obligatorios."
    ]);
    exit;
}

$asunto = trim($_POST['asunto']);
$descripcion = trim($_POST['descripcion']);
$usuario = trim($_POST['usuario']);
$telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';

// Validaciones básicas
if ($asunto === '' || $descripcion === '' || $usuario === '') {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "message" => "Asunto, descripción y usuario son obligatorios."
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

// Obtener datos de sesión
$nombre_completo = isset($_SESSION['nombre_completo']) ? $_SESSION['nombre_completo'] : '';
$fecha = date('Y-m-d H:i:s');
$estado = 'pendiente';
$ubicacion = $usuario; // Como solicitaste: ubicación = usuario

// Preparar e insertar
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
