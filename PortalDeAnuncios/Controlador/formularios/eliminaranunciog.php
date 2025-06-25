<?php
header('Content-Type: application/json');
$conexion = new mysqli("localhost","root","","urbanizacion","3306");
$conexion ->set_charset("utf8"); 

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_anuncio = $_POST['id_anuncio'];

    try {
        // 1. Obtener la ruta de la imagen
        $stmt = $conexion->prepare("SELECT Imagen FROM anunciosg WHERE Id = ?");
        $stmt->bind_param("i", $id_anuncio);
        $stmt->execute();
        $stmt->bind_result($ruta_imagen);
        $stmt->fetch();
        $stmt->close();

        // 2. Eliminar el anuncio de la base de datos
        $stmt = $conexion->prepare("DELETE FROM anunciosg WHERE Id = ?");
        $stmt->bind_param("i", $id_anuncio);
        $success = $stmt->execute();
        $stmt->close();

        if ($success) {
            // 3. Eliminar la imagen físicamente del servidor
            $ruta_completa = realpath(__DIR__ . '/../../' . str_replace('../', '', $ruta_imagen));

            if ($ruta_completa && file_exists($ruta_completa)) {
                unlink($ruta_completa);
            }

            echo json_encode(['success' => true, 'message' => 'Anuncio y foto eliminados correctamente.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se pudo eliminar el anuncio.']);
        }

    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }

    $conexion->close();
}
?>
