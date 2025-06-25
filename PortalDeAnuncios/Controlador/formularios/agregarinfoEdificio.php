<?php
session_start();
header('Content-Type: application/json');

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "urbanizacion", "3306");
$conexion->set_charset("utf8");

if ($conexion->connect_error) {
    die(json_encode([
        'success' => false,
        'message' => 'Conexión fallida: ' . $conexion->connect_error
    ]));
}

$response = ['success' => false, 'message' => 'Error desconocido.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['announcementTitle'] ?? '');
    $contenido = trim($_POST['announcementContent'] ?? '');
    date_default_timezone_set('America/Caracas');
    $fecha = date('Y-m-d H:i:s');

    if (strlen($titulo) < 5 || strlen($contenido) < 20) {
        $response['message'] = "Datos inválidos. Verifique título y contenido.";
        echo json_encode($response);
        exit;
    }

    // Obtener valores de sesión
    $terraza = $_SESSION['Terraza'] ?? null;
    $edificio = $_SESSION['Edificio'] ?? null;
    $autor = $_SESSION['nombre_completo'] ?? 'Autor desconocido';

    if (!$terraza || !$edificio || !preg_match('/^[A-Z]$/', $edificio) || $terraza < 1 || $terraza > 13) {
        $response['message'] = "Datos de sesión inválidos (Terraza o Edificio)";
        echo json_encode($response);
        exit;
    }

    $imagenRuta = null;

    if (isset($_FILES['announcementImage']) && $_FILES['announcementImage']['error'] === UPLOAD_ERR_OK) {
        $directorioDestino = '../../Vista/anunciosEdificio/';
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

    // 🟢 Insertar con autor incluido
    $stmt = $conexion->prepare("INSERT INTO anuncios_edificio (Terraza, Edificio, Titulo, Descripcion, Autor, Fecha, Imagen) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $terraza, $edificio, $titulo, $contenido, $autor, $fecha, $imagenRuta);

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
?>
