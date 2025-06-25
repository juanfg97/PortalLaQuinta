<?php
function contarPagosPorEdificio($conexion, $estadoPago) {
    if (!isset($_SESSION['Terraza'], $_SESSION['Edificio'])) {
        return 0;
    }

    $terraza = $_SESSION['Terraza'];
    $edificio = $_SESSION['Edificio'];

    // Obtener usuarios asociados a la terraza y edificio
    $stmt = $conexion->prepare("SELECT usuario FROM edificios WHERE Terraza = ? AND Edificio = ?");
    $stmt->bind_param("ss", $terraza, $edificio);
    $stmt->execute();
    $res = $stmt->get_result();

    $usuarios = [];
    while ($row = $res->fetch_assoc()) {
        $usuarios[] = $row['usuario'];
    }
    $stmt->close();

    if (empty($usuarios)) {
        return 0;
    }

    // Crear la parte IN manualmente (con protección básica)
    $inUsuarios = "'" . implode("','", array_map([$conexion, 'real_escape_string'], $usuarios)) . "'";
    
    // Consulta directa con valores escapados
    $sql = "SELECT COUNT(*) as total 
            FROM pagos 
            WHERE usuario IN ($inUsuarios) 
              AND estado = ?";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $estadoPago);
    $stmt->execute();
    
    
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    return (int)($row['total'] ?? 0);
}