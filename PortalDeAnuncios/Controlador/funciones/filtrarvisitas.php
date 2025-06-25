<?php
header('Content-Type: application/json');

include("../conexion_bd_login.php");

// Validar conexión
if (!isset($conexion) || $conexion === null) {
    echo json_encode(['error' => 'No se pudo conectar a la base de datos.']);
    exit();
}

// Obtener filtros desde POST
$year = $_POST['year'] ?? null;
$month = $_POST['month'] ?? null;

// Interpretar las opciones "Todoslosaños" y "Todoslosmeses"
if ($year === "Todoslosaños" || empty($year)) {
    $year = null;
} else {
    $year = intval($year);
}

if ($month === "Todoslosmeses" || empty($month)) {
    $month = null;
} else {
    $month = intval($month);
}

$visitas_residentes = 0;
$visitas_presidentes = 0;

// Función para contar visitas según tipo
function contarVisitas($conexion, $tipo_usuario, $year, $month) {
    $sql = "SELECT COUNT(*) AS total FROM visitas WHERE tipo_usuario = ?";
    $params = [$tipo_usuario];
    $types = "s";

    if ($year !== null) {
        $sql .= " AND YEAR(fecha) = ?";
        $params[] = $year;
        $types .= "i";
    }
    if ($month !== null) {
        $sql .= " AND MONTH(fecha) = ?";
        $params[] = $month;
        $types .= "i";
    }

    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        return 0;
    }

    $stmt->bind_param($types, ...$params);

    if (!$stmt->execute()) {
        $stmt->close();
        return 0;
    }

    $result = $stmt->get_result();
    if ($result) {
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['total'] ?? 0;
    } else {
        $stmt->close();
        return 0;
    }
}

// Ejecutar para cada tipo de usuario
$visitas_residentes = contarVisitas($conexion, 'residente', $year, $month);
$visitas_presidentes = contarVisitas($conexion, 'presidente_junta', $year, $month);

// Respuesta JSON
echo json_encode([
    'visitas_residentes' => $visitas_residentes,
    'visitas_presidentes' => $visitas_presidentes
]);
?>
