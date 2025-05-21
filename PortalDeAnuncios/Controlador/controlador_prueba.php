<?php
session_start();
include("conexion_bd_login.php");
header('Content-Type: application/json');

// Verificar método de solicitud
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'exito' => false,
        'mensaje' => 'Método no permitido'
    ]);
    exit;
}

// Leer JSON del cuerpo de la solicitud
$input_raw = file_get_contents("php://input");
$input = json_decode($input_raw, true);

// Verificar si la decodificación JSON tuvo éxito
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode([
        'exito' => false,
        'mensaje' => 'Error al procesar los datos: ' . json_last_error_msg()
    ]);
    exit;
}

// Comprobar si la sesión de usuario existe
if (!isset($_SESSION['usuario'])) {
    echo json_encode([
        'exito' => false,
        'mensaje' => 'Sesión no iniciada'
    ]);
    exit;
}

// Limpiar $nombreCompleto
$nombreCompleto = isset($input['nombreCompleto']) ? trim($input['nombreCompleto']) : '';

// Validaciones
$errores = [];

if (empty($nombreCompleto) || strlen($nombreCompleto) < 5) {
    $errores[] = 'El nombre debe tener al menos 5 caracteres';
}

if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s']+$/", $nombreCompleto)) {
    $errores[] = 'El nombre solo puede contener letras y espacios';
}

if (!empty($errores)) {
    echo json_encode([
        'exito' => false,
        'mensaje' => implode('<br>', $errores)
    ]);
    exit;
}

// Guardar en BD
try {
    $stmt = $conexion->prepare("UPDATE edificios SET nombre_completo = ? WHERE usuario = ?");
    
    if (!$stmt) {
        throw new Exception("Error al preparar la consulta: " . $conexion->error);
    }

    $stmt->bind_param("ss", $nombreCompleto, $_SESSION['usuario']);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode([
            'exito' => true,
            'mensaje' => 'Registro completado exitosamente',
            'redireccion' => '../Vista/inicio.php'
        ]);
    } else {
        echo json_encode([
            'exito' => false,
            'mensaje' => 'No se actualizó ningún registro. Verifique que el usuario exista.'
        ]);
    }

    $stmt->close();
    $conexion->close();

} catch (Exception $e) {
    error_log('Error en registro: ' . $e->getMessage());
    echo json_encode([
        'exito' => false,
        'mensaje' => 'Error al procesar el registro: ' . $e->getMessage()
    ]);
}
?>
