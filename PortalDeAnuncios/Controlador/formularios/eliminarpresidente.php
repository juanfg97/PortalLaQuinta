<?php
session_start();
header('Content-Type: application/json');

// Verificar que el usuario esté logueado
if (empty($_SESSION['usuario'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Usuario no autorizado'
    ]);
    exit();
}

// Verificar que sea una petición POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'success' => false,
        'message' => 'Método no permitido'
    ]);
    exit();
}

// Verificar que se recibieron los datos necesarios
if (!isset($_POST['terraza']) || !isset($_POST['edificio']) || !isset($_POST['action']) || $_POST['action'] !== 'delete') {
    echo json_encode([
        'success' => false,
        'message' => 'Datos incompletos'
    ]);
    exit();
}

$terraza = trim($_POST['terraza']);
$edificio = trim($_POST['edificio']);

if (empty($terraza) || empty($edificio)) {
    echo json_encode([
        'success' => false,
        'message' => 'Terraza y edificio son requeridos'
    ]);
    exit();
}

try {
    include '../conexion_bd_login.php';
    
    // Verificar que el presidente existe antes de eliminarlo
    $checkQuery = "SELECT nombre_completo FROM presidente_condominio WHERE Terraza = ? AND Edificio = ?";
    $checkStmt = $conexion->prepare($checkQuery);
    $checkStmt->bind_param("ss", $terraza, $edificio);
    $checkStmt->execute();
    $result = $checkStmt->get_result();
    
    if ($result->num_rows === 0) {
        echo json_encode([
            'success' => false,
            'message' => 'El presidente no existe'
        ]);
        exit();
    }
    
    $presidente = $result->fetch_assoc();
    
    // Eliminar el presidente
    $deleteQuery = "DELETE FROM presidente_condominio WHERE Terraza = ? AND Edificio = ?";
    $deleteStmt = $conexion->prepare($deleteQuery);
    $deleteStmt->bind_param("ss", $terraza, $edificio);
    
    if ($deleteStmt->execute()) {
        if ($deleteStmt->affected_rows > 0) {
            echo json_encode([
                'success' => true,
                'message' => 'Presidente eliminado correctamente',
                'presidente' => $presidente['nombre_completo']
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'No se pudo eliminar el presidente'
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error en la base de datos: ' . $conexion->error
        ]);
    }
    
    $deleteStmt->close();
    $checkStmt->close();
    $conexion->close();
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error del servidor: ' . $e->getMessage()
    ]);
}
?>