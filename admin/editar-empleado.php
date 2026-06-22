<?php

require "funciones.php";

$empleados = obtenerEmpleados();

$id = $_GET["id"];

$empleado = obtenerEmpleadoPorId(
    $empleados,
    $id
);

if (!$empleado) {

    die("Empleado no encontrado");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    foreach ($empleados as &$emp) {

        if ($emp["id"] == $id) {

            $emp["nombre"] = $_POST["nombre"];
            $emp["puesto"] = $_POST["puesto"];
            $emp["estado"] = $_POST["estado"];
            $emp["horario"] = $_POST["horario"];
        }
    }

    guardarEmpleados($empleados);

    header("Location: index.php");
    exit;
}
?>

<form method="POST">

    <label>Nombre</label>

    <input
        type="text"
        name="nombre"
        value="<?= $empleado["nombre"] ?>"
    >

    <label>Puesto</label>

    <input
        type="text"
        name="puesto"
        value="<?= $empleado["puesto"] ?>"
    >

    <label>Estado</label>

    <select name="estado">

        <option
            <?= $empleado["estado"] == "Activo" ? "selected" : "" ?>>
            Activo
        </option>

        <option
            <?= $empleado["estado"] == "Licencia" ? "selected" : "" ?>>
            Licencia
        </option>

        <option
            <?= $empleado["estado"] == "Inactivo" ? "selected" : "" ?>>
            Inactivo
        </option>

    </select>

    <label>Horario</label>

    <input
        type="text"
        name="horario"
        value="<?= $empleado["horario"] ?>"
    >

    <button type="submit">
        Actualizar
    </button>

</form>