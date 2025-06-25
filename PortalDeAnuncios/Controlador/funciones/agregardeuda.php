<?php
session_start();

$conexion = new mysqli("localhost", "root", "", "urbanizacion", 3306);
$conexion->set_charset("utf8");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if (!isset($_SESSION['Terraza']) || !isset($_SESSION['Edificio'])) {
    echo "error: sesión no definida";
    exit;
}

$terraza = $_SESSION['Terraza'];
$edificio = $_SESSION['Edificio'];

$usuario = trim($_POST['apartamento'] ?? '');
$tipo = trim($_POST['tipoDeuda'] ?? '');
$monto = trim($_POST['monto'] ?? '');
$fecha = trim($_POST['fecha'] ?? '');
$descripcion = trim($_POST['descripcion'] ?? '');

// Validaciones
$errores = [];

if (empty($usuario)) {
    $errores[] = "El campo 'usuario' es obligatorio.";
} elseif ($usuario !== 'todos' && strlen($usuario) > 20) {
    $errores[] = "El usuario no debe superar los 20 caracteres.";
}

$tiposPermitidos = ['condominio', 'otros'];
if (!in_array($tipo, $tiposPermitidos)) {
    $errores[] = "Tipo de deuda inválido.";
}

if (!is_numeric($monto) || $monto <= 0 || $monto > 99999999.99) {
    $errores[] = "El monto debe ser un número positivo menor a 100 millones.";
}

if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
    $errores[] = "La fecha de vencimiento no tiene un formato válido.";
}

if ($tipo === 'otros' && empty($descripcion)) {
    $errores[] = "La descripción es obligatoria cuando el tipo de deuda es 'otros'.";
} elseif (strlen($descripcion) > 1000) {
    $errores[] = "La descripción no debe exceder los 1000 caracteres.";
}

if (!empty($errores)) {
    echo "error: " . implode(" | ", $errores);
    exit;
}

// Obtener fecha actual
$fecha_creacion = date('Y-m-d');

if ($usuario === 'todos') {
    $stmtUsuarios = $conexion->prepare("SELECT usuario FROM edificios WHERE Terraza = ? AND Edificio = ?");
    $stmtUsuarios->bind_param("ss", $terraza, $edificio);
    $stmtUsuarios->execute();
    $resultUsuarios = $stmtUsuarios->get_result();

    if ($resultUsuarios->num_rows === 0) {
        echo "error: no se encontraron usuarios para asignar deuda";
        exit;
    }

    $stmtInsert = $conexion->prepare("INSERT INTO deudas (usuario, tipo_deuda, monto, fecha_vencimiento, descripcion, fecha_creacion, estado) VALUES (?, ?, ?, ?, ?, ?, 'pendiente')");

    while ($row = $resultUsuarios->fetch_assoc()) {
        $usr = $row['usuario'];
        $stmtInsert->bind_param("ssdsss", $usr, $tipo, $monto, $fecha, $descripcion, $fecha_creacion);
        $stmtInsert->execute();
    }

    $stmtInsert->close();
    $stmtUsuarios->close();

    echo "ok";
} else {
    $stmt = $conexion->prepare("INSERT INTO deudas (usuario, tipo_deuda, monto, fecha_vencimiento, descripcion, fecha_creacion, estado) VALUES (?, ?, ?, ?, ?, ?, 'pendiente')");
    $stmt->bind_param("ssdsss", $usuario, $tipo, $monto, $fecha, $descripcion, $fecha_creacion);

    if ($stmt->execute()) {
        echo "ok";
    } else {
        echo "error: no se pudo insertar la deuda.";
    }
    $stmt->close();
}

$conexion->close();
?>
