<?php
session_start();
header('Content-Type: application/json');
include("../conexion_bd_login.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';
    $tipo = $_POST['user-type'] ?? '';

    switch ($tipo) {
        case 'residente':
            loginResidente($usuario, $password);
            $stmt->close();
    $conexion->close();
    exit;
            break;
        case 'presidente_junta':
            loginpresidenteCondominio($usuario, $password);
            $stmt->close();
    $conexion->close();
    exit;
            break;
        case 'presidente_central':
            loginpresidenteCentral($usuario, $password);
            $stmt->close();
    $conexion->close();
    exit;
            break;
        default:
            echo json_encode(['success' => false, 'message' => 'Tipo de usuario inválido.']);
            $stmt->close();
    $conexion->close();
    exit;
    }
    
    
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
            registrarVisita($userData['usuario'], 'residente');

            echo json_encode(['success' => true, 'redirect' => 'Vista/residente/ActualizacionDatos.php']);
        }
        // Si la contraseña ingresada coincide con el hash guardado
        else if (password_verify($password, $hash)) {


            $_SESSION['usuario'] = $userData['usuario'];
            $_SESSION['tipo'] = 'residente';
            $_SESSION['nombre_completo'] = $userData['nombre_completo']; 
            $_SESSION['correo'] = $userData['correo'];                   
            $_SESSION['telefono'] = $userData['telefono'];               
            $_SESSION['Terraza'] = $userData['Terraza'];
            $_SESSION['Edificio'] = $userData['Edificio'];  
            $_SESSION['Piso'] = $userData['Piso'];  
            $_SESSION['Apartamento'] = $userData['Apartamento'];  
            $_SESSION['ultima_modificacion'] = $userData['ultima_modificacion'];              
            registrarVisita($userData['usuario'], 'residente');




            
            echo json_encode(['success' => true, 'redirect' => 'Vista/residente/inicio.php']);
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

     if (password_verify($password, $hash)) {
            $_SESSION['id']= $userData['id'];
            $_SESSION['usuario'] = $userData['usuario'];
            $_SESSION['tipo'] = 'presidente_junta';
            $_SESSION['Terraza'] = $userData['Terraza'];
            $_SESSION['Edificio'] = $userData['Edificio'];
            $_SESSION['nombre_completo'] = $userData['nombre_completo']; 
            $_SESSION['telefono'] = $userData['telefono'];
            $_SESSION['correo'] = $userData['correo'];
            $_SESSION['ultima_modificacion'] = $userData['ultima_modificacion'];  
            $_SESSION["edificiocompleto"] = $userData['Terraza'].$userData['Edificio']; 
            registrarVisita($userData['usuario'], 'presidente_junta');
           

            
            echo json_encode(['success' => true, 'redirect' => 'Vista/p_condominio/PC_inicio.php']);
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

     if (password_verify($password, $hash)) {

        $_SESSION['ultimo_login'] = $userData['ultimo_login'];
        $updateStmt = $conexion->prepare("UPDATE presidente_central SET ultimo_login = NOW() WHERE usuario = ?");
        $updateStmt->bind_param("s", $userData['usuario']);
        $updateStmt->execute();

            $_SESSION['usuario'] = $userData['usuario'];
            $_SESSION['tipo'] = 'presidente_central';
            $_SESSION['correo'] =$userData['correo'];
            $_SESSION['telefono']=$userData['telefono'];
            $_SESSION['nombre_completo']=$userData['nombre_completo'];
            $_SESSION['ultima_modificacion'] = $userData['ultima_modificacion'];    
            registrarVisita($userData['usuario'], 'presidente_central');


            echo json_encode(['success' => true, 'redirect' => 'Vista/p_central/P_inicio.php']);
        }
        else {

            echo json_encode(['success' => false, 'message' => 'Usuario o contraseña incorrectos.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Usuario o contraseña incorrectos.']);
    }

   
    exit;
}

function registrarVisita($usuario, $tipo_usuario) {
    global $conexion;
    $ip = $_SERVER['REMOTE_ADDR'];

    $stmt = $conexion->prepare("INSERT INTO visitas (usuario, tipo_usuario, ip) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $usuario, $tipo_usuario, $ip);
    $stmt->execute();
    $stmt->close();
}

?>
