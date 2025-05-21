<?php
session_start();

header('Content-Type: application/json');
include("conexion_bd_login.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';
    $tipo = $_POST['user-type'] ?? '';

    switch ($tipo) {
        case 'residente':
            loginResidente($usuario, $password);
            break;
        case 'presidente_junta':
            loginGenerico($usuario, $password, 'presidente_junta', 'presidente_junta_inicio.php');
            break;
        case 'presidente_central':
            loginGenerico($usuario, $password, 'presidente_central', 'presidente_central_inicio.php');
            break;
        default:
            echo json_encode(['success' => false, 'message' => 'Tipo de usuario inválido.']);
    }
}

function loginResidente($usuario, $password) {
    global $conexion;
    $stmt = $conexion->prepare("SELECT * FROM edificios WHERE usuario = ? AND password = ?");
    $stmt->bind_param("ss", $usuario, $password);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $userData = $res->fetch_assoc();

        // Datos de sesión para residentes
        $_SESSION['usuario'] = $userData['usuario'];
        $_SESSION['tipo'] = 'residente';
        $_SESSION['nombre'] = $userData['nombre'] ?? '';
        
        $redirect = ($usuario === $password)
            ? 'Probando.php'
            : 'inicio.php';

        echo json_encode(['success' => true, 'redirect' => $redirect]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Usuario o contraseña incorrectos.']);
    }
    exit;
}

function loginGenerico($usuario, $password, $tabla, $redirectDestino) {
    global $conexion;
    $stmt = $conexion->prepare("SELECT * FROM $tabla WHERE usuario = ? AND password = ?");
    $stmt->bind_param("ss", $usuario, $password);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        // Datos de sesión para otros usuarios
        $_SESSION['usuario'] = $usuario;
        $_SESSION['tipo'] = $tabla;
        
        echo json_encode(['success' => true, 'redirect' => $redirectDestino]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Usuario o contraseña incorrectos.']);
    }
    exit;
}
?>