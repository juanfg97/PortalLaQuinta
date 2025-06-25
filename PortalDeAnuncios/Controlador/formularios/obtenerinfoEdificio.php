<?php
header('Content-Type: application/json');
include '../conexion_bd_login.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'] ?? null;

    if (!$id) {
        echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
        exit;
    }

    $sql = "SELECT Id, Titulo, Descripcion, Imagen, Fecha FROM anuncios_edificio WHERE Id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($anuncio = $result->fetch_assoc()) {
        echo json_encode(['success' => true, 'anuncio' => $anuncio]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Anuncio no encontrado']);
    }

    $stmt->close();
    $conexion->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
