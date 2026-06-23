<?php
require_once "datos.php";

$usuarioLogueado = [
    "nombre" => "Marcos",
    "rol" => "COCINERO"
];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Cocina - Punto Café</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

    <header>

        <nav class="navbar">

            <div class="logo">
                Punto Café
            </div>

            <div class="menu">
                <a href="index.php" class="btn-pedidos">
                    Pedidos 
                </a>

                <a href="stock.php" class="btn-stock">
                    Stock 
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

    <h1>Cocina</h1>
    <p>Gestiona los pedidos y el stock de productos</p>

    <div>

        <h2>Resumen de pedidos</h2>

        <p>Pendientes: <?= $resumen["pendiente"] ?></p>
        <p>En preparación: <?= $resumen["en_preparacion"] ?></p>
        <p>Disponibles: <?= $resumen["disponible"] ?></p>
        <p>Cancelados: <?= $resumen["cancelado"] ?></p>

    </div>

    <div>

        <h2>Pedidos en cocina</h2>

        <?php foreach ($pedidos as $pedido): ?>

            <div style="border:1px solid #ccc; margin:10px; padding:10px;">

                <h3>
                    Pedido #<?= $pedido["id"] ?>
                </h3>

                <p>
                    Mesa <?= $pedido["mesa"] ?>
                </p>

                <p>
                    Estado:
                    <strong><?= $pedido["estado"] ?></strong>
                </p>

                <p>
                    Hace <?= $pedido["creado_hace"] ?>
                </p>

                <ul>
                    <?php foreach ($pedido["items"] as $item): ?>

                        <li>
                            <?= $item["nombre"] ?>
                            x<?= $item["cantidad"] ?>
                        </li>

                    <?php endforeach; ?>
                </ul>

                <?php if ($pedido["estado"] === "pendiente"): ?>

                    <button>
                        Iniciar preparación
                    </button>

                <?php elseif ($pedido["estado"] === "en_preparacion"): ?>

                    <button>
                        Marcar disponible
                    </button>

                <?php elseif ($pedido["estado"] === "disponible"): ?>

                    <button>
                        Listo para retirar
                    </button>

                <?php endif; ?>

                <button>
                    Cancelar
                </button>

            </div>

        <?php endforeach; ?>

    </div>

    <div>

        <h2>Stock de productos</h2>

        <?php foreach ($stock as $producto): ?>

            <p>
                <?= $producto["nombre"] ?>
                -
                <?= $producto["stock"] ?>
            </p>

        <?php endforeach; ?>

    </div>

</body>

</html>