<?php

require 'funciones.php';

$usuarioLogueado = [
    "nombre" => "Milagros",
    "rol" => "ADMIN"
];

$empleados = [

    [
        "nombre" => "Marcos Baez",
        "puesto" => "Cocinero",
        "estado" => "Activo",
        "horario" => "Lun. a Mie. | 9:00 a 18:00"
    ],

    [
        "nombre" => "Mariela Diaz",
        "puesto" => "Cocinera",
        "estado" => "Activo",
        "horario" => "Jue. y Dom. | 9:00 a 18:00"
    ],

    [
        "nombre" => "Valentina Martinez",
        "puesto" => "Recepcionista",
        "estado" => "Activo",
        "horario" => "Lun. a Dom. | 9:00 a 18:00"
    ],

    [
        "nombre" => "Violeta Paez",
        "puesto" => "Mesera",
        "estado" => "Licencia",
        "horario" => "Lun. a Dom. | 9:00 a 18:00"
    ],

    [
        "nombre" => "Nicolas Gonzalez",
        "puesto" => "Mesero",
        "estado" => "Activo",
        "horario" => "Lun. a Dom. | 9:00 a 18:00"
    ]
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
                <button class="empledos">
                    Empleados
                </button>
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

                            <td>
                                <?= $empleado["nombre"] ?>
                            </td>

                            <td>
                                <?= $empleado["puesto"] ?>
                            </td>

                            <td>

                                <?php
                                mostrarSelectEstado(
                                    $empleado["estado"],
                                    $estados
                                );
                                ?>

                            </td>

                            <td>
                                <?= $empleado["horario"] ?>
                            </td>

                            <td>

                                <button class="btn-editar">
                                    Editar
                                </button>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

            <button class="btn-agregar">
                +
            </button>

        </section>

    </main>

</body>

</html>