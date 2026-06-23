<?php
$usuarioLogueado = [
    "nombre" => "Valentina",
    "rol"    => "RECEPCIONISTA"
];

$pedidos = [
    [
        "id"      => 21,
        "mesa"    => "Mesa 5",
        "tiempo"  => "Hace 3 min",
        "estado"  => "Pendiente",
        "items"   => ["Porción de torta x1", "Medialuna x3", "Matcha Latte x2"],
        "total"   => "$9.000"
    ],
    [
        "id"      => 20,
        "mesa"    => "Mesa 2",
        "tiempo"  => "Hace 8 min",
        "estado"  => "En preparación",
        "items"   => ["Latte x2", "Matcha Latte x1"],
        "total"   => "$15.000"
    ],
    [
        "id"      => 19,
        "mesa"    => "Mesa 7",
        "tiempo"  => "Hace 15 min",
        "estado"  => "Disponible",
        "items"   => ["Latte x1", "Medialuna x2"],
        "total"   => "$9.000"
    ],
    [
        "id"      => 18,
        "mesa"    => "Para llevar",
        "tiempo"  => "Hace 25 min",
        "estado"  => "Entregado",
        "items"   => ["Latte x1"],
        "total"   => "$7.500"
    ],
];

$mesas = [
    ["numero" => 1,  "estado" => "libre"],
    ["numero" => 2,  "estado" => "ocupada",   "pedido" => "#20"],
    ["numero" => 3,  "estado" => "ocupada",   "pedido" => "#18"],
    ["numero" => 4,  "estado" => "libre"],
    ["numero" => 5,  "estado" => "ocupada",   "pedido" => "#21"],
    ["numero" => 6,  "estado" => "esperando"],
    ["numero" => 7,  "estado" => "ocupada",   "pedido" => "#19"],
    ["numero" => 8,  "estado" => "libre"],
    ["numero" => 9,  "estado" => "libre"],
    ["numero" => 10, "estado" => "esperando"],
    ["numero" => 11, "estado" => "libre"],
    ["numero" => 12, "estado" => "libre"],
];

$tagClases = [
    "Pendiente"      => "tag-pending",
    "En preparación" => "tag-prep",
    "Disponible"     => "tag-available",
    "Entregado"      => "tag-delivered",
    "Cancelado"      => "tag-cancelled",
];

$estadoLabels = [
    "libre"     => "Libre",
    "ocupada"   => "Ocupada",
    "esperando" => "Esperando tomar pedido",
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recepcionista - Punto Café</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/mesas.css">
</head>
<body>

    <nav class="navbar">
        <a href="#" class="navbar-brand">
            <span class="brand-icon">☕</span>
            <span class="brand-text">
                <span class="brand-name">PUNTO CAFÉ</span>
            </span>
        </a>
        <div class="navbar-center">
            <a href="dashboard.php" class="nav-link active">Pedidos</a>
            <a href="#" class="nav-link">Mesas</a>
        </div>
        <div class="navbar-right">
            <span class="status-badge">
                <span class="status-dot"></span> Abierto ahora
            </span>
            <div class="user-info">
                <div class="user-avatar">👤</div>
                <div class="user-text">
                    <span class="user-name">Hola, <?= $usuarioLogueado["nombre"] ?></span>
                    <span class="user-role"><?= $usuarioLogueado["rol"] ?></span>
                </div>
                <span class="user-chevron">▾</span>
            </div>
        </div>
    </nav>

    <div class="page">

        <div class="panel">
            <div class="panel-header">
                <span class="panel-icon">📋</span>
                <div>
                    <h2 class="panel-title">Pedidos</h2>
                    <p class="panel-subtitle">Visualiza el estado de los pedidos en tiempo real</p>
                </div>
            </div>

            <div class="filters">
                <button class="filter-btn active">Todos <span class="badge">21</span></button>
                <button class="filter-btn">Pendientes <span class="badge">1</span></button>
                <button class="filter-btn">En preparación <span class="badge">1</span></button>
                <button class="filter-btn">Disponibles <span class="badge">3</span></button>
                <button class="filter-btn">Entregados <span class="badge">14</span></button>
                <button class="filter-btn">Cancelados <span class="badge">2</span></button>
            </div>

            <div class="orders-list">
                <?php foreach ($pedidos as $pedido): ?>
                    <div class="order-card">
                        <div class="order-top">
                            <div>
                                <div class="order-title">Pedido #<?= $pedido["id"] ?></div>
                                <div class="order-meta">🪑 <?= $pedido["mesa"] ?></div>
                            </div>
                            <div class="order-right">
                                <span class="order-time"><?= $pedido["tiempo"] ?></span>
                                <span class="tag <?= $tagClases[$pedido["estado"]] ?>">
                                    <?= $pedido["estado"] ?>
                                </span>
                            </div>
                        </div>

                        <ul class="order-items">
                            <?php foreach ($pedido["items"] as $item): ?>
                                <li><?= $item ?></li>
                            <?php endforeach; ?>
                        </ul>

                        <div class="order-bottom">
                            <span class="order-price"><?= $pedido["total"] ?></span>
                            <div class="order-actions">
                                <button class="btn-outline">Ver detalle</button>
                                <?php if ($pedido["estado"] === "Pendiente"): ?>
                                    <button class="btn-prep">Marcar en preparación</button>
                                    <button class="btn-cancel">Cancelar</button>
                                <?php elseif ($pedido["estado"] === "Disponible"): ?>
                                    <button class="btn-deliver">✔ Marcar como entregado</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="view-all">
                <button class="btn-view-all">📄 Ver todos los pedidos &rsaquo;</button>
            </div>
        </div>

        <div class="panel">
            <div class="panel-header">
                <span class="panel-icon">🪑</span>
                <div>
                    <h2 class="panel-title">Mesas</h2>
                    <p class="panel-subtitle">Estado de las mesas del local</p>
                </div>
            </div>

            <div class="legend">
                <span class="legend-item"><span class="dot dot-green"></span> Libres</span>
                <span class="legend-item"><span class="dot dot-orange"></span> Esperando tomar pedido</span>
                <span class="legend-item"><span class="dot dot-red"></span> Ocupadas</span>
            </div>

            <div class="mesas-grid">
                <?php foreach ($mesas as $mesa): ?>
                    <div class="mesa mesa-<?= $mesa["estado"] ?>">
                        <div class="mesa-icon">🪑</div>
                        <div class="mesa-name">Mesa <?= $mesa["numero"] ?></div>
                        <div class="mesa-status"><?= $estadoLabels[$mesa["estado"]] ?></div>
                        <?php if (!empty($mesa["pedido"])): ?>
                            <div class="mesa-pedido">Pedido <?= $mesa["pedido"] ?></div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="mesas-actions">
                <a href="nuevo-pedido.php" class="btn-nuevo-pedido">+ Nuevo pedido</a>
                <button class="btn-liberar">Liberar mesa</button>
            </div>
        </div>

    </div>

</body>
</html>