<?php

header('Content-Type: application/json');
include '../conexion_bd_login.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_servicio'] ?? null;
    $nombre = $_POST['nombre_servicio'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $proveedor = $_POST['proveedor'] ?? '';
    $categoria = $_POST['servicioCategory'] ?? '';
    $contacto = $_POST['contacto'] ?? '';
error_log("Nombre: '$nombre'");
error_log("Descripción: '$descripcion'");
error_log("Proveedor: '$proveedor'");

    if (!$id) {
        echo json_encode(['success' => false, 'message' => 'ID del servicio no proporcionado']);
        exit;
    }

    // Validaciones básicas
    if (strlen(trim($nombre)) < 5 || strlen(trim($descripcion)) < 20 || strlen(trim($proveedor)) < 3) {
        echo json_encode(['success' => false, 'message' => 'Datos inválidos']);
        exit;
    }

    $uploadDir = '../../Vista/serviciosimg/';

    // Obtener imagen actual
    $sqlGet = "SELECT Imagen FROM servicios WHERE Id = ?";
    $stmtGet = $conexion->prepare($sqlGet);
    $stmtGet->bind_param('i', $id);
    $stmtGet->execute();
    $resultGet = $stmtGet->get_result();
    $currentImage = null;
    if ($row = $resultGet->fetch_assoc()) {
        $currentImage = $row['Imagen'];
    }
    $stmtGet->close();

    $imagePath = $currentImage;

    if (isset($_FILES['servicioImage']) && $_FILES['servicioImage']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['servicioImage']['tmp_name'];
        $fileName = $_FILES['servicioImage']['name'];
        $fileSize = $_FILES['servicioImage']['size'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $maxFileSize = 5 * 1024 * 1024;

        if (!in_array($fileExtension, $allowedExtensions)) {
            echo json_encode(['success' => false, 'message' => 'Formato de imagen no permitido']);
            exit;
        }

        if ($fileSize > $maxFileSize) {
            echo json_encode(['success' => false, 'message' => 'La imagen supera los 5MB']);
            exit;
        }

        $newFileName = uniqid('servicio_', true) . '.' . $fileExtension;
        $destPath = $uploadDir . $newFileName;

        if (!move_uploaded_file($fileTmpPath, $destPath)) {
            echo json_encode(['success' => false, 'message' => 'Error al subir la imagen']);
            exit;
        }

        if ($currentImage && file_exists($currentImage)) {
            unlink($currentImage);
        }

        $imagePath = $destPath;
    }

    $sqlUpdate = "UPDATE servicios SET Nombre = ?, Descripcion = ?, Proveedor = ?, Categoria = ?,Contacto = ?, Imagen = ?, Fecha = NOW() WHERE Id = ?";
    $stmtUpdate = $conexion->prepare($sqlUpdate);
    $stmtUpdate->bind_param('ssssssi', $nombre, $descripcion, $proveedor, $categoria,$contacto, $imagePath, $id);

    if ($stmtUpdate->execute()) {
        echo json_encode(['success' => true, 'message' => 'Servicio modificado correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al modificar el servicio']);
    }

    $stmtUpdate->close();
    $conexion->close();

} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
?>
