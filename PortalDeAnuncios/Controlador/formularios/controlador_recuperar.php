<?php

require $_SERVER['DOCUMENT_ROOT'] . '/PortalDeAnuncios/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/PortalDeAnuncios/controlador/conexion_bd_login.php'; // Aquí la conexión mysqli

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: application/json');
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['exito' => false, 'mensaje' => 'Método no permitido']);
    exit;
}

$inputRaw = file_get_contents('php://input');


$input = json_decode($inputRaw, true);

$usuario = isset($input['usuario']) ? trim($input['usuario']) : '';
$correo = isset($input['correo']) ? trim($input['correo']) : '';
$tipo   = isset($input['tipo']) ? trim($input['tipo']) : '';



if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['exito' => false, 'mensaje' => 'Correo inválido', 'campo' => 'correo']);
    exit;
}

$tiposValidos = ['edificios', 'presidente_condominio', 'presidente_central'];
if (!in_array($tipo, $tiposValidos)) {
    echo json_encode(['exito' => false, 'mensaje' => 'Tipo inválido']);
    exit;
}

function limpiarDatos($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$usuario = limpiarDatos($usuario);
$correo = limpiarDatos($correo);

// Validar el formato del usuario
$usuarioRegexNormal = '/^[a-zA-Z0-9]+$/';
$usuarioRegexEspecial = '/^[0-9]{1,2}[A-Z]-[0-9]{2}$/';

if (!preg_match($usuarioRegexNormal, $usuario) && !preg_match($usuarioRegexEspecial, $usuario)) {
    echo json_encode([
        'exito' => false,
        'mensaje' => 'Formato de usuario inválido',
        'campo' => 'usuario'
    ]);
    exit;
}
$usuarioBD = null;

function buscarUsuarioPorCorreo($conexion, $correo, $tipo) {
    switch ($tipo) {
        case 'edificios':
            $tabla = 'edificios';
            break;
        case 'presidente_condominio':
            $tabla = 'presidente_condominio';
            break;
        case 'presidente_central':
            $tabla = 'presidente_central';
            break;
        default:
            return false;
    }

    $correo = strtolower(trim($correo));
    $query = "SELECT usuario FROM $tabla WHERE LOWER(TRIM(correo)) = ?";

    if ($stmt = $conexion->prepare($query)) {
        $stmt->bind_param('s', $correo);
        $stmt->execute();

        $usuarioEncontrado = null; // Cambié el nombre aquí para evitar conflicto
        $stmt->bind_result($usuarioEncontrado);
        $stmt->fetch();
        $stmt->close();

        return $usuarioEncontrado ?: false;
    } else {
        error_log("Error preparando consulta: " . $conexion->error);
        return false;
    }
}

$usuarioBD = buscarUsuarioPorCorreo($conexion, $correo, $tipo);
error_log("Usuario BD encontrado para correo '$correo': " . var_export($usuarioBD, true));

if (!$usuarioBD) {
    echo json_encode(['exito' => false, 'mensaje' => 'Correo no registrado', 'campo' => 'correo']);
    exit;
}

if (strcasecmp(trim($usuarioBD), trim($usuario)) !== 0) {
    echo json_encode(['exito' => false, 'mensaje' => 'Usuario y correo no coinciden', 'campo' => 'usuario']);
    exit;
}

// Código de verificación
$codigo = rand(100000, 999999);
$_SESSION['codigo_verificacion'] = $codigo;
$_SESSION['correo_verificacion'] = $correo;
$_SESSION['codigo_expira'] = time() + (15 * 60);

$asunto = 'Código de verificación - Portal La Quinta';
$contenidoHTML = '
<div style="font-family: Arial, sans-serif; padding: 20px;">
    <img src="cid:logoCID" alt="Logo" style="width: 150px; margin-bottom: 20px;">
    <h2 style="color: #333;">Código de verificación</h2>
    <p style="font-size: 16px;">Hola Residente del Apartamento<strong> ' . htmlspecialchars($usuario) . '</strong>,</p>
    <p style="font-size: 16px;">Su código de verificación es:</p>
    <div style="font-size: 24px; font-weight: bold; background-color: #f0f0f0; padding: 10px 20px; display: inline-block; margin: 15px 0;">' . $codigo . '</div>
    <p style="font-size: 14px; color: #777;">Este código expirará en 15 minutos.</p>
</div>
';

$contenidoTexto = "Hola Residente del Apartamento $usuario,\nTu código de verificación es: $codigo\nEste código expirará en 15 minutos.";

$resultado = enviarCorreoPHPMailer(
    'juanmanuelfg9@gmail.com',
    'Portal La Quinta',
    $correo,
    $usuario,
    $asunto,
    $contenidoHTML,
    $contenidoTexto
);

if ($resultado === true) {
    echo json_encode(['exito' => true, 'mensaje' => 'Código enviado correctamente']);
    $_SESSION['usuario'] = $usuario;
    $_SESSION['tipo'] =$tipo; 
} else {
    error_log("Error al enviar correo: " . $resultado);
    echo json_encode([
        'exito' => false,
        'mensaje' => 'No se pudo enviar el correo',
        'detalle' => $resultado
    ]);
}

function enviarCorreoPHPMailer($fromEmail, $fromName, $toEmail, $toName, $subject, $htmlContent, $textContent = null) {
    $mail = new PHPMailer(true);
    try {
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'juanmanuelfg9@gmail.com';
        $mail->Password = 'spbi hbuq lcpo ixbi';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom($fromEmail, $fromName);
        $mail->addAddress($toEmail, $toName);

        $logoPath = $_SERVER['DOCUMENT_ROOT'] . '/PortalDeAnuncios/Vista/Img/logo.png';
        if (file_exists($logoPath)) {
            $mail->addEmbeddedImage($logoPath, 'logoCID');
        }

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $htmlContent;
        $mail->AltBody = $textContent ?? strip_tags($htmlContent);

        $mail->send();
        return true;
    } catch (Exception $e) {
        return "PHPMailer error: " . $mail->ErrorInfo;
    }
}
?>
