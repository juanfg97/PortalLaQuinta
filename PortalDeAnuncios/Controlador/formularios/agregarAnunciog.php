<?php
header('Content-Type: application/json');

$conexion = new mysqli("localhost","root","","urbanizacion","3306");
$conexion ->set_charset("utf8"); 

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}


$response = ['success' => false, 'message' => 'Error desconocido.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['announcementTitle'] ?? '');
    $contenido = trim($_POST['announcementContent'] ?? '');
    $autor = trim($_POST['authorName'] ?? '');
    $categoria = trim($_POST['announcementCategory'] ?? '');
    date_default_timezone_set('America/Caracas');
    $fecha = date('Y-m-d H:i:s');

    $imagenRuta = null;

    if (isset($_FILES['announcementImage']) && $_FILES['announcementImage']['error'] === UPLOAD_ERR_OK) {
        $directorioDestino = '../../Vista/anunciosimg/';
        if (!is_dir($directorioDestino)) {
            mkdir($directorioDestino, 0755, true);
        }

        $nombreOriginal = basename($_FILES['announcementImage']['name']);
        $extension = strtolower(pathinfo($nombreOriginal, PATHINFO_EXTENSION));
        $nombreUnico = uniqid('anuncio_') . '.' . $extension;
        $rutaCompleta = $directorioDestino . $nombreUnico;

        $tipoPermitido = in_array($extension, ['jpg', 'jpeg', 'png', 'gif']);
        $tamanioMaximo = 5 * 1024 * 1024; // 5 MB

        if ($tipoPermitido && $_FILES['announcementImage']['size'] <= $tamanioMaximo) {
            if (move_uploaded_file($_FILES['announcementImage']['tmp_name'], $rutaCompleta)) {
                $imagenRuta = $rutaCompleta;
            } else {
                $response['message'] = "Error al guardar la imagen.";
                echo json_encode($response);
                exit;
            }
        } else {
            $response['message'] = "Imagen no válida o demasiado grande.";
            echo json_encode($response);
            exit;
        }
    }

    $stmt = $conexion->prepare("INSERT INTO anunciosg (Titulo, Descripcion, Autor, Categoria, Fecha, Imagen) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $titulo, $contenido, $autor, $categoria, $fecha, $imagenRuta);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = "Anuncio registrado exitosamente.";
    } else {
        $response['message'] = "Error al registrar el anuncio: " . $conexion->error;
    }

    $stmt->close();
    $conexion->close();

} else {
    $response['message'] = "Acceso no permitido.";
}

echo json_encode($response);
