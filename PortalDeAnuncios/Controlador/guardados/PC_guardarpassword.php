<?php


session_start();
include("../conexion_bd_login.php");
header('Content-Type: application/json');

// Validar método
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

// Verificar sesión
if (!isset($_SESSION['usuario'])) {
    echo json_encode(['success' => false, 'message' => 'Sesión no iniciada']);
    exit;
}

// Obtener y validar datos JSON
$input = json_decode(file_get_contents('php://input'), true);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(['success' => false, 'message' => 'JSON inválido']);
    exit;
}

$password = isset($input['currentPassword']) ? trim($input['currentPassword']) : '';
$newPass = isset($input['newPassword']) ? trim($input['newPassword']) : '';
$confirm = isset($input['confirmPassword']) ? trim($input['confirmPassword']) : '';
$ultima_modificacion = date('y-m-d');



$errores = [];

// Validaciones
if (empty($password) || empty($newPass) || empty($confirm) ) {
    $errores[] = 'No debe haber campos vacios';
}
if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/", $newPass)) {
    $errores[] = 'La contraseña no es valida';
}
if (!empty($errores)) {
    echo json_encode(['success' => false, 'message' => implode('<br>', $errores)]);
    exit;
}

// Validar contraseña actual
$usuario = $_SESSION['usuario'];
$query = "SELECT password FROM presidente_condominio WHERE usuario = ?";
$consulta = $conexion->prepare($query);
$consulta->bind_param("s", $usuario);
$consulta->execute();
$result = $consulta->get_result();

if ($result->num_rows !== 1) {
    echo json_encode(['success' => false, 'message' => 'Usuario no encontrado']);
    exit;
}

$row = $result->fetch_assoc();

$hashedPassword = $row['password'];
error_log("Hash de BD: " . $hashedPassword);
error_log("Password ingresada: " . $password);

if (!password_verify($password, $hashedPassword)) {
    echo json_encode(['success' => false, 'message' => 'La contraseña actual es incorrecta']);
    exit;
}

try {

    $passwordHash = password_hash($newPass, PASSWORD_DEFAULT);
    
     
    $stmt = $conexion->prepare("UPDATE presidente_condominio SET  password= ?, ultima_modificacion=? WHERE usuario = ?");
    if (!$stmt) {
        throw new Exception("Error al preparar la consulta: " . $conexion->error);
    }

    $stmt->bind_param("sss", $passwordHash,$ultima_modificacion, $_SESSION['usuario']);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        
        $_SESSION['ultima_modificacion'] = $ultima_modificacion;
        echo json_encode([
            'success' => true,
            'message' => 'Contraseña actualizada correctamente'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'No se realizaron cambios.'
        ]);
    }

    $stmt->close();
    $conexion->close();

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error en la base de datos: ' . $e->getMessage()
    ]);
}
