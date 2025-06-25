<?php

function obtenerCantidadDeudasPorEstado(string $estado) {
    global $conexion;

    if (!isset($_SESSION['usuario'])) {
        return 0;
    }

    $usuario = $_SESSION['usuario'];

    $stmt = $conexion->prepare("SELECT COUNT(*) FROM deudas WHERE usuario = ? AND estado = ?");
    $stmt->bind_param('ss', $usuario, $estado);
    $stmt->execute();
    $stmt->bind_result($total);
    $stmt->fetch();
    $stmt->close();

    return $total;
}
?>
