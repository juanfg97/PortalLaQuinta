<?php

include ("conexion_bd_login.php");

// Configurar cabecera para respuesta JSON
header('Content-Type: application/json');


// Obtener y limpiar datos
$nombreCompleto = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_STRING);
$correo = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$telefono = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
$password = $_POST['password'] ?? '';
$confirmarpassword = $_POST['confirm-password'] ?? '';

// Validaciones
$errores = [];

// Validar nombre completo
if (empty($nombreCompleto) || strlen($nombreCompleto) < 5) {
    $errores[] = 'El nombre debe tener al menos 5 caracteres';
}

// Validar email
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    $errores[] = 'Ingrese un correo electrónico válido';
}

// Validar teléfono
if (!preg_match('/^[0-9]{10,15}$/', $telefono)) {
    $errores[] = 'Ingrese un número de teléfono válido (10-15 dígitos)';
}

// Validar contraseña
if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) {
    $errores[] = 'La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula y un número';
}

// Validar confirmación de contraseña
if ($password !== $confirmarpassword) {
    $errores[] = 'Las contraseñas no coinciden';
}

// Si hay errores, devolverlos
if (!empty($errores)) {
    echo json_encode(['exito' => false, 'mensaje' => implode('<br>', $errores)]);
    exit;
}

// Si todo está correcto, procesar el registro
try {

    
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conexion->prepare("UPDATE edificios SET nombre_completo = ?, password = ?, correo = ?, telefono = ?  WHERE usuario = ?");
    $stmt->execute([$nombreCompleto,$passwordHash, $correo, $telefono,  $_SESSION['usuario']]);
    
    echo json_encode([
        'exito' => true,
        'mensaje' => 'Registro completado exitosamente',
        'redireccion' => '../Vista/inicio.php'
    ]);
    
} catch (Exception $e) {
    error_log('Error en registro: ' . $e->getMessage());
    echo json_encode([
        'exito' => false,
        'mensaje' => 'Error al procesar el registro. Por favor intente nuevamente.'
    ]);
}
?>