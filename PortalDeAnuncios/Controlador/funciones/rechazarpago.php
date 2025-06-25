<?php
header('Content-Type: application/json');

// Recibir datos del POST
$data = json_decode(file_get_contents("php://input"), true);
if (!isset($data['pago_id'], $data['deuda_id'], $data['motivo'])) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    exit;
}

$pagoId = intval($data['pago_id']);
$deudaId = intval($data['deuda_id']);
$motivo = trim($data['motivo']);

if ($motivo === '') {
    echo json_encode(['success' => false, 'message' => 'El motivo es obligatorio']);
    exit;
}

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "urbanizacion", "3306");
$conexion->set_charset("utf8");
if ($conexion->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión']);
    exit;
}

// Iniciar transacción
$conexion->begin_transaction();

try {
    // Actualizar pago: estado a rechazado
    $updatePago = $conexion->prepare("UPDATE pagos SET estado = 'rechazado' WHERE id = ?");
    $updatePago->bind_param("i", $pagoId);
    $updatePago->execute();
    if ($updatePago->affected_rows === 0) {
        throw new Exception("Pago no encontrado o no actualizado");
    }
    $updatePago->close();

    // Actualizar deuda: estado a pendiente y guardar motivo en columna comentario (o la que uses)
    $updateDeuda = $conexion->prepare("UPDATE deudas SET estado = 'pendiente', Motivo = ? WHERE id = ?");
    $updateDeuda->bind_param("si", $motivo, $deudaId);
    $updateDeuda->execute();
    if ($updateDeuda->affected_rows === 0) {
        throw new Exception("Deuda no encontrada o no actualizada");
    }
    $updateDeuda->close();

    // Confirmar transacción
    $conexion->commit();

    echo json_encode([
        'success' => true,
        'message' => 'Pago rechazado y deuda actualizada correctamente'
    ]);
} catch (Exception $e) {
    $conexion->rollback();
    echo json_encode(['success' => false, 'message' => 'Error al rechazar pago o actualizar deuda']);
}

$conexion->close();
