<?php

require "funciones.php";
$empleados = obtenerEmpleados();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nuevo = [
        "id" => count($empleados) + 1,
        "nombre" => $_POST["nombre"],
        "puesto" => $_POST["puesto"],
        "estado" => $_POST["estado"],
        "horario" => $_POST["horario"]
    ];

    $empleados[] = $nuevo;

    guardarEmpleados($empleados);

    header("Location: index.php");
    exit;
}
?>

<form method="POST">

    <input name="nombre" placeholder="Nombre">
    <input name="puesto" placeholder="Puesto">

    <select name="estado">
        <option>Activo</option>
        <option>Licencia</option>
        <option>Inactivo</option>
    </select>

    <input name="horario" placeholder="Horario">

    <button type="submit">Guardar</button>

</form>