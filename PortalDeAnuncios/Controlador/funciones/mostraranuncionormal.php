<?php


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
                    echo '<span class="announcement-date">📅 ' . $fechahora = formatearFechaHoraLegible($row['Fecha']) . '</span>';
                    echo '<span class="announcement-author">✍️ ' . htmlspecialchars($row['Autor']) . '</span>';
                echo '</div>';
            echo '</div>';

            if (!empty($row['Imagen'])) {
                echo '<div class="announcement-image">';
                    echo '<img src="' . htmlspecialchars($row['Imagen']) . '" alt="Imagen del anuncio">';
                echo '</div>';
            }
        echo '</div>';

    echo '</div>';
}
?>
