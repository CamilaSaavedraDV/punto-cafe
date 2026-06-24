<?php

require_once "funciones.php";

$empleados = obtenerEmpleados();

$id = $_GET["id"] ?? null;

if (!$id) {
    die("ID no especificado");
}

$empleado = obtenerEmpleadoPorId($empleados, $id);

if (!$empleado) {
    die("Empleado no encontrado");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    foreach ($empleados as &$emp) {

        if ($emp["id"] == $id) {
            $emp["nombre"] = trim($_POST["nombre"] ?? "");
            $emp["puesto"] = trim($_POST["puesto"] ?? "");
            $emp["horario"] = trim($_POST["horario"] ?? "");
        }
    }

    unset($emp);

    guardarEmpleados($empleados);

    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Punto Café - Editar empleado</title>

    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/agregar_editar_admin.css">
</head>

<body>

<nav class="navbar">
    <a class="navbar-brand">
        <span class="brand-icon">☕</span>
        <span class="brand-text">
            <span class="brand-name">PUNTO CAFÉ</span>
        </span>
    </a>

    <a href="index.php" class="navbar-login">
        Volver
    </a>
</nav>

<main class="main">

    <div class="card">

        <div class="card-header">
            <h1 class="card-title">Editar empleado</h1>
        </div>

        <form method="POST">

            <div class="form-group">
                <label class="form-label">Nombre completo</label>
                <div class="input-wrapper">
                    <svg viewBox="0 0 24 24">
                            <circle cx="12" cy="8" r="4"/>
                            <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                    </svg>
                    <input type="text"
                           name="nombre"
                           class="form-control"
                           value="<?= htmlspecialchars($empleado["nombre"]) ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Puesto</label>
                <div class="input-wrapper">
                    <svg viewBox="0 0 24 24">
                            <path d="M4 7h16M4 12h16M4 17h16"/>
                    </svg>
                    <input type="text"
                           name="puesto"
                           class="form-control"
                           value="<?= htmlspecialchars($empleado["puesto"]) ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Horario</label>
                <div class="input-wrapper">
                    <svg viewBox="0 0 24 24">
                            <path d="M12 6v6l4 2"/>
                            <circle cx="12" cy="12" r="9"/>
                    </svg>
                    <input type="text"
                           name="horario"
                           class="form-control"
                           value="<?= htmlspecialchars($empleado["horario"]) ?>">
                </div>
            </div>
    
            <button type="submit" class="btn-primary">
                Actualizar
            </button>

        </form>

    </div>

</main>

</body>
</html>