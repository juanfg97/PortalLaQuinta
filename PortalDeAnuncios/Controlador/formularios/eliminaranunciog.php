<?php
header('Content-Type: application/json');


error_reporting(E_ERROR | E_PARSE);

$conexion = new mysqli("localhost", "root", "", "urbanizacion", "3306");
$conexion->set_charset("utf8");

if ($conexion->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Conexión fallida: ' . $conexion->connect_error]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_anuncio = $_POST['id_anuncio'];

    try {
 
        $stmt = $conexion->prepare("SELECT Imagen FROM anunciosg WHERE Id = ?");
        $stmt->bind_param("i", $id_anuncio);
        $stmt->execute();
        $stmt->bind_result($ruta_imagen);
        $stmt->fetch();
        $stmt->close();

   
        $stmt = $conexion->prepare("DELETE FROM anunciosg WHERE Id = ?");
        $stmt->bind_param("i", $id_anuncio);
        $success = $stmt->execute();
        $stmt->close();

        if ($success) {
           
            if (!empty($ruta_imagen) && $ruta_imagen !== '') {
         
                $ruta_limpia = str_replace('../', '', $ruta_imagen);
                $ruta_completa = realpath(__DIR__ . '/../../' . $ruta_limpia);
                
                if ($ruta_completa && 
                    file_exists($ruta_completa) && 
                    is_file($ruta_completa) && 
                    strpos($ruta_completa, realpath(__DIR__ . '/../../')) === 0) {
                    
                    @unlink($ruta_completa); 
                }
            }

            echo json_encode(['success' => true, 'message' => 'Anuncio eliminado correctamente.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se pudo eliminar el anuncio.']);
        }

    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }

    $conexion->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
?>