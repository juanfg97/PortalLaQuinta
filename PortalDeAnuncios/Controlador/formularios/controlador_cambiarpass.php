<?php

session_start();
include ("../conexion_bd_login.php");

// Configurar cabecera para respuesta JSON
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
if (!isset($_SESSION['correo_verificacion'])) {
    echo json_encode([
        'exito' => false,
        'mensaje' => 'Sesión no iniciada'
    ]);
    exit;
}

// Obtener y limpiar datos
$password = isset($input['password']) ? trim($input['password']) : '';
$confirmarPassword = isset($input['confirmarPassword']) ? trim($input['confirmarPassword']) : '';

// Validaciones
$errores = [];

// Validar contraseña
if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) {
    $errores[] = 'La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula y un número';
}

// Validar confirmación de contraseña
if ($password !== $confirmarPassword) {
    $errores[] = 'Las contraseñas no coinciden';
}



// Si hay errores, devolverlos
if (!empty($errores)) {
    echo json_encode([
        'exito' => false,
        'mensaje' => implode('<br>', $errores)
    ]);
    exit;
}

// Si todo está correcto, procesar el registro
try {

    
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $checkStmt = $conexion->prepare("SELECT correo FROM edificios WHERE correo = ?");
        $checkStmt->bind_param("s", $_SESSION['correo_verificacion']);
        $checkStmt->execute();
        $checkStmt->store_result();

if ($checkStmt->num_rows === 0) {
    echo json_encode([
        'exito' => false,
        'mensaje' => 'El correo no existe en la base de datos.'
    ]);
    exit;
}
$checkStmt->close();



        $stmt = $conexion->prepare("UPDATE edificios SET  password = ? WHERE correo = ?");
        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . $conexion->error);
        }
        
            $stmt->bind_param("ss", $passwordHash, $_SESSION['correo_verificacion']);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                echo json_encode([
                    'exito' => true,
                    'mensaje' => 'Registro completado exitosamente',
                    'redireccion' => '../../index.php'
                ]);
            } else {
                echo json_encode([
                    'exito' => false,
                    'mensaje' => 'No se actualizó la contraseña.'
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