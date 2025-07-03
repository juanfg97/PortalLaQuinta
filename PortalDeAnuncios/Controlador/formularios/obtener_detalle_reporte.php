<?php
session_start();
header('Content-Type: application/json');
include '../conexion_bd_login.php';

if (!isset($_GET['id'])) {
    echo json_encode(["success" => false, "message" => "ID no especificado."]);
    exit;
}

$id = intval($_GET['id']);
$stmt = $conexion->prepare("SELECT * FROM reportes WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$reporte = $result->fetch_assoc();

if ($reporte) {
    echo json_encode(["success" => true, "data" => $reporte]);
} else {
    echo json_encode(["success" => false, "message" => "Reporte no encontrado."]);
}
