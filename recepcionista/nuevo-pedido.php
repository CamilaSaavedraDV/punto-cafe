<?php
$usuarioLogueado = [
    "nombre" => "Valentina",
    "rol"    => "RECEPCIONISTA"
];

$productos = [
    [
        "nombre"      => "Medialuna",
        "descripcion" => "Medialuna dulce de manteca",
        "precio"      => 2000,
        "imagen"      => "../assets/medialuna.jpg",
        "cantidad"    => 1
    ],
    [
        "nombre"      => "Porcion de torta",
        "descripcion" => "A elegir entre Matilda/Red Velvet/Carrot Cake",
        "precio"      => 11000,
        "imagen"      => "../assets/torta.jpg",
        "cantidad"    => 0
    ],
    [
        "nombre"      => "Latte",
        "descripcion" => "Puede ser pedido frio o caliente",
        "precio"      => 5000,
        "imagen"      => "../assets/latte.jpg",
        "cantidad"    => 1
    ],
    [
        "nombre"      => "Matcha latte",
        "descripcion" => "Puede ser pedido frio o caliente",
        "precio"      => 5000,
        "imagen"      => "../assets/matcha.webp",
        "cantidad"    => 0
    ],
    [
        "nombre"      => "Avocado toast",
        "descripcion" => "Tostada con palta, huevo y pimienta.",
        "precio"      => 9000,
        "imagen"      => "../assets/avocado.jpg",
        "cantidad"    => 0
    ],
];

$orden = array_filter($productos, fn($p) => $p["cantidad"] > 0);
$subtotal = array_sum(array_map(fn($p) => $p["precio"] * $p["cantidad"], $orden));

function formatoPrecio($numero) {
    return "$" . number_format($numero, 0, ",", ".");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Pedido - Punto Café</title>
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

    <div class="np-page-header">
        <span class="panel-icon">🛒</span>
        <div>
            <h2 class="panel-title">Nuevo pedido</h2>
            <p class="panel-subtitle">Crea pedidos y despachalos a la cocina automaticamente</p>
        </div>
    </div>

    <div class="np-page">

        <div class="np-panel">
            <div class="np-panel-top">
                <h3 class="np-section-title">Productos</h3>
                <div class="np-search-wrapper">
                    <span class="np-search-icon">🔍</span>
                    <input type="text" class="np-search" placeholder="Buscar productos...">
                </div>
            </div>

            <div class="np-products">
                <?php foreach ($productos as $producto): ?>
                    <div class="np-product">
                        <img
                            src="<?= $producto["imagen"] ?>"
                            alt="<?= $producto["nombre"] ?>"
                            class="np-product-img"
                        >
                        <div class="np-product-info">
                            <div class="np-product-name"><?= $producto["nombre"] ?></div>
                            <div class="np-product-desc"><?= $producto["descripcion"] ?></div>
                            <div class="np-product-price"><?= formatoPrecio($producto["precio"]) ?></div>
                        </div>
                        <div class="np-qty">
                            <button class="np-qty-btn">−</button>
                            <span class="np-qty-val"><?= $producto["cantidad"] ?></span>
                            <button class="np-qty-btn">+</button>
                            <button class="np-delete">🗑</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="np-right">
            <div class="np-panel np-order-panel">

                <div class="np-order-header">
                    <div>
                        <h3 class="np-section-title">Nueva orden</h3>
                        <p class="np-order-num">Pedido #22</p>
                    </div>
                    <div>
                        <h3 class="np-section-title">Observaciones</h3>
                        <textarea class="np-obs" placeholder="El café sin azúcar..."></textarea>
                    </div>
                </div>

                <div class="np-order-items">
                    <?php foreach ($orden as $item): ?>
                        <div class="np-order-item">
                            <img
                                src="<?= $item["imagen"] ?>"
                                alt="<?= $item["nombre"] ?>"
                                class="np-order-img"
                            >
                            <div class="np-order-item-info">
                                <div class="np-order-item-name">
                                    <?= $item["nombre"] ?> x<?= $item["cantidad"] ?>
                                </div>
                                <div class="np-order-item-desc"><?= $item["descripcion"] ?></div>
                                <div class="np-order-item-price">
                                    <?= formatoPrecio($item["precio"] * $item["cantidad"]) ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="np-totals">
                    <div class="np-total-row">
                        <span>Subtotal</span>
                        <span><?= formatoPrecio($subtotal) ?></span>
                    </div>
                    <div class="np-total-row">
                        <span>Consumo en local</span>
                        <span>$0</span>
                    </div>
                    <div class="np-divider"></div>
                    <div class="np-total-row np-total-final">
                        <div>
                            <span class="np-total-label">Total a pagar</span>
                            <div class="np-payment-method">Pagado con Debito</div>
                        </div>
                        <span class="np-total-amount"><?= formatoPrecio($subtotal) ?></span>
                    </div>
                </div>

                <button class="btn-crear">Crear</button>

            </div>
        </div>

    </div>

</body>
</html>