<?php


// Limitar resultados a 5 anuncios más recientes (aumenté de 3 a 5)
$query = "SELECT Id, Titulo, Descripcion, Autor, Categoria, Imagen, Fecha 
          FROM anunciosg 
          ORDER BY Fecha DESC
          LIMIT 3";
$stmt = $conexion->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

include 'Mostrarfecha.php';

// Verificar si hay anuncios
if ($result->num_rows === 0) {
    echo '<div class="text-center text-muted py-4">';
    echo '<p class="mb-0">No hay anuncios recientes para mostrar.</p>';
    echo '<small>Los nuevos anuncios aparecerán aquí.</small>';
    echo '</div>';
} else {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="announcement-card mb-3 p-3 border rounded" id="anuncio-' . $row['Id'] . '">';
        
            echo '<div class="announcement-header d-flex justify-content-between align-items-start mb-2">';
                echo '<h6 class="announcement-title mb-1 fw-semibold">' . htmlspecialchars($row['Titulo']) . '</h6>';
                echo '<span class="badge bg-secondary text-white">' . htmlspecialchars($row['Categoria']) . '</span>';
            echo '</div>';
            
            echo '<div class="announcement-body">';
                echo '<div class="row">';
                    echo '<div class="col-md-8">';
                        echo '<div class="announcement-content text-muted mb-2" style="font-size: 0.9rem;">';
                            // Limitar descripción a 150 caracteres
                            $descripcion = htmlspecialchars($row['Descripcion']);
                            if (strlen($descripcion) > 150) {
                                $descripcion = substr($descripcion, 0, 150) . '...';
                            }
                            echo nl2br($descripcion);
                        echo '</div>';
                        echo '<div class="announcement-meta d-flex gap-3" style="font-size: 0.8rem;">';
                            echo '<span class="text-muted">📅 ' . formatearFechaHoraLegible($row['Fecha']) . '</span>';
                            echo '<span class="text-muted">✍️ ' . htmlspecialchars($row['Autor']) . '</span>';
                        echo '</div>';
                    echo '</div>';

                    if (!empty($row['Imagen'])) {
                        echo '<div class="col-md-4">';
                            echo '<div class="announcement-image text-end">';
                                echo '<img src="' . htmlspecialchars($row['Imagen']) . '" alt="Imagen del anuncio" class="img-fluid rounded" style="max-height: 80px; object-fit: cover;">';
                            echo '</div>';
                        echo '</div>';
                    }
                echo '</div>';
            echo '</div>';

        echo '</div>';
    }
}

$stmt->close();

?>