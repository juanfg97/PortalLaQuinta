<?php

function contarServicios($conexion) {
    $sql = "SELECT COUNT(*) as total FROM servicios";
    $resultado = $conexion->query($sql);
    if ($resultado) {
        $fila = $resultado->fetch_assoc();
        return (int)$fila['total'];
    }
    return 0;
}

?>
