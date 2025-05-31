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
            loginpresidenteCondominio($usuario, $password);
            break;
        case 'presidente_central':
            loginpresidenteCentral($usuario, $password);
            break;
        default:
            echo json_encode(['success' => false, 'message' => 'Tipo de usuario inválido.']);
    }
    
    $stmt->close();
    $conexion->close();
    exit;
}

function loginResidente($usuario, $password) {
    global $conexion;
    $stmt = $conexion->prepare("SELECT * FROM edificios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $userData = $res->fetch_assoc();
        $hash = $userData['password'];

        // Si la contraseña ingresada es igual al nombre de usuario
        if ($userData['usuario'] === $password) {
            $_SESSION['usuario'] = $userData['usuario'];
            $_SESSION['tipo'] = 'residente';
            echo json_encode(['success' => true, 'redirect' => 'Vista/ActualizacionDatos.php']);
        }
        // Si la contraseña ingresada coincide con el hash guardado
        else if (password_verify($password, $hash)) {
            $_SESSION['usuario'] = $userData['usuario'];
            $_SESSION['tipo'] = 'residente';
            echo json_encode(['success' => true, 'redirect' => 'Vista/inicio.php']);
        }
        else {
            echo json_encode(['success' => false, 'message' => 'Usuario o contraseña incorrectos.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Usuario o contraseña incorrectos.']);
    }

    
    exit;
}


function loginpresidenteCondominio($usuario, $password) {
    global $conexion;
    $stmt = $conexion->prepare("SELECT * FROM presidente_condominio WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $userData = $res->fetch_assoc();
        $hash = $userData['password'];

     if ($password === $hash) {
            $_SESSION['usuario'] = $userData['usuario'];
            $_SESSION['tipo'] = 'presidente_central';
            echo json_encode(['success' => true, 'redirect' => 'Vista/PC_inicio.php']);
        }
        else {
            echo json_encode(['success' => false, 'message' => 'Usuario o contraseña incorrectos.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Usuario o contraseña incorrectos.']);
    }

    exit;
}



function loginpresidenteCentral($usuario, $password) {
    global $conexion;
    $stmt = $conexion->prepare("SELECT * FROM presidente_central WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $userData = $res->fetch_assoc();
        $hash = $userData['password'];

     if ($password ===$hash) {
            $_SESSION['usuario'] = $userData['usuario'];
            $_SESSION['tipo'] = 'presidente_central';
            echo json_encode(['success' => true, 'redirect' => 'Vista/P_inicio.php']);
        }
        else {
            echo json_encode(['success' => false, 'message' => 'Usuario o contraseña incorrectos.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Usuario o contraseña incorrectos.']);
    }

   
    exit;
}


?>
