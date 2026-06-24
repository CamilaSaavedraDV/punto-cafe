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

    <nav class="navbar">

        <div class="logo">
            ☕ PUNTO CAFÉ
        </div>

        <div class="navbar-center">

            <a href="index.php" class="nav-link active">
                Empleados
            </a>

        </div>

        <div class="navbar-right">

            <span class="status-badge">
                <span class="status-dot"></span>
                Abierto ahora
            </span>

            <div class="user-info">

                <div class="user-avatar">
                    👤
                </div>

                <div class="user-text">
                    <span class="user-name">
                        Hola, <?= $usuarioLogueado["nombre"] ?>
                    </span>

                    <span class="user-role">
                        <?= $usuarioLogueado["rol"] ?>
                    </span>
                </div>

            </div>

        </div>

    </nav>

    <main class="page">

        <div class="panel">

            <div class="panel-header">

                <span class="panel-icon">
                    👥
                </span>

                <div>

                    <h2 class="panel-title">
                        Empleados
                    </h2>

                    <p class="panel-subtitle">
                        Gestioná el horario laboral de tus empleados.
                    </p>

                </div>

            </div>

            <div class="table-wrapper">

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

                                    <a href="editar-empleado.php?id=<?= $empleado['id'] ?>" class="btn-edit">
                                        ✏️
                                    </a>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

            <div class="panel-footer">

                <a href="agregar-empleado.php" class="btn-add">
                    +
                </a>

            </div>

        </div>

    </main>


    <script>

    document.querySelectorAll('.estado').forEach(select => {

        select.addEventListener('change', function() {

            this.classList.remove(
                'activo',
                'licencia',
                'inactivo'
            );

            this.classList.add(
                this.value.toLowerCase()
            );

        });

    });

    </script>


</body>

</html>