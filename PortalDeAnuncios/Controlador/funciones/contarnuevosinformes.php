
<?php

$fechaUltimoLogin = $_SESSION['ultimo_login'] ?? null;
$nuevosInformes = 0;

if ($fechaUltimoLogin) {
    // Usuario ya había iniciado sesión antes: contar informes posteriores
    $stmtInformes = $conexion->prepare("SELECT COUNT(*) as total FROM informes WHERE fecha_creacion > ?");
    $stmtInformes->bind_param("s", $fechaUltimoLogin);
    $stmtInformes->execute();
    $resInformes = $stmtInformes->get_result();
    if ($rowInformes = $resInformes->fetch_assoc()) {
        $nuevosInformes = $rowInformes['total'];
    }
    $stmtInformes->close();
} else {
    // Primer inicio de sesión: contar todos los informes
    $stmtInformes = $conexion->prepare("SELECT COUNT(*) as total FROM informes");
    $stmtInformes->execute();
    $resInformes = $stmtInformes->get_result();
    if ($rowInformes = $resInformes->fetch_assoc()) {
        $nuevosInformes = $rowInformes['total'];
    }
    $stmtInformes->close();
}
?>