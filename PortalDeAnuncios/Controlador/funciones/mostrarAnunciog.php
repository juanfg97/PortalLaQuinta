<?php
$conexion = new mysqli("localhost","root","","urbanizacion","3306");
$conexion ->set_charset("utf8"); 

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$query = "SELECT Id, Titulo, Descripcion, Autor, Categoria, Imagen, Fecha 
          FROM anunciosg 
          ORDER BY Fecha DESC";
$stmt = $conexion->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

include 'Mostrarfecha.php';

while ($row = $result->fetch_assoc()) {
    echo '<div class="announcement-card" id="anuncio-' . $row['Id'] . '">';
    
        echo '<div class="announcement-header">';
            echo '<h3 class="announcement-title">' . htmlspecialchars($row['Titulo']) . '</h3>';
            echo '<span class="announcement-badge">' . htmlspecialchars($row['Categoria']) . '</span>';
        echo '</div>';
        
        echo '<div class="announcement-body">';
            echo '<div class="announcement-text">';
                echo '<div class="announcement-content">' . nl2br(htmlspecialchars($row['Descripcion'])) . '</div>';
                echo '<div class="announcement-meta">';
                    echo '<span class="announcement-date">📅 ' . $fechahora =formatearFechaHoraLegible($row['Fecha']) . '</span>';
                    echo '<span class="announcement-author">✍️ ' . htmlspecialchars($row['Autor']) . '</span>';
                echo '</div>';
            echo '</div>';

            if (!empty($row['Imagen'])) {
                echo '<div class="announcement-image">';
                    echo '<img src="' . htmlspecialchars($row['Imagen']) . '" alt="Imagen del anuncio">';
                echo '</div>';
            }
        echo '</div>';

        // Botón Eliminar con JS
        echo '<div style="text-align: right; margin-top: 10px;">';
             echo '<button class="btn btn-danger btn-azul" onclick="modificarAnuncio(' . $row['Id'] . ')">✏️ Modificar</button> ';
            echo '<button class="btn btn-danger" onclick="eliminarAnuncio(' . $row['Id'] . ')">🗑 Eliminar</button>';
        echo '</div>';
        

    echo '</div>';
}
?>
