<?php
session_start();
include '../conexion_bd_login.php'; // Conexión
header('Content-Type: application/json');

$presidente_id = $_SESSION['id'] ?? null;
if (!$presidente_id) {
    echo json_encode(['error' => 'No autorizado']);
    exit;
}

$por_pagina = 5;
$pagina_actual = isset($_POST['pagina']) ? (int)$_POST['pagina'] : 1;

$offset = ($pagina_actual - 1) * $por_pagina;

// Total de comunicados
$sql_total = "SELECT COUNT(*) AS total FROM comunicados WHERE Destinatario = 'todos' OR Destinatario = ?";
$stmt_total = $conexion->prepare($sql_total);
$stmt_total->bind_param("s", $presidente_id);
$stmt_total->execute();
$resultado_total = $stmt_total->get_result();
$total_filas = $resultado_total->fetch_assoc()['total'];
$total_paginas = ceil($total_filas / $por_pagina);
$stmt_total->close();

// Comunicados de la página actual
$sql = "SELECT * FROM comunicados 
        WHERE Destinatario = 'todos' OR Destinatario = ? 
        ORDER BY Fecha DESC 
        LIMIT ? OFFSET ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("sii", $presidente_id, $por_pagina, $offset);
$stmt->execute();
$resultado = $stmt->get_result();

$comunicados = [];
while ($comunicado = $resultado->fetch_assoc()) {
    $comunicados[] = $comunicado;
}
$stmt->close();

echo json_encode([
    'comunicados' => $comunicados,
    'pagina_actual' => $pagina_actual,
    'total_paginas' => $total_paginas
]);
?>
