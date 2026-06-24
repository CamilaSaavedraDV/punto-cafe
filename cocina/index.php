<?php
require_once "datos.php";

$usuarioLogueado = [
    "nombre" => "Marcos",
    "rol"    => "COCINERO"
];

$tagClasesCocina = [
    "pendiente"      => "tag-pending",
    "en_preparacion" => "tag-prep",
    "disponible"     => "tag-available",
    "cancelado"      => "tag-cancelled"
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cocina - Punto Café</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/cocina.css">
</head>
<body>

    <nav class="navbar">
        <div class="logo">
            ☕ PUNTO CAFÉ
        </div>
        <div class="navbar-center">
            <a href="index.php" class="nav-link active">Pedidos</a>
            <a class="nav-link">Stock</a>
        </div>
        <div class="navbar-right">
            <span class="status-badge">
                <span class="status-dot"></span>
                Abierto ahora
            </span>
            <div class="user-info">
                <div class="user-avatar">👤</div>
                <div class="user-text">
                    <span class="user-name">Hola, <?= $usuarioLogueado["nombre"] ?></span>
                    <span class="user-role"><?= $usuarioLogueado["rol"] ?></span>
                </div>
            </div>
        </div>
    </nav>

    <main class="page cocina-container">
        
        <section class="cocina-pedidos-panel panel">
            <div class="cocina-header">
                <h2>Cocina</h2>
                <p>Gestiona los pedidos y el stock de productos</p>
            </div>

            <div class="cocina-filtros">
                <button class="filtro-item active">Todos <span class="badge-num">7</span></button>
                <button class="filtro-item">Pendientes <span class="badge-num"><?= $resumen["pendiente"] ?></span></button>
                <button class="filtro-item">En preparación <span class="badge-num"><?= $resumen["en_preparacion"] ?></span></button>
                <button class="filtro-item">Disponibles <span class="badge-num"><?= $resumen["disponible"] ?></span></button>
                <button class="filtro-item">Cancelados <span class="badge-num"><?= $resumen["cancelado"] ?></span></button>
            </div>

            <div class="cocina-lista-tarjetas">
                <?php foreach ($pedidos as $pedido): ?>
                    <div class="tarjeta-pedido">
                        <div class="tarjeta-header">
                            <div class="tarjeta-info-principal">
                                <h3>Pedido #<?= $pedido["id"] ?></h3>
                                <span class="tarjeta-mesa">🪑 Mesa <?= $pedido["mesa"] ?></span>
                            </div>
                            <div class="tarjeta-meta">
                                <span class="tarjeta-tiempo">Hace <?= $pedido["creado_hace"] ?></span>
                                <span class="badge-estado <?= $tagClasesCocina[$pedido["estado"]] ?? 'tag-pending' ?>">
                                    <?= ucfirst(str_replace('_', ' ', $pedido["estado"])) ?>
                                </span>
                            </div>
                        </div>

                        <ul class="tarjeta-items">
                            <?php foreach ($pedido["items"] as $item): ?>
                                <li><?= $item["nombre"] ?> <span class="item-cant">x<?= $item["cantidad"] ?></span></li>
                            <?php endforeach; ?>
                        </ul>

                        <div class="tarjeta-botones">
                            <?php if ($pedido["estado"] === "pendiente"): ?>
                                <button class="btn-accion btn-iniciar">Iniciar preparación</button>
                            <?php elseif ($pedido["estado"] === "en_preparacion"): ?>
                                <button class="btn-accion btn-disponible">Marcar disponible</button>
                            <?php elseif ($pedido["estado"] === "disponible"): ?>
                                <button class="btn-accion btn-listo">✅ Listo para retirar</button>
                            <?php endif; ?>

                            <?php if ($pedido["estado"] !== "disponible"): ?>
                                <button class="btn-accion btn-cancelar-pedido">Cancelar</button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="cocina-footer-btn">
                <button class="btn-ver-mas-pedidos">
                    📋 Ver todos los pedidos <span>❯</span>
                </button>
            </div>
        </section>

        <div class="cocina-sidebar">
            
            <section class="panel">
                <h3 class="sidebar-titulo">Resumen de pedidos</h3>
                <div class="resumen-grid">
                    <div class="resumen-card">
                        <span class="resumen-cantidad"><?= $resumen["pendiente"] ?></span>
                        <span class="resumen-nombre">Pendientes</span>
                        <div class="resumen-icono ico-pen">⏳</div>
                    </div>
                    <div class="resumen-card">
                        <span class="resumen-cantidad"><?= $resumen["en_preparacion"] ?></span>
                        <span class="resumen-nombre">En prep.</span>
                        <div class="resumen-icono ico-prep">👨‍🍳</div>
                    </div>
                    <div class="resumen-card">
                        <span class="resumen-cantidad"><?= $resumen["disponible"] ?></span>
                        <span class="resumen-nombre">Disponibles</span>
                        <div class="resumen-icono ico-disp">✅</div>
                    </div>
                    <div class="resumen-card">
                        <span class="resumen-cantidad"><?= $resumen["cancelado"] ?></span>
                        <span class="resumen-nombre">Cancelados</span>
                        <div class="resumen-icono ico-can">❌</div>
                    </div>
                </div>
            </section>

            <section class="panel">
                <div class="stock-panel-header">
                    <h3 class="sidebar-titulo">Stock de productos</h3>
                    <input type="text" class="stock-buscador" placeholder="Buscar productos...">
                </div>

                <div class="stock-lista">
                    <?php foreach ($stock as $producto): ?>
                        <?php 
                            $statusClass = 'nivel-ok'; $statusText = 'Buen nivel';
                            if($producto["stock"] <= 10) { $statusClass = 'nivel-critico'; $statusText = 'Stock crítico'; }
                            elseif($producto["stock"] <= 26) { $statusClass = 'nivel-bajo'; $statusText = 'Stock bajo'; }
                        ?>
                        <div class="stock-linea">
                            <div class="stock-linea-izq">
                                <span>📦</span>
                                <span class="stock-prod-nombre"><?= $producto["nombre"] ?></span>
                            </div>
                            <div class="stock-linea-der">
                                <span class="stock-num">x<?= $producto["stock"] ?></span>
                                <span class="stock-badge-nivel <?= $statusClass ?>"><?= $statusText ?></span>
                                <span class="stock-flecha">❯</span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                    <button class="btn-ver-mas-stock">
                        📦 Ver todos los productos en stock <span>❯</span>
                    </button>

            </section>

        </div>
    </main>

</body>
</html>