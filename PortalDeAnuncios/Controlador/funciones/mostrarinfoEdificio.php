<?php


$terrazaSesion = $_SESSION['Terraza'] ?? null;
$edificioSesion = $_SESSION['Edificio'] ?? null;

if (!$terrazaSesion || !$edificioSesion) {
    echo '<p style="color:red;">Sesión no válida. No se puede mostrar anuncios.</p>';
    exit;
}

// Consulta segura con bind_param
$query = "SELECT Id, Titulo, Descripcion, Autor,Imagen, Fecha, Terraza, Edificio 
          FROM anuncios_edificio 
          WHERE Terraza = ? AND Edificio = ?
          ORDER BY Fecha DESC";

$stmt = $conexion->prepare($query);

if (!$stmt) {
    echo '<p>Error en la preparación de la consulta.</p>';
    exit;
}

$stmt->bind_param("is", $terrazaSesion, $edificioSesion);
$stmt->execute();
$result = $stmt->get_result();

include 'Mostrarfecha.php';

if ($result->num_rows === 0) {
    echo '<p style="color: gray;">No hay Información del edificio disponible.</p>';
} else {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="announcement-card" id="anuncio-' . $row['Id'] . '">';
        
            echo '<div class="announcement-header">';
                echo '<h3 class="announcement-title">' . htmlspecialchars($row['Titulo']) . '</h3>';
               
            echo '</div>';
            
            echo '<div class="announcement-body">';
                echo '<div class="announcement-text">';
                    echo '<div class="announcement-content">' . nl2br(htmlspecialchars($row['Descripcion'])) . '</div>';
                    echo '<div class="announcement-meta">';
                        echo '<span class="announcement-date">📅 ' . formatearFechaHoraLegible($row['Fecha']) . '</span><br>';
                        echo '<span class="announcement-author">✍️ ' . htmlspecialchars($row['Autor']) . '</span><br>';
                        echo '<span class="announcement-role">👔 Presidente de la junta de condominio</span>';
                    echo '</div>';
                echo '</div>';

                if (!empty($row['Imagen'])) {
                    echo '<div class="announcement-image">';
                        echo '<img src="' . htmlspecialchars($row['Imagen']) . '" alt="Imagen del anuncio">';
                    echo '</div>';
                }
            echo '</div>';

            echo '<div style="text-align: right; margin-top: 10px;">';
                echo '<button class="btn btn-danger btn-azul" onclick="modificarAnuncio(' . $row['Id'] . ')">✏️ Modificar</button> ';
                echo '<button class="btn btn-danger" onclick="eliminarAnuncio(' . $row['Id'] . ')">🗑 Eliminar</button>';
            echo '</div>';

        echo '</div>';
    }
}

$stmt->close();

?>
