<?php

// estados de empleados
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

// funciones para agregar editar y listar empleados
function obtenerEmpleados() {
    return json_decode(
        file_get_contents(__DIR__ . "/empleados.json"),
        true
    );
}

function guardarEmpleados($empleados) {
    file_put_contents(
        __DIR__ . "/empleados.json",
        json_encode($empleados, JSON_PRETTY_PRINT)
    );
}

function obtenerEmpleadoPorId($empleados, $id) {
    foreach ($empleados as $emp) {
        if ($emp["id"] == $id) {
            return $emp;
        }
    }
    return null;
}
?>