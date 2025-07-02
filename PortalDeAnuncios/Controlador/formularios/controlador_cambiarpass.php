<?php
session_start();
include ("../conexion_bd_login.php");

header('Content-Type: application/json');

// Verificar método
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'exito' => false,
        'mensaje' => 'Método no permitido'
    ]);
    exit;
}

// Verificar existencia de sesión
if (empty($_SESSION['usuario']) || empty($_SESSION['tipo'])) {
    echo json_encode([
        'exito' => false,
        'mensaje' => 'Sesión no iniciada. Redirigiendo...',
        'redirigir' => 'index.php'
    ]);
    exit;
}

// Leer JSON del cuerpo
$input_raw = file_get_contents("php://input");
$input = json_decode($input_raw, true);

// Verificar JSON válido
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode([
        'exito' => false,
        'mensaje' => 'Error al procesar los datos: ' . json_last_error_msg()
    ]);
    exit;
}

// Obtener y limpiar datos
$password = isset($input['password']) ? trim($input['password']) : '';
$confirmarPassword = isset($input['confirmarPassword']) ? trim($input['confirmarPassword']) : '';

$errores = [];

// Validar contraseña
if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) {
    $errores[] = 'La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula y un número';
}

if ($password !== $confirmarPassword) {
    $errores[] = 'Las contraseñas no coinciden';
}

if (!empty($errores)) {
    echo json_encode([
        'exito' => false,
        'mensaje' => implode('<br>', $errores)
    ]);
    exit;
}

try {
    $tablaPermitida = ['edificios', 'presidente_condominio', 'presidente_central'];
    $tabla = $_SESSION['tipo'];
    $usuario = $_SESSION['usuario'];

    if (!in_array($tabla, $tablaPermitida)) {
        echo json_encode([
            'exito' => false,
            'mensaje' => 'Tipo de usuario inválido'
        ]);
        exit;
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Verificar existencia del usuario
    $checkStmt = $conexion->prepare("SELECT usuario FROM $tabla WHERE usuario = ?");
    $checkStmt->bind_param("s", $usuario);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows === 0) {
        echo json_encode([
            'exito' => false,
            'mensaje' => 'El usuario no existe en la base de datos.'
        ]);
        $checkStmt->close();
        exit;
    }
    $checkStmt->close();

    // Actualizar la contraseña
    $stmt = $conexion->prepare("UPDATE $tabla SET password = ? WHERE usuario = ?");
    if (!$stmt) {
        throw new Exception("Error al preparar la consulta: " . $conexion->error);
    }

    $stmt->bind_param("ss", $passwordHash, $usuario);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode([
            'exito' => true,
            'mensaje' => 'Contraseña actualizada exitosamente',
            'redireccion' => 'index.php'
        ]);
    } else {
        echo json_encode([
            'exito' => false,
            'mensaje' => 'No se actualizó la contraseña.'
        ]);
        session_destroy();
    }

    $stmt->close();
    $conexion->close();

} catch (Exception $e) {
    error_log('Error en cambio de contraseña: ' . $e->getMessage());
    echo json_encode([
        'exito' => false,
        'mensaje' => 'Error al procesar la solicitud: ' . $e->getMessage()
    ]);
}
?>
