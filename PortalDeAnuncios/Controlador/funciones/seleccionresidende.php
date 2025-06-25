<?php


// Verifica que las variables de sesión estén definidas
if (!isset($_SESSION['Terraza']) || !isset($_SESSION['Edificio'])) {
    echo '<option value="">Error: Faltan datos de sesión</option>';
    exit;
}

$id_terraza = $_SESSION['Terraza'];
$id_edificio = $_SESSION['Edificio'];



// Consulta de usuarios filtrados por terraza y edificio
$stmt = $conexion->prepare("SELECT usuario, nombre_completo FROM edificios WHERE Terraza = ? AND Edificio = ?");
if (!$stmt) {
    echo '<option value="">Error en la consulta preparada</option>';
    exit;
}

$stmt->bind_param("ss", $id_terraza, $id_edificio);
$stmt->execute();
$result = $stmt->get_result();

echo '<option value="todos">Todos los apartamentos</option>';

while ($row = $result->fetch_assoc()) {
    $value = htmlspecialchars($row['usuario']);
    $label = htmlspecialchars($row['usuario'] . " - " . $row['nombre_completo']);
    echo '<option value="' . $value . '">' . $label . '</option>';

 }


$stmt->close();

?>
