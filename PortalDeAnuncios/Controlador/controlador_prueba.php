<?php

include ("conexion_bd_login.php");

// Configurar cabecera para respuesta JSON
header('Content-Type: application/json');


// Obtener y limpiar datos
$nombreCompleto = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_STRING);


// Validaciones
$errores = [];

// Validar nombre completo
if (empty($nombreCompleto) || strlen($nombreCompleto) < 5) {
    $errores[] = 'El nombre debe tener al menos 5 caracteres';
}
if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s']+$/",$nombreCompleto)){

    $errores[] = 'El nombre solo puede contener letras y espacios';
}

// Si hay errores, devolverlos
if (!empty($errores)) {
    echo json_encode(['exito' => false, 'mensaje' => implode('<br>', $errores)]);
    exit;
}

// Si todo está correcto, procesar el registro
try {
    $stmt = $conexion->prepare("UPDATE edificios SET nombre_completo = ? WHERE usuario = ?");
    $stmt->execute([$nombreCompleto,  $_SESSION['usuario']]);
    
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