

<?php

function contarAnunciosedificio($conexion) {
    if (!isset($_SESSION['Terraza'], $_SESSION['Edificio'])) {
        return 0;
    }

    $terraza = $_SESSION['Terraza'];
    $edificio = $_SESSION['Edificio'];

    $stmt = $conexion->prepare("SELECT COUNT(*) as totalE FROM anuncios_edificio WHERE Terraza = ? AND Edificio = ?");
    if (!$stmt) {
        return 0;
    }

    $stmt->bind_param("ss", $terraza, $edificio);
    $stmt->execute();

    // Obtener el resultado como array asociativo
    $resultado = $stmt->get_result();
    if ($resultado && $fila = $resultado->fetch_assoc()) {
        return (int)$fila['totalE'];
    }

    return 0;
}



function contarAnunciosmesEdificio($conexion) {
    if (!isset($_SESSION['Terraza'], $_SESSION['Edificio'])) {
        return 0;
    }

    $terraza = $_SESSION['Terraza'];
    $edificio = $_SESSION['Edificio'];

    $stmt = $conexion->prepare("
        SELECT COUNT(*) as total 
        FROM anuncios_edificio 
        WHERE YEAR(Fecha) = YEAR(CURDATE()) 
          AND MONTH(Fecha) = MONTH(CURDATE()) 
          AND Terraza = ? 
          AND Edificio = ?
    ");

    if (!$stmt) {
        return 0;
    }

    $stmt->bind_param("ss", $terraza, $edificio);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado && $fila = $resultado->fetch_assoc()) {
        return (int)$fila['total'];
    }

    return 0;
}
