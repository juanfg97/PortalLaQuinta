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
if (!isset($_SESSION['usuario'])) {
    echo json_encode([
        'exito' => false,
        'mensaje' => 'Sesión no iniciada'
    ]);
    exit;
}

// Obtener y limpiar datos
$nombreCompleto = isset($input['nombreCompleto']) ? trim($input['nombreCompleto']) : '';
$correo = isset($input['correo']) ? filter_var(trim($input['correo']), FILTER_SANITIZE_EMAIL) : '';

$telefono = isset($input['telefono']) ? preg_replace('/\D/', '', trim($input['telefono'])) : '';
$password = isset($input['password']) ? trim($input['password']) : '';
$confirmarPassword = isset($input['confirmarPassword']) ? trim($input['confirmarPassword']) : '';
$ultima_modificacion =date('y-m-d');

// Validaciones
$errores = [];

// Validar nombre completo
if (empty($nombreCompleto) || strlen($nombreCompleto) < 5) {
    $errores[] = 'El nombre debe tener al menos 5 caracteres';
}
if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s']+$/", $nombreCompleto)) {
    $errores[] = 'El nombre solo puede contener letras y espacios';
}

// Validar correo
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    $errores[] = 'Ingrese un correo electrónico válido';
}
// Verificar si el correo ya está registrado en la base de datos
$correoStmt = $conexion->prepare("SELECT correo FROM edificios WHERE correo = ?");
$correoStmt->bind_param("s", $correo);
$correoStmt->execute();
$correoStmt->store_result();

if ($correoStmt->num_rows > 0) {
    echo json_encode([
        'exito' => false,
        'mensaje' => 'El correo ingresado ya esta en uso'
    ]);
    $correoStmt->close();
    exit;
}
$correoStmt->close();




// Validar teléfono
if (!preg_match('/^[0-9]{10,15}$/', $telefono)) {
    $errores[] = 'Ingrese un número de teléfono válido (10-15 dígitos)';
}

// Validar contraseña
if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) {
    $errores[] = 'La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula y un número';
}

// Validar confirmación de contraseña
if ($password !== $confirmarPassword) {
    $errores[] = 'Las contraseñas no coinciden';
}

if($password == $_SESSION['usuario']){

    $errores[] = 'La contreseña no puede ser igual que su nombre de usuario';
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

        $checkStmt = $conexion->prepare("SELECT usuario FROM edificios WHERE usuario = ?");
        $checkStmt->bind_param("s", $_SESSION['usuario']);
        $checkStmt->execute();
        $checkStmt->store_result();

if ($checkStmt->num_rows === 0) {
    echo json_encode([
        'exito' => false,
        'mensaje' => 'El usuario no existe en la base de datos.'
    ]);
    exit;
}
$checkStmt->close();



        $stmt = $conexion->prepare("UPDATE edificios SET nombre_completo = ?, password = ?, ultima_modificacion =?,correo = ?, telefono = ?  WHERE usuario = ?");
        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . $conexion->error);
        }
        
            $stmt->bind_param("ssssss", $nombreCompleto,$passwordHash,$ultima_modificacion,$correo,$telefono, $_SESSION['usuario']);
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