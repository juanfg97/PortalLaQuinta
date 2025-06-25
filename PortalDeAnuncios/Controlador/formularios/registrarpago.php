<?php
header('Content-Type: application/json');
session_start();


$conexion = new mysqli("localhost","root","","urbanizacion","3306");
$conexion->set_charset("utf8");
if (headers_sent($file, $line)) {
    echo json_encode(['success' => false, 'message' => "Headers ya enviados en $file línea $line"]);
    exit;
}


if ($conexion->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Conexión fallida: ' . $conexion->connect_error]));
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

// Recibir datos con los nombres que envía el JS

$monto = $_POST['paidAmount'] ?? '';
$metodo = $_POST['paymentMethod'] ?? ''; 
$deudaid = $_POST['debtId'] ?? '';
$usuario = $_SESSION['usuario'] ?? '';
$comentarios = $_POST['comments'] ?? '';


if (empty($monto) || empty($metodo) || empty($usuario) || empty($deudaid)) {
    echo json_encode(['success' => false, 'message' => 'Faltan datos obligatorios']);
    exit;
}

if (!preg_match('/^\d+(\.\d{2})?$/', $monto)) {
    echo json_encode(['success' => false, 'message' => 'Monto inválido']);
    exit;
}

$referencia = $_POST['referenceNumber'] ?? '';
$cedula = $_POST['cedulaInput'] ?? '';  // Cédula enviada desde JS
$cuenta = $_POST['accountNumberInput'] ?? null;
$telefono = $_POST['phoneNumber'] ?? null;
$banco_origen = $_POST['bankOrigin'] ?? '';
$fecha_pago = $_POST['paymentDate'] ?? '';

// Validar formato de cédula venezolana: V-12345678, E-1234567, J-123456789
if (!preg_match('/^[VEJ]-\d{6,9}$/i', $cedula)) {
    echo json_encode(['success' => false, 'message' => 'Cédula inválida. Formato esperado: V-12345678, E-1234567 o J-123456789.']);
    exit;
}

if (empty($fecha_pago) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha_pago)) {
    echo json_encode(['success' => false, 'message' => 'Fecha de pago inválida']);
    exit;
}

// Verificar que se recibió el archivo
if (!isset($_FILES['comprobante'])) {
    echo json_encode(['success' => false, 'message' => 'No se recibió el archivo comprobante']);
    exit;
}



$archivo = $_FILES['comprobante'];
$permitidos = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'application/pdf'];
if (!in_array($archivo['type'], $permitidos)) {
    echo json_encode(['success' => false, 'message' => 'Formato de archivo no permitido']);
    exit;
}

$carpeta = __DIR__ . '/../../Vista/pagos/';
if (!is_dir($carpeta)) mkdir($carpeta, 0755, true);

$nombreArchivo = uniqid('comprobante_') . '_' . basename($archivo['name']);
$rutaArchivo = $carpeta . $nombreArchivo;

if (!move_uploaded_file($archivo['tmp_name'], $rutaArchivo)) {
    echo json_encode(['success' => false, 'message' => 'No se pudo guardar el archivo']);
    exit;
}


$stmt = $conexion->prepare("
    INSERT INTO pagos (
        usuario, metodo_pago, deudaid, fecha_pago,
        banco_origen, referencia, cedula, monto_pagado,
        telefono, archivo_comprobante,comentario,estado
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,'en proceso')
");

$stmt->bind_param(
    "ssissssdsss", 
    $usuario,
    $metodo,
    $deudaid,
    $fecha_pago,
    $banco_origen,
    $referencia,
    $cedula,
    $monto,
    $telefono,
    $nombreArchivo,
    $comentarios
);


if ($stmt->execute()) {
    // Actualizar estado de la deuda a 'en proceso'
    $update = $conexion->prepare("UPDATE deudas SET estado = 'en proceso' WHERE id = ?");
    $update->bind_param("s", $deudaid);
    $updateSuccess = $update->execute();
    $update->close();

    if ($updateSuccess) {
        echo json_encode([
            'success' => true,
            'message' => 'Pago recibido y deuda actualizada correctamente',
            'archivo' => $nombreArchivo
        ]);
    } else {
        echo json_encode([
            'success' => true,
            'message' => 'Pago recibido pero no se pudo actualizar el estado de la deuda',
            'archivo' => $nombreArchivo
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Error al guardar en la base de datos: ' . $stmt->error
    ]);
}


$stmt->close();
$conexion->close();
exit;
?>
