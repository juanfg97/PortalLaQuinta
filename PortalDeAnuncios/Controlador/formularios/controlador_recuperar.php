<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);

header('Content-Type: application/json');
session_start();

// Verificar método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['exito' => false, 'mensaje' => 'Método no permitido']);
    exit;
}

// Leer datos JSON y hacer logs para depurar
$inputRaw = file_get_contents('php://input');
error_log("RAW input recibido: " . $inputRaw);

$input = json_decode($inputRaw, true);
error_log("Input decodificado: " . print_r($input, true));

$usuario = isset($input['usuario']) ? trim($input['usuario']) : '';
$correo = isset($input['correo']) ? trim($input['correo']) : '';

error_log("Usuario recibido: '$usuario'");
error_log("Correo recibido: '$correo'");

// Validar formato del usuario: 1A-11
if (!preg_match('/^[0-9][A-Z]-[0-9]{2}$/', $usuario)) {
    echo json_encode(['exito' => false, 'mensaje' => 'Formato de usuario inválido', 'campo' => 'usuario']);
    exit;
}

// Validar correo
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['exito' => false, 'mensaje' => 'Correo inválido', 'campo' => 'correo']);
    exit;
}

// Configuración de SendGrid
$SENDGRID_API_KEY = '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'; // Reemplaza con tu API key real
$FROM_EMAIL = 'juanmanuelfg9@gmail.com'; // Reemplaza con tu email verificado en SendGrid
$FROM_NAME = 'Portal La Quinta';

// Conexión a la base de datos
$host = 'localhost';
$dbname = 'urbanizacion';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES 'utf8'");
} catch (PDOException $e) {
    echo json_encode(['exito' => false, 'mensaje' => 'Error de conexión a la base de datos']);
    exit;
}

// Función para limpiar datos
function limpiarDatos($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$usuario = limpiarDatos($usuario);
$correo = limpiarDatos($correo);

// Verificar si el correo existe en la base de datos con comparación case-insensitive y sin espacios
$stmt = $pdo->prepare('SELECT usuario FROM edificios WHERE LOWER(TRIM(correo)) = LOWER(?)');
$stmt->execute([trim($correo)]);
$usuarioBD = $stmt->fetchColumn();

error_log("Usuario BD encontrado para correo '$correo': " . var_export($usuarioBD, true));

if (!$usuarioBD) {
    echo json_encode(['exito' => false, 'mensaje' => 'Correo no registrado', 'campo' => 'correo']);
    exit;
}

// Comparación usuario recibida vs usuario en BD, case-insensitive y sin espacios
if (strcasecmp(trim($usuarioBD), trim($usuario)) !== 0) {
    echo json_encode(['exito' => false, 'mensaje' => 'Usuario y correo no coinciden', 'campo' => 'usuario']);
    exit;
}

// Generar código de verificación
$codigo = rand(100000, 999999);

// Guardar código y correo en sesión
$_SESSION['codigo_verificacion'] = $codigo;
$_SESSION['correo_verificacion'] = $correo;
$_SESSION['codigo_expira'] = time() + (15 * 60); // Expira en 15 minutos

$asunto = 'Código de verificación - Portal La Quinta';
$contenidoHTML = "<p>Tu código de verificación es: <strong>$codigo</strong></p>";
$contenidoTexto = "Tu código de verificación es: $codigo";

// Enviar el correo
$resultado = enviarCorreoSendGrid(
    $SENDGRID_API_KEY,
    $FROM_EMAIL,
    $FROM_NAME,
    $correo,
    $usuario,
    $asunto,
    $contenidoHTML,
    $contenidoTexto
);

if ($resultado === true) {
    echo json_encode(['exito' => true, 'mensaje' => 'Código enviado correctamente']);
} else {


    error_log("Error al enviar correo: " . $resultado);

    echo json_encode([
        'exito' => false,
        'mensaje' => 'No se pudo enviar el correo',
        'detalle' => $resultado
    ]);
}

// Función para enviar correo con SendGrid
function enviarCorreoSendGrid($apiKey, $fromEmail, $fromName, $toEmail, $toName, $subject, $htmlContent, $textContent = null) {
    $url = 'https://api.sendgrid.com/v3/mail/send';
$data = [
    'personalizations' => [[
        'to' => [[ 'email' => $toEmail, 'name' => $toName ]],
        'subject' => $subject
    ]],
    'from' => [ 'email' => $fromEmail, 'name' => $fromName ],
    'content' => []
];

if ($textContent) {
    $data['content'][] = [ 'type' => 'text/plain', 'value' => $textContent ];
}

$data['content'][] = [ 'type' => 'text/html', 'value' => $htmlContent ];


    $headers = [
        'Authorization: Bearer ' . $apiKey,
        'Content-Type: application/json'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // para desarrollo local

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    if ($curlError) {
        return 'cURL error: ' . $curlError;
    }

    if ($httpCode < 200 || $httpCode >= 300) {
        return "HTTP $httpCode - Respuesta: $response";
    }

    return true;
}
