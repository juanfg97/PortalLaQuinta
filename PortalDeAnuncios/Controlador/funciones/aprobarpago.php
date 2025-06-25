<?php
header('Content-Type: application/json');

// Recibir datos del POST
$data = json_decode(file_get_contents("php://input"), true);
if (!isset($data['pago_id'], $data['deuda_id'])) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    exit;
}

$pagoId = intval($data['pago_id']);
$deudaId = intval($data['deuda_id']);

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "urbanizacion", "3306");
$conexion->set_charset("utf8");
if ($conexion->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión']);
    exit;
}

// Obtener el monto del pago
$stmtPago = $conexion->prepare("SELECT monto_pagado FROM pagos WHERE id = ?");
$stmtPago->bind_param("i", $pagoId);
$stmtPago->execute();
$stmtPago->bind_result($montoPagado);
if (!$stmtPago->fetch()) {
    echo json_encode(['success' => false, 'message' => 'Pago no encontrado']);
    $stmtPago->close();
    exit;
}
$stmtPago->close();

// Obtener el monto y estado actual de la deuda
$stmtDeuda = $conexion->prepare("SELECT monto FROM deudas WHERE id = ?");
$stmtDeuda->bind_param("i", $deudaId);
$stmtDeuda->execute();
$stmtDeuda->bind_result($montoDeuda);
if (!$stmtDeuda->fetch()) {
    echo json_encode(['success' => false, 'message' => 'Deuda no encontrada']);
    $stmtDeuda->close();
    exit;
}
$stmtDeuda->close();

// Calcular nuevo monto
$nuevoMonto = floatval($montoDeuda) - floatval($montoPagado);
$estadoDeuda = ($nuevoMonto <= 0) ? 'completo' : 'pendiente';
if ($nuevoMonto < 0) $nuevoMonto = 0; // Evitar negativos

// Iniciar transacción
$conexion->begin_transaction();

try {
    // Actualizar deuda con nuevo monto y estado
    $updateDeuda = $conexion->prepare("UPDATE deudas SET monto = ?, estado = ? WHERE id = ?");
    $updateDeuda->bind_param("dsi", $nuevoMonto, $estadoDeuda, $deudaId);
    $updateDeuda->execute();
    $updateDeuda->close();

    // Marcar pago como aprobado
    $updatePago = $conexion->prepare("UPDATE pagos SET estado = 'aprobado' WHERE id = ?");
    $updatePago->bind_param("i", $pagoId);
    $updatePago->execute();
    $updatePago->close();

    // Confirmar cambios
    $conexion->commit();

    echo json_encode([
        'success' => true,
        'nuevo_monto_deuda' => $nuevoMonto,
        'estado_deuda' => $estadoDeuda
    ]);
} catch (Exception $e) {
    $conexion->rollback();
    echo json_encode(['success' => false, 'message' => 'Error al aprobar pago']);
}

$conexion->close();
