<?php 
header('Content-Type: application/json'); 
include '../conexion_bd_login.php';  

// Obtener datos del formulario
$terraza = $_POST['terraza'] ?? ''; 
$edificio = $_POST['edificio'] ?? ''; 
$usuario = $_POST['usuario'] ?? ''; 
$nombreCompleto = $_POST['nombreCompleto'] ?? ''; 
$correo = $_POST['correo'] ?? ''; 
$telefono = $_POST['telefono'] ?? ''; 
$password = $_POST['password'] ?? '';  

// Validación básica de campos
if (empty($terraza) || empty($edificio) || empty($usuario) || empty($nombreCompleto) || empty($correo) || empty($telefono) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios']);
    exit;
}

try {
    // Verificar que la combinación Terraza + Edificio EXISTE en la tabla edificios
    $queryExisteEdificio = "SELECT COUNT(*) as total FROM edificios WHERE Terraza = ? AND Edificio = ?";
    $stmtExisteEdificio = $conexion->prepare($queryExisteEdificio);
    $stmtExisteEdificio->bind_param('ss', $terraza, $edificio);
    $stmtExisteEdificio->execute();
    $resultExisteEdificio = $stmtExisteEdificio->get_result();
    $rowEdificio = $resultExisteEdificio->fetch_assoc();

    if ($rowEdificio['total'] == 0) {
        echo json_encode([
            'success' => false,
            'message' => 'No existe este edificio en la urbanizacion'
        ]);
        exit;
    }

    // Verificar que no exista ya un presidente para la misma combinación Terraza + Edificio
    $queryCombinacion = "SELECT COUNT(*) as total FROM presidente_condominio WHERE Terraza = ? AND Edificio = ?";
    $stmtCombinacion = $conexion->prepare($queryCombinacion);
    $stmtCombinacion->bind_param('ss', $terraza, $edificio);
    $stmtCombinacion->execute();
    $resultCombinacion = $stmtCombinacion->get_result();
    $row = $resultCombinacion->fetch_assoc();

    if ($row['total'] > 0) {
        echo json_encode([
            'success' => false, 
            'message' => 'Ya existe un presidente para el edificio '.$terraza.$edificio
        ]);
        exit;
    }

    // Hash de la contraseña
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Insertar nuevo presidente
    $queryInsertar = "INSERT INTO presidente_condominio (Terraza, Edificio, usuario, nombre_completo, correo, telefono, password)
                      VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmtInsertar = $conexion->prepare($queryInsertar);
    $stmtInsertar->bind_param('sssssss', $terraza, $edificio, $usuario, $nombreCompleto, $correo, $telefono, $passwordHash);

    if ($stmtInsertar->execute()) {
        echo json_encode([
            'success' => true, 
            'message' => 'Presidente registrado exitosamente'
        ]);
    } else {
        echo json_encode([
            'success' => false, 
            'message' => 'Error al registrar: '.$conexion->error
        ]);
    }

} catch (Exception $e) {
    echo json_encode([
        'success' => false, 
        'message' => 'Error en el servidor: '.$e->getMessage()
    ]);
}

$conexion->close();
