<?php

require 'funciones.php';
$empleados = obtenerEmpleados();

$usuarioLogueado = [
    "nombre" => "Milagros",
    "rol" => "ADMIN"
];

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración - Punto Café</title>

    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>

    <header>

        <nav class="navbar">

            <div class="logo">
                Punto Café
            </div>

            <div class="menu">
                <a href="index.php" class="btn-empleados">
                    Empleados 
                </a>
            </div>

            <div class="usuario">

                <div class="estado-local">
                    Abierto ahora
                </div>

                <div class="perfil">
                    <p>
                        Hola,
                        <?= $usuarioLogueado["nombre"] ?>
                    </p>

                    <span>
                        <?= $usuarioLogueado["rol"] ?>
                    </span>
                </div>

            </div>

        </nav>

    </header>


    <main>

        <section class="titulo">

            <h1>Empleados</h1>

            <p>
                Gestioná el horario laboral de tus empleados.
            </p>

        </section>

        <section class="tabla-empleados">

            <table>

                <thead>

                    <tr>
                        <th>Empleado</th>
                        <th>Puesto</th>
                        <th>Estado</th>
                        <th>Horario</th>
                        <th>Acciones</th>
                    </tr>

                </thead>

                <tbody>

                <?php foreach ($empleados as $empleado): ?>

                <tr>

                    <td><?= $empleado["nombre"] ?></td>

                    <td><?= $empleado["puesto"] ?></td>

                    <td>

                        <?php
                        mostrarSelectEstado(
                            $empleado["estado"],
                            $estados
                        );
                        ?>

                    </td>

                    <td><?= $empleado["horario"] ?></td>

                    <td>

                        <a href="editar-empleado.php?id=<?=$empleado['id']?>" class="btn-editar">
                            Editar
                        </a>

                    </td>

                </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

            <a href="agregar-empleado.php" class="btn-agregar">
                +
            </a>

        </section>

    </main>

</body>

</html>