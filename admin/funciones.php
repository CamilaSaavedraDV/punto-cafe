<?php

$estados = [
    "Activo",
    "Licencia",
    "Inactivo"
];

function mostrarSelectEstado($estadoActual, $estados)
{
    echo '<select class="estado-select">';

    foreach ($estados as $estado) {

        $selected = ($estado == $estadoActual)
            ? "selected"
            : "";

        echo "<option value='$estado' $selected>$estado</option>";
    }

    echo '</select>';
}