<?php

session_start();

// Solo permitir POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['exito' => false, 'mensaje' => 'Método no permitido']);
    exit;
}

// Recibir datos JSON
$data = json_decode(file_get_contents('php://input'), true);
$correo = trim($data['correo'] ?? '');
$codigo = trim($data['codigo'] ?? '');

// Validar correo y código
if (!filter_var($correo, FILTER_VALIDATE_EMAIL) || strlen($codigo) !== 6) {
    echo json_encode(['exito' => false, 'mensaje' => 'Datos inválidos']);
    exit;
}

// Verificar si hay código en sesión
if (!isset($_SESSION['codigo_verificacion'], $_SESSION['correo_verificacion'], $_SESSION['codigo_expira'])) {
    echo json_encode(['exito' => false, 'mensaje' => 'No hay código pendiente de verificar']);
    exit;
}

// Verificar si el código ha expirado
if (time() > $_SESSION['codigo_expira']) {
    unset($_SESSION['codigo_verificacion'], $_SESSION['correo_verificacion'], $_SESSION['codigo_expira']);
    echo json_encode(['exito' => false, 'mensaje' => 'El código ha expirado. Solicita uno nuevo.']);
    exit;
}

// Validar que correo y código coincidan con sesión (comparación flexible)
if ((string)$_SESSION['codigo_verificacion'] !== (string)$codigo || strcasecmp($_SESSION['correo_verificacion'], $correo) !== 0) {
    echo json_encode(['exito' => false, 'mensaje' => 'Código incorrecto']);
    exit;
}

// El código y correo son correctos: responder OK y borrar código de sesión para evitar reutilización
unset($_SESSION['codigo_verificacion'], $_SESSION['codigo_expira']);

// Solo indicar éxito para que el frontend redirija a cambiar contraseña
echo json_encode(['exito' => true, 'mensaje' => 'Código verificado correctamente']);
exit;
?>
