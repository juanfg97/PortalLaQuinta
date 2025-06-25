<?php

session_start();
include("../conexion_bd_login.php");
header('Content-Type: application/json');

// Validar método
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

// Verificar sesión
if (!isset($_SESSION['usuario'])) {
    echo json_encode(['success' => false, 'message' => 'Sesión no iniciada']);
    exit;
}

// Obtener y validar datos JSON
$input = json_decode(file_get_contents('php://input'), true);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(['success' => false, 'message' => 'JSON inválido']);
    exit;
}

$telefono = isset($input['phone']) ? trim($input['phone']) : '';

$errores = [];

// Validaciones
if (empty($telefono)) {
    $errores[] = 'Ingrese su número de teléfono';
}
if (!preg_match('/^[0-9]{10,15}$/', $telefono)) {
    $errores[] = 'Ingrese un número de teléfono válido (10-15 dígitos)';
}


if (!empty($errores)) {
    echo json_encode(['success' => false, 'message' => implode('<br>', $errores)]);
    exit;
}

try {
    $stmt = $conexion->prepare("UPDATE presidente_central SET telefono = ? WHERE usuario = ?");
    if (!$stmt) {
        throw new Exception("Error al preparar la consulta: " . $conexion->error);
    }

    $stmt->bind_param("ss", $telefono, $_SESSION['usuario']);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $_SESSION['telefono'] = $telefono;

        echo json_encode([
            'success' => true,
            'message' => 'Teléfono actualizado correctamente'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'No se realizaron cambios.'
        ]);
    }

    $stmt->close();
    $conexion->close();

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error en la base de datos: ' . $e->getMessage()
    ]);
}
