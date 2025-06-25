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

$nombreCompleto = isset($input['fullname']) ? trim($input['fullname']) : '';

$errores = [];

// Validaciones
if (empty($nombreCompleto) || strlen($nombreCompleto) < 5) {
    $errores[] = 'El nombre completo debe tener al menos 5 caracteres';
}
if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s']+$/", $nombreCompleto)) {
    $errores[] = 'El nombre completo solo puede contener letras y espacios';
}
if ($_SESSION['nombre_completo'] == $nombreCompleto){

     $errores[] = 'El nombre completo ingresado es igual al anterior';

}

if (!empty($errores)) {
    echo json_encode(['success' => false, 'message' => implode('<br>', $errores)]);
    exit;
}



try {
    $stmt = $conexion->prepare("UPDATE presidente_condominio SET nombre_completo = ? WHERE usuario = ?");
    if (!$stmt) {
        throw new Exception("Error al preparar la consulta: " . $conexion->error);
    }

    $stmt->bind_param("ss", $nombreCompleto, $_SESSION['usuario']);
    $stmt->execute();

    

    if ($stmt->affected_rows > 0) {
         $_SESSION['nombre_completo'] = $nombreCompleto;
        echo json_encode([
            'success' => true,
            'message' => 'Nombre completo actualizado correctamente'
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
