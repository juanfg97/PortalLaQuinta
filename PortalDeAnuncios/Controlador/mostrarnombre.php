<?php

include("conexion_bd_login.php");



$usuario = $_SESSION['usuario'];

// Buscar el nombre en la base de datos
$stmt = $conexion->prepare("SELECT nombre_completo FROM edificios WHERE usuario = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $datos = $resultado->fetch_assoc();
    $nombre = htmlspecialchars($datos['nombre_completo']);
    echo "$nombre";
} else {
    echo "Usuario no encontrado.";
}

$stmt->close();
$conexion->close();
?>
