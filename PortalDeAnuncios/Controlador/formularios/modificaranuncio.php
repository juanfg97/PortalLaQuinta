<?php
header('Content-Type: application/json');
include '../conexion_bd_login.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_anuncio'] ?? null;
    $titulo = $_POST['announcementTitle'] ?? '';
    $descripcion = $_POST['announcementContent'] ?? '';
    $autor = $_POST['authorName'] ?? '';
    $categoria = $_POST['announcementCategory'] ?? '';

    if (!$id) {
        echo json_encode(['success' => false, 'message' => 'ID del anuncio no proporcionado']);
        exit;
    }

    // Validaciones básicas
    if (strlen(trim($titulo)) < 5 || strlen(trim($descripcion)) < 20 || strlen(trim($autor)) < 3) {
        echo json_encode(['success' => false, 'message' => 'Datos inválidos']);
        exit;
    }

    // Ruta para guardar imagenes (ajustar a la que usas)
    $uploadDir = '../../Vista/anunciosimg/';

    // Obtener anuncio actual para saber si tiene imagen
    $sqlGet = "SELECT Imagen FROM anunciosg WHERE Id = ?";
    $stmtGet = $conexion->prepare($sqlGet);
    $stmtGet->bind_param('i', $id);
    $stmtGet->execute();
    $resultGet = $stmtGet->get_result();
    $currentImage = null;
    if ($row = $resultGet->fetch_assoc()) {
        $currentImage = $row['Imagen'];
    }
    $stmtGet->close();

    $imagePath = $currentImage; // por defecto mantenemos la imagen actual

    // Si se subió nueva imagen, guardarla
    if (isset($_FILES['announcementImage']) && $_FILES['announcementImage']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['announcementImage']['tmp_name'];
        $fileName = $_FILES['announcementImage']['name'];
        $fileSize = $_FILES['announcementImage']['size'];
        $fileType = $_FILES['announcementImage']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $maxFileSize = 5 * 1024 * 1024; // 5MB

        if (!in_array($fileExtension, $allowedExtensions)) {
            echo json_encode(['success' => false, 'message' => 'Formato de imagen no permitido']);
            exit;
        }

        if ($fileSize > $maxFileSize) {
            echo json_encode(['success' => false, 'message' => 'El tamaño de la imagen supera el límite permitido (5MB)']);
            exit;
        }

        $newFileName = uniqid('anuncio_', true) . '.' . $fileExtension;
        $destPath = $uploadDir . $newFileName;

        if (!move_uploaded_file($fileTmpPath, $destPath)) {
            echo json_encode(['success' => false, 'message' => 'Error al subir la imagen']);
            exit;
        }

        // Opcional: eliminar la imagen antigua para no dejar basura en el servidor
        if ($currentImage && file_exists($currentImage)) {
            unlink($currentImage);
        }

        // Guardamos la nueva ruta relativa para la base de datos (ajusta según cómo guardas las rutas)
        $imagePath = $destPath;
    }

    // Actualizar datos en la BD y actualizar la fecha a la fecha actual
    $sqlUpdate = "UPDATE anunciosg SET Titulo = ?, Descripcion = ?, Autor = ?, Categoria = ?, Imagen = ?, Fecha = NOW() WHERE Id = ?";
    $stmtUpdate = $conexion->prepare($sqlUpdate);
    $stmtUpdate->bind_param('sssssi', $titulo, $descripcion, $autor, $categoria, $imagePath, $id);

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
