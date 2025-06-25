<?php
session_start();
header('Content-Type: application/json');
$conexion = new mysqli("localhost", "root", "", "urbanizacion", "3306");
$conexion->set_charset("utf8");

if ($conexion->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Conexión fallida: ' . $conexion->connect_error]));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_anuncio = $_POST['id_anuncio'] ?? null;
    $terrazaUsuario = $_SESSION['Terraza'] ?? null;
    $edificioUsuario = $_SESSION['Edificio'] ?? null;

    if (!$id_anuncio || !$terrazaUsuario || !$edificioUsuario) {
        echo json_encode(['success' => false, 'message' => 'Faltan datos requeridos.']);
        exit;
    }

    try {
        // 1. Verificar que el anuncio pertenezca al usuario
        $stmt = $conexion->prepare("SELECT Imagen FROM anuncios_edificio WHERE Id = ? AND Terraza = ? AND Edificio = ?");
        $stmt->bind_param("iss", $id_anuncio, $terrazaUsuario, $edificioUsuario);
        $stmt->execute();
        $stmt->bind_result($ruta_imagen);
        $anuncioExiste = $stmt->fetch();
        $stmt->close();

        if (!$anuncioExiste) {
            echo json_encode(['success' => false, 'message' => 'No autorizado o anuncio inexistente.']);
            exit;
        }

        // 2. Eliminar anuncio
        $stmt = $conexion->prepare("DELETE FROM anuncios_edificio WHERE Id = ?");
        $stmt->bind_param("i", $id_anuncio);
        $success = $stmt->execute();
        $stmt->close();

        if ($success) {
            // 3. Eliminar imagen
            if ($ruta_imagen) {
                $ruta_completa = realpath(__DIR__ . '/../../' . str_replace('../', '', $ruta_imagen));
                if ($ruta_completa && file_exists($ruta_completa)) {
                    unlink($ruta_completa);
                }
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
