<?php
session_start();

header('Content-Type: application/json');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conexion = new mysqli("localhost", "root", "", "urbanizacion", 3306);
    $conexion->set_charset("utf8");

    $remitente = 'Desconocido';
    if (isset($_SESSION['Terraza']) && isset($_SESSION['Edificio'])) {
        $remitente = $_SESSION['Terraza'] . $_SESSION['Edificio'];
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Acceso no permitido.');
    }

    $tipo = trim($_POST['tipoInforme'] ?? '');
    $asunto = trim($_POST['asuntoInforme'] ?? '');
    $descripcion = trim($_POST['descripcionInforme'] ?? '');
    $prioridad = trim($_POST['prioridadInforme'] ?? '');

    // Validaciones de campos obligatorios
    if (!$tipo || !$asunto || !$descripcion || !$prioridad) {
        throw new Exception('Faltan datos obligatorios.');
    }

    // Validaciones de longitud
    if (strlen($asunto) > 100) {
        throw new Exception('El asunto no debe superar los 100 caracteres.');
    }
    if (strlen($descripcion) < 10) {
        throw new Exception('La descripción debe tener al menos 10 caracteres.');
    }
    if (strlen($descripcion) > 1000) {
        throw new Exception('La descripción no debe superar los 1000 caracteres.');
    }

    date_default_timezone_set('America/Caracas');
    $fecha = date('Y-m-d H:i:s');

    // Insertar informe
    $stmt = $conexion->prepare("INSERT INTO informes (tipo, asunto, descripcion, prioridad, remitente, fecha_creacion) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $tipo, $asunto, $descripcion, $prioridad, $remitente, $fecha);
    $stmt->execute();
    $informeId = $stmt->insert_id;
    $stmt->close();

    $directorioDestino = '../../Vista/informeadjunto/';
    if (!is_dir($directorioDestino) && !mkdir($directorioDestino, 0755, true)) {
        throw new Exception('No se pudo crear la carpeta para adjuntos.');
    }
    if (!is_writable($directorioDestino)) {
        throw new Exception('La carpeta para adjuntos no tiene permisos de escritura.');
    }

    $allowedExtensions = [
        'pdf',
        // Word
        'doc', 'docx', 'dot', 'dotx',
        // Excel
        'xls', 'xlsx', 'xlsm', 'xlsb',
        // PowerPoint
        'ppt', 'pptx', 'pps', 'ppsx',
        // Imágenes
        'jpg', 'jpeg', 'png'
    ];
    $maxFileSize = 5 * 1024 * 1024; // 5 MB

    if (isset($_FILES['adjuntos']) && is_array($_FILES['adjuntos']['error'])) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);

        foreach ($_FILES['adjuntos']['error'] as $key => $error) {
            if ($error === UPLOAD_ERR_OK) {
                $tmpName = $_FILES['adjuntos']['tmp_name'][$key];
                $nombreOriginal = basename($_FILES['adjuntos']['name'][$key]);
                $extension = strtolower(pathinfo($nombreOriginal, PATHINFO_EXTENSION));
                $tamano = $_FILES['adjuntos']['size'][$key];

                // Validar extensión
                if (!in_array($extension, $allowedExtensions)) {
                    throw new Exception("Archivo no permitido: $nombreOriginal");
                }
                // Validar tamaño
                if ($tamano > $maxFileSize) {
                    throw new Exception("Archivo muy grande: $nombreOriginal");
                }

                $nombreUnico = uniqid('adjunto_') . '.' . $extension;
                $rutaCompleta = $directorioDestino . $nombreUnico;

                if (!move_uploaded_file($tmpName, $rutaCompleta)) {
                    throw new Exception("Error al guardar el archivo: $nombreOriginal");
                }

                $rutaRelativa = 'informeadjunto/' . $nombreUnico; // Ruta relativa para acceso web
                $tipoMime = finfo_file($finfo, $rutaCompleta) ?: 'application/octet-stream';

                $stmt2 = $conexion->prepare("INSERT INTO archivos_adjuntos (informe_id, nombre_archivo, ruta_archivo, tipo_mime, tamano, fecha_subida) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt2->bind_param('isssis', $informeId, $nombreOriginal, $rutaRelativa, $tipoMime, $tamano, $fecha);
                $stmt2->execute();
                $stmt2->close();
            } elseif ($error !== UPLOAD_ERR_NO_FILE) {
                throw new Exception('Error en la carga del archivo.');
            }
        }

        finfo_close($finfo);
    }

    echo json_encode(['estado' => 'ok', 'mensaje' => 'Informe y archivos guardados correctamente.']);
} catch (Exception $e) {
    echo json_encode(['estado' => 'error', 'mensaje' => $e->getMessage()]);
} finally {
    if (isset($conexion) && $conexion instanceof mysqli) {
        $conexion->close();
    }
}
