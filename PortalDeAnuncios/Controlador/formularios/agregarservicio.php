<?php
header('Content-Type: application/json');

$conexion = new mysqli("localhost", "root", "", "urbanizacion", "3306");
$conexion->set_charset("utf8");

if ($conexion->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Conexión fallida: ' . $conexion->connect_error]));
}

$response = ['success' => false, 'message' => 'Error desconocido.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre_servicio'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $proveedor = trim($_POST['proveedor'] ?? '');
    $contacto = trim($_POST['contacto'] ?? '');
    $categoria = trim($_POST['servicioCategory'] ?? '');

    $errores = [];

    // Validación de campos
    if (empty($nombre)) {
        $errores[] = "El nombre del servicio es obligatorio.";
    } elseif (!preg_match("/^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]{1,255}$/", $nombre)) {
        $errores[] = "El nombre del servicio solo puede contener letras y espacios, máximo 255 caracteres.";
    }

    if (empty($descripcion)) {
        $errores[] = "La descripción es obligatoria.";
    } elseif (strlen($descripcion) < 20 ) {
        $errores[] = "La descripción debe tener al menos 10 caracteres.";
    }

    if (empty($proveedor)) {
        $errores[] = "El proveedor es obligatorio.";
    } elseif (strlen($proveedor) > 150 || strlen($proveedor)<10) {
        $errores[] = "El proveedor deben tener entre 20 y 150 caracteres.";
    }

    if (empty($contacto)) {
        $errores[] = "El contacto es obligatorio.";
    } elseif (strlen($contacto) > 255) {
        $errores[] = "El contacto no puede exceder los 255 caracteres.";
    }

    if (empty($categoria)) {
        $errores[] = "La categoría es obligatoria.";
    }

    if (!empty($errores)) {
        $response['message'] = implode(" ", $errores);
        echo json_encode($response);
        exit;
    }

    date_default_timezone_set('America/Caracas');
    $fecha = date('Y-m-d H:i:s');

    $imagenRuta = null;

    if (isset($_FILES['servicioImage']) && $_FILES['servicioImage']['error'] === UPLOAD_ERR_OK) {
        $directorioDestino = '../../Vista/serviciosimg/';
        if (!is_dir($directorioDestino)) {
            mkdir($directorioDestino, 0755, true);
        }

        $nombreOriginal = basename($_FILES['servicioImage']['name']);
        $extension = strtolower(pathinfo($nombreOriginal, PATHINFO_EXTENSION));
        $nombreUnico = uniqid('servicio_') . '.' . $extension;
        $rutaCompleta = $directorioDestino . $nombreUnico;

        $tipoPermitido = in_array($extension, ['jpg', 'jpeg', 'png', 'gif']);
        $tamanioMaximo = 5 * 1024 * 1024; // 5 MB

        if ($tipoPermitido && $_FILES['servicioImage']['size'] <= $tamanioMaximo) {
            if (move_uploaded_file($_FILES['servicioImage']['tmp_name'], $rutaCompleta)) {
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

    $stmt = $conexion->prepare("INSERT INTO servicios (Nombre, Descripcion, Proveedor, Contacto, Categoria, Fecha, Imagen) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $nombre, $descripcion, $proveedor, $contacto, $categoria, $fecha, $imagenRuta);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = "Servicio registrado exitosamente.";
    } else {
        $response['message'] = "Error al registrar el servicio: " . $conexion->error;
    }

    $stmt->close();
    $conexion->close();
} else {
    $response['message'] = "Acceso no permitido.";
}

echo json_encode($response);
