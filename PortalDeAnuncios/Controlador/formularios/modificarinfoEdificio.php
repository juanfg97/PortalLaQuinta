<?php
header('Content-Type: application/json');
include '../conexion_bd_login.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_anuncio'] ?? null;
    $titulo = trim($_POST['announcementTitle'] ?? '');
    $descripcion = trim($_POST['announcementContent'] ?? '');

    if (!$id) {
        echo json_encode(['success' => false, 'message' => 'ID del anuncio no proporcionado']);
        exit;
    }

    // Validaciones básicas
    if (strlen($titulo) < 5 || strlen($descripcion) < 20) {
        echo json_encode(['success' => false, 'message' => 'Datos inválidos. Verifique título y contenido.']);
        exit;
    }

    $uploadDir = '../../Vista/anunciosEdificio/';

    // Obtener la imagen actual
    $stmtGet = $conexion->prepare("SELECT Imagen FROM anuncios_edificio WHERE Id = ?");
    $stmtGet->bind_param('i', $id);
    $stmtGet->execute();
    $resultGet = $stmtGet->get_result();
    $currentImage = $resultGet->fetch_assoc()['Imagen'] ?? null;
    $stmtGet->close();

    $imagePath = $currentImage;

    // Si se subió una nueva imagen
    if (isset($_FILES['announcementImage']) && $_FILES['announcementImage']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['announcementImage']['tmp_name'];
        $fileName = $_FILES['announcementImage']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $maxFileSize = 5 * 1024 * 1024;

        if (!in_array($fileExtension, $allowedExtensions)) {
            echo json_encode(['success' => false, 'message' => 'Formato de imagen no permitido']);
            exit;
        }

        if ($_FILES['announcementImage']['size'] > $maxFileSize) {
            echo json_encode(['success' => false, 'message' => 'La imagen supera el tamaño máximo permitido (5MB)']);
            exit;
        }

        $newFileName = uniqid('anuncio_', true) . '.' . $fileExtension;
        $destPath = $uploadDir . $newFileName;

        if (!move_uploaded_file($fileTmpPath, $destPath)) {
            echo json_encode(['success' => false, 'message' => 'Error al subir la nueva imagen']);
            exit;
        }

        // Eliminar imagen anterior si existe
        if ($currentImage && file_exists($currentImage)) {
            unlink($currentImage);
        }

        $imagePath = $destPath;
    }

    // Actualizar anuncio
    $stmtUpdate = $conexion->prepare("UPDATE anuncios_edificio SET Titulo = ?, Descripcion = ?, Imagen = ?, Fecha = NOW() WHERE Id = ?");
    $stmtUpdate->bind_param('sssi', $titulo, $descripcion, $imagePath, $id);

    if ($stmtUpdate->execute()) {
        echo json_encode(['success' => true, 'message' => 'Anuncio modificado correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al modificar el anuncio']);
    }

    $stmtUpdate->close();
    $conexion->close();

} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
