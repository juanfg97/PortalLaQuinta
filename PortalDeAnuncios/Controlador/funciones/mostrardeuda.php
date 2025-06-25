<?php


if (!isset($_SESSION['usuario'])) {
    echo "Error: usuario no autenticado.";
    exit;
}

$usuario = $_SESSION['usuario'];


$sql = "SELECT id ,tipo_deuda, monto, fecha_vencimiento, descripcion, estado,Motivo FROM deudas WHERE usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

$deudas = [];

while ($row = $result->fetch_assoc()) {
    $deudas[] = $row;
}

$stmt->close();
?>
