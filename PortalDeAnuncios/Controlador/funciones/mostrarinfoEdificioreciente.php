<?php

$terrazaSesion = $_SESSION['Terraza'] ?? null;
$edificioSesion = $_SESSION['Edificio'] ?? null;

if (!$terrazaSesion || !$edificioSesion) {
    echo '<p style="color:red;">Sesión no válida. No se puede mostrar anuncios.</p>';
    exit;
}

$query = "SELECT Id, Titulo, Descripcion, Autor, Imagen, Fecha, Terraza, Edificio 
          FROM anuncios_edificio 
          WHERE Terraza = ? AND Edificio = ?
          ORDER BY Fecha DESC
          LIMIT 3";

$stmt = $conexion->prepare($query);

if (!$stmt) {
    echo '<p>Error en la preparación de la consulta: ' . $conexion->error . '</p>';
    exit;
}

$stmt->bind_param("ss", $terrazaSesion, $edificioSesion); // Ambas son strings, no entero + string
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo '<p style="color: gray;">No hay Información del edificio disponible.</p>';
} else {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="announcement-card mb-3 p-3 border rounded" id="anuncio-' . $row['Id'] . '">';
        echo '<div class="announcement-header d-flex justify-content-between align-items-start mb-2">';
        echo '<h6 class="announcement-title mb-1 fw-semibold">' . htmlspecialchars($row['Titulo']) . '</h6>';
        echo '</div>';

        echo '<div class="announcement-body">';
        echo '<div class="row">';
        echo '<div class="col-md-8">';
        echo '<div class="announcement-content text-muted mb-2" style="font-size: 0.9rem;">';
        echo nl2br(htmlspecialchars($row['Descripcion']));
        echo '</div>';
        echo '<div class="announcement-meta d-flex gap-3" style="font-size: 0.8rem;">';
        echo '<span class="text-muted">📅 ' . formatearFechaHoraLegible($row['Fecha']) . '</span>';
        echo '<span class="text-muted">✍️ ' . htmlspecialchars($row['Autor']) . '</span>';
        echo '<span class="text-muted">👔 Presidente de la junta de condominio</span>';
        echo '</div>';
        echo '</div>';

        if (!empty($row['Imagen'])) {
            echo '<div class="col-md-4 text-end">';
            echo '<img src="' . htmlspecialchars($row['Imagen']) . '" alt="Imagen del anuncio" class="img-fluid rounded" style="max-height: 80px; object-fit: cover;">';
            echo '</div>';
        }

        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
}

$stmt->close();

?>
