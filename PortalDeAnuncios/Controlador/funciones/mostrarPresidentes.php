<?php
header('Content-Type: application/json');

// Iniciar sesión si es necesario
session_start();
include '../conexion_bd_login.php';
try {
    
    if ($conexion->connect_error) {
        throw new Exception("Conexión fallida: " . $conexion->connect_error);
    }
    
    
    $query = "SELECT Terraza, Edificio, nombre_completo, correo, telefono 
              FROM presidente_condominio 
              ORDER BY CAST(Terraza AS UNSIGNED), Edificio";
    
    $stmt = $conexion->prepare($query);
    
    if (!$stmt) {
        throw new Exception("Error al preparar la consulta: " . $conexion->error);
    }
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    $presidentes = [];
    
    while ($row = $result->fetch_assoc()) {
        $presidentes[] = [
            'Terraza' => $row['Terraza'],
            'Edificio' => $row['Edificio'],
            'nombre_completo' => $row['nombre_completo'],
            'correo' => $row['correo'],
            'telefono' => $row['telefono']
        ];
    }
    
    // Cerrar conexiones
    $stmt->close();
    
    
    // Enviar respuesta JSON
    echo json_encode([
        'success' => true,
        'presidentes' => $presidentes,
        'total' => count($presidentes)
    ]);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>