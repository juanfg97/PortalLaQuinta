<?php 
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "urbanizacion", 3306);
$conexion->set_charset("utf8");

if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Consulta para obtener presidentes ordenados por Terraza y Edificio
$sql = "SELECT id, Terraza, Edificio, nombre_completo FROM presidente_condominio ORDER BY Terraza ASC, Edificio ASC";
$resultado = $conexion->query($sql);
?>

<!-- Bootstrap Select LIMPIO sin espacios extra -->
<div class="destinatario-container">
    <select class="form-select select-destinatario" id="destinatario" required><?php
        // Opción para enviar a todos - SIN ESPACIOS EXTRA
        echo '<option value="todos">📢 Todos los Presidentes</option>';
        
        if ($resultado && $resultado->num_rows > 0) {
            $terrazas_agrupadas = [];
            
            // Agrupar presidentes por terraza
            while ($fila = $resultado->fetch_assoc()) {
                $terrazas_agrupadas[$fila['Terraza']][] = $fila;
            }
            
            // Mostrar presidentes agrupados por terraza - SIN ESPACIOS
            foreach ($terrazas_agrupadas as $num_terraza => $presidentes) {
                echo "<optgroup label=\"🏢 Terraza $num_terraza\">";
                
                foreach ($presidentes as $presidente) {
                    $value = $presidente['id'];
                    $nombre = htmlspecialchars(trim($presidente['nombre_completo'])); // TRIM para quitar espacios
                    $edificio = trim($presidente['Edificio']); // TRIM para quitar espacios
                    
                    // Icono según el edificio
                    $icono = $edificio === 'A' ? '🏠' : ($edificio === 'B' ? '🏡' : '🏘️');
                    
                    // OPCIÓN LIMPIA SIN ESPACIOS EXTRA
                    echo "<option value=\"$value\">$icono Terraza $num_terraza - Edificio $edificio ($nombre)</option>";
                }
                
                echo "</optgroup>";
            }
            
            // Liberar resultado
            $resultado->free();
        } else {
            echo '<option disabled>❌ No hay presidentes registrados</option>';
        }
        ?></select>
    
    <!-- Información de selección actual -->
    <div id="info-seleccion" class="mt-2" style="display: none;">
        <div class="alert alert-info py-2">
            <small id="texto-seleccion"></small>
        </div>
    </div>
</div>
<style>
.destinatario-container {
    position: relative;
}

.select-destinatario {
    border: 2px solid var(--primary-color);
    border-radius: 12px;
    padding: 15px;
    font-size: 16px;
    background: linear-gradient(145deg, #ffffff, #f8f9fa);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
    transition: all 0.3s ease;
    min-height: 56px; /* Altura mínima fija */
}

.select-destinatario:focus {
    border-color: var(--accent-color);
    box-shadow: 0 0 0 0.25rem rgba(0, 51, 153, 0.15);
    transform: translateY(-1px);
}

/* Eliminar espacios en options */
.select-destinatario option {
    padding: 8px 12px;
    line-height: 1.4;
    white-space: nowrap; /* Evita saltos de línea */
}

.select-destinatario optgroup {
    font-weight: 600;
    color: var(--primary-color);
    background-color: #f8f9fa;
    padding: 6px 12px;
    margin: 0; /* Eliminar márgenes */
}

/* Estilos para información de selección */
#info-seleccion {
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectDestinatario = document.getElementById('destinatario');
    const infoSeleccion = document.getElementById('info-seleccion');
    const textoSeleccion = document.getElementById('texto-seleccion');
    
    selectDestinatario.addEventListener('change', function() {
        const valor = this.value;
        const textoOpcion = this.options[this.selectedIndex].text;
        
        if (valor) {
            // Mostrar información de la selección
            let mensaje = '';
            
            if (valor === 'todos') {
                mensaje = '📢 Se enviará el comunicado a TODOS los presidentes de la urbanización';
            } else {
                mensaje = `👤 Se enviará el comunicado a: ${textoOpcion.replace(/🏠|🏡|🏘️/g, '').trim()}`;
            }
            
            textoSeleccion.textContent = mensaje;
            infoSeleccion.style.display = 'block';
            
            // Efecto visual
            this.style.borderColor = '#28a745';
            setTimeout(() => {
                this.style.borderColor = 'var(--primary-color)';
            }, 1000);
        } else {
            infoSeleccion.style.display = 'none';
        }
    });
    
    // Debug: Verificar si hay options vacías
    console.log('Total de opciones:', selectDestinatario.options.length);
    for (let i = 0; i < selectDestinatario.options.length; i++) {
        const option = selectDestinatario.options[i];
        if (option.text.trim() === '' || option.value.trim() === '') {
            console.warn('Opción vacía encontrada en índice:', i, 'Valor:', option.value, 'Texto:', option.text);
        }
    }
});
</script>

<?php
// Cerrar la conexión
$conexion->close();
?>