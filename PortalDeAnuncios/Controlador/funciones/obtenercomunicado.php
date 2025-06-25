<?php
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "ERROR_COMUNICADO: ID no válido o no proporcionado.";
    exit;
}

$id = intval($_GET['id']);
$conexion = new mysqli("localhost", "root", "", "urbanizacion", 3306);
$conexion->set_charset("utf8");

if ($conexion->connect_error) {
    echo "ERROR_COMUNICADO: Error de conexión a la base de datos.";
    exit;
}

$stmt = $conexion->prepare("SELECT Asunto, Fecha, Mensaje, Prioridad FROM comunicados WHERE Id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($comunicado = $resultado->fetch_assoc()) {
    $prioridad = ucfirst($comunicado['Prioridad']);
    echo "<h5 class='mb-3 text-primary fw-bold'>{$comunicado['Asunto']}</h5>";
    echo "<p><strong>Fecha:</strong> " . date("d/m/Y H:i", strtotime($comunicado['Fecha'])) . "</p>";
    echo "<p><strong>Prioridad:</strong> $prioridad</p>";
    echo "<hr>";
    echo "<p>{$comunicado['Mensaje']}</p>";
} else {
    echo "ERROR_COMUNICADO: Comunicado no encontrado.";
}

$stmt->close();
$conexion->close();
?>
