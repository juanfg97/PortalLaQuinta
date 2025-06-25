
<?php


function contarPresidentes($conexion) {
    $sql = "SELECT COUNT(*) as total FROM presidente_condominio";
    $resultado = $conexion->query($sql);
    if ($resultado) {
        $fila = $resultado->fetch_assoc();
        return (int)$fila['total'];
    }
    return 0;
}
?>