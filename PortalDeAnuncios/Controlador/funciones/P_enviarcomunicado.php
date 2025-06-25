<?php
$conexion = new mysqli("localhost", "root", "", "urbanizacion", 3306);
$conexion->set_charset("utf8");

if ($conexion->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Error de conexión']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if (
    empty($data['destinatario']) ||
    empty($data['asunto']) ||
    empty($data['mensaje']) ||
    empty($data['prioridad'])
) {
    http_response_code(400);
    echo json_encode(['error' => 'Faltan datos obligatorios']);
    exit;
}

$destinatario = $data['destinatario']; // Puede ser 'todos' o un ID numérico
$asunto = $data['asunto'];
$mensaje = $data['mensaje'];
$prioridad = $data['prioridad'];
$fecha = date("Y-m-d H:i:s");

// Validación: si no es "todos", verificar que el ID exista
if ($destinatario !== 'todos') {
    $id_escapado = $conexion->real_escape_string($destinatario);
    $res = $conexion->query("SELECT id FROM presidente_condominio WHERE id = '$id_escapado' LIMIT 1");
    if (!$res || $res->num_rows === 0) {
        http_response_code(400);
        echo json_encode(['error' => 'ID de presidente no válido']);
        exit;
    }
}

// Insertar con el valor tal como viene (ID o 'todos')
$stmt = $conexion->prepare("INSERT INTO comunicados (Destinatario, Asunto, Mensaje, Prioridad, Fecha) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $destinatario, $asunto, $mensaje, $prioridad, $fecha);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Error al guardar comunicado']);
}

$stmt->close();
$conexion->close();
?>
