
<?php

function formatearFechaLegible(string $fecha_y_m_d): string
{
    // Array para traducir los nombres de los meses de inglés a español
    $meses_espanol = [
        'January'   => 'enero',
        'February'  => 'febrero',
        'March'     => 'marzo',
        'April'     => 'abril',
        'May'       => 'mayo',
        'June'      => 'junio',
        'July'      => 'julio',
        'August'    => 'agosto',
        'September' => 'septiembre',
        'October'   => 'octubre',
        'November'  => 'noviembre',
        'December'  => 'diciembre'
    ];

    try {
        // 1. Crear un objeto DateTime a partir de la cadena de fecha 'YYYY-MM-DD'
        $fecha_obj = new DateTime($fecha_y_m_d);

        // 2. Extraer el día sin ceros iniciales ('j'), el nombre del mes en inglés ('F') y el año ('Y')
        $dia        = $fecha_obj->format('j');
        $mes_ingles = $fecha_obj->format('F');
        $año        = $fecha_obj->format('Y');

        // 3. Traducir el nombre del mes a español usando el array
        // Si por alguna razón el mes en inglés no está en el array, se usa el mismo nombre en inglés como fallback.
        $mes_espanol = $meses_espanol[$mes_ingles] ?? $mes_ingles;

        // 4. Construir la cadena de fecha final
        $fecha_formateada = $dia . ' de ' . $mes_espanol . ' de ' . $año;

        return $fecha_formateada;

    } catch (Exception $e) {
        // Manejar errores si la fecha de entrada no es válida
        error_log("Error al formatear fecha: " . $e->getMessage()); // Para depuración
        return "Fecha inválida"; // Mensaje que se mostrará al usuario
    }
}
function formatearFechaHoraLegible(string $fecha_hora): string
{
    $meses_espanol = [
        'January'   => 'enero',
        'February'  => 'febrero',
        'March'     => 'marzo',
        'April'     => 'abril',
        'May'       => 'mayo',
        'June'      => 'junio',
        'July'      => 'julio',
        'August'    => 'agosto',
        'September' => 'septiembre',
        'October'   => 'octubre',
        'November'  => 'noviembre',
        'December'  => 'diciembre'
    ];

    try {
        $fecha_obj = new DateTime($fecha_hora);

        $dia         = $fecha_obj->format('j');
        $mes_ingles  = $fecha_obj->format('F');
        $mes_espanol = $meses_espanol[$mes_ingles] ?? $mes_ingles;
        $año         = $fecha_obj->format('Y');

        $hora        = $fecha_obj->format('g:i'); // Hora sin ceros iniciales (12h)
        $ampm        = strtolower($fecha_obj->format('A')) === 'am' ? 'a. m.' : 'p. m.';

        $fecha_formateada = "$dia de $mes_espanol de $año $hora $ampm";

        return $fecha_formateada;
    } catch (Exception $e) {
        error_log("Error al formatear fecha y hora: " . $e->getMessage());
        return "Fecha y hora inválida";
    }
}
