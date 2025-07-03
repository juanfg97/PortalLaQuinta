<?php
session_start();
header('Content-Type: application/json');

include '../conexion_bd_login.php';

// Leer datos JSON enviados
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);

// Validar datos
if (!isset($input['id'], $input['estado'])) {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "message" => "Faltan campos obligatorios."
    ]);
    exit;
}

// Validar sesión (opcional)
if (!isset($_SESSION['usuario'])) {
    http_response_code(403);
    echo json_encode([
        "success" => false,
        "message" => "Sesión no válida o expirada. Por favor inicia sesión."
    ]);
    exit;
}

$id = intval($input['id']);
$nuevoEstado = trim($input['estado']);

// Validar estado válido
$estadosValidos = ['pendiente', 'en_proceso', 'resuelto'];
if (!in_array($nuevoEstado, $estadosValidos)) {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "message" => "Estado no válido."
    ]);
    exit;
}

// Preparar consulta para actualizar estado
$stmt = $conexion->prepare("UPDATE reportes SET estado = ? WHERE id = ?");
if (!$stmt) {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "Error al preparar la consulta: " . $conexion->error
    ]);
    exit;
}

$stmt->bind_param("si", $nuevoEstado, $id);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo json_encode([
            "success" => true,
            "message" => "Estado actualizado correctamente."
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "No se encontró el reporte o el estado ya era ese."
        ]);
    }
} else {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "Error al actualizar el estado: " . $stmt->error
    ]);
}

$stmt->close();
