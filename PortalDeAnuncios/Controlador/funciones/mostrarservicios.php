<?php
$conexion = new mysqli("localhost","root","","urbanizacion","3306");
$conexion ->set_charset("utf8");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$query = "SELECT Id, Nombre, Descripcion, Proveedor,Contacto, Categoria, Imagen, Fecha
           FROM servicios
           ORDER BY Fecha DESC";
$stmt = $conexion->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

include 'Mostrarfecha.php';

while ($row = $result->fetch_assoc()) {
   echo '<div class="announcement-card" data-categoria="' . htmlspecialchars($row['Categoria']) . '" id="servicio-' . $row['Id'] . '">';
 
    
    echo '<div class="announcement-header">';
        echo '<h3 class="announcement-title">' . htmlspecialchars($row['Nombre']) . '</h3>';
        echo '<span class="announcement-badge">' . htmlspecialchars($row['Categoria']) . '</span>';
    echo '</div>';
    
    echo '<div class="announcement-body">';
        echo '<div class="announcement-text">';
            echo '<div class="announcement-content">' . nl2br(htmlspecialchars($row['Descripcion'])) . '</div>';
            
            // OPCIÓN 1: Separar en dos filas
            echo '<div class="announcement-meta">';
                echo '<div class="meta-row">';
                    echo '<span class="announcement-date">📅 ' . $fechahora =formatearFechaHoraLegible($row['Fecha']) . '</span>';
                    echo '<span class="announcement-author">✍️ ' . htmlspecialchars($row['Proveedor']) . '</span>';
                echo '</div>';
                echo '<div class="meta-row">';
                    echo '<span class="announcement-contact">📞 ' . htmlspecialchars($row['Contacto']) . '</span>';
                echo '</div>';
            echo '</div>';
            
        echo '</div>';
        
        if (!empty($row['Imagen'])) {
            echo '<div class="announcement-image">';
                echo '<img src="' . htmlspecialchars($row['Imagen']) . '" alt="Imagen del servicio">';
            echo '</div>';
        }
    echo '</div>';
    
    // Botón Eliminar con JS
    echo '<div style="text-align: right; margin-top: 10px;">';
        echo '<button class="btn btn-danger btn-azul" onclick="modificarservicio(' . $row['Id'] . ')">✏️ Modificar</button> ';
        echo '<button class="btn btn-danger" onclick="eliminarservicio(' . $row['Id'] . ')">🗑 Eliminar</button>';
    echo '</div>';
    
    echo '</div>';
}
?>