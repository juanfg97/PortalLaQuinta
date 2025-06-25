<?php
header('Content-Type: application/json');
$conexion = new mysqli("localhost", "root", "", "urbanizacion", "3306");
$conexion->set_charset("utf8");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_servicio = $_POST['id_servicio'] ?? null;

    if (!$id_servicio) {
        echo json_encode(['success' => false, 'message' => 'ID del servicio no proporcionado.']);
        exit;
    }

    try {
        // 1. Obtener la ruta de la imagen
        $stmt = $conexion->prepare("SELECT Imagen FROM servicios WHERE Id = ?");
        $stmt->bind_param("i", $id_servicio);
        $stmt->execute();
        $stmt->bind_result($ruta_imagen);
        $stmt->fetch();
        $stmt->close();

        // 2. Eliminar el servicio de la base de datos
        $stmt = $conexion->prepare("DELETE FROM servicios WHERE Id = ?");
        $stmt->bind_param("i", $id_servicio);
        $success = $stmt->execute();
        $stmt->close();

        if ($success) {
            // 3. Eliminar la imagen del servidor
            if ($ruta_imagen) {
                $ruta_completa = realpath(__DIR__ . '/../../' . str_replace('../', '', $ruta_imagen));
                if ($ruta_completa && file_exists($ruta_completa)) {
                    unlink($ruta_completa);
                }
            }

            echo json_encode(['success' => true, 'message' => 'Servicio y foto eliminados correctamente.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se pudo eliminar el servicio.']);
        }

    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }

    $conexion->close();
}
?>
