<?php

if (empty($_SESSION['usuario'])) {
    // Redirigir si no hay sesión activa
    session_destroy();
    header('Location: ../index.php');
    exit();
}

$stmt = $conexion->prepare("SELECT COUNT(*) AS total FROM edificios WHERE Terraza = ? AND Edificio = ?");
$stmt->bind_param("ss", $_SESSION['Terraza'], $_SESSION['Edificio']);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado) {
    $fila = $resultado->fetch_assoc();
    $Residentes = $fila['total'];
    echo $Residentes;
} else {
    $Residentes = 0; // En caso de error
    echo $Residentes;

}

$stmt->close();

?>