<?php
session_start();

$usuarioLogueado = [
    "nombre" => "Luz",
    "rol"    => "CLIENTE"
];

$productos = [
    [
        "nombre"      => "Latte",
        "descripcion" => "Puede ser pedido frio o caliente.",
        "precio"      => 5000,
        "categoria"   => "Bebidas calientes",
        "imagen"      => "../assets/latte.jpg"
    ],
    [
        "nombre"      => "Medialuna",
        "descripcion" => "Medialuna dulce de manteca.",
        "precio"      => 2000,
        "categoria"   => "Pasteleria",
        "imagen"      => "../assets/medialuna.jpg"
    ],
    [
        "nombre"      => "Avocado Toast",
        "descripcion" => "Tostada con palta, huevo y pimienta.",
        "precio"      => 9000,
        "categoria"   => "Tostados",
        "imagen"      => "../assets/avocado.jpg"
    ],
    [
        "nombre"      => "Matcha Latte",
        "descripcion" => "Puede ser pedido frio o caliente.",
        "precio"      => 5000,
        "categoria"   => "Bebidas frias",
        "imagen"      => "../assets/matcha.webp"
    ],
    [
        "nombre"      => "Porción de Torta",
        "descripcion" => "A elegir entre Matilda/Red Velvet/Carrot Cake.",
        "precio"      => 11000,
        "categoria"   => "Pasteleria",
        "imagen"      => "../assets/torta.jpg"
    ],
    [
        "nombre"      => "Ensalada César",
        "descripcion" => "Lechuga, crutones, parmesano y aderezo césar.",
        "precio"      => 9000,
        "categoria"   => "Ensaladas",
        "imagen"      => "../assets/cesar.jpg"
    ],
];

$categorias = ["Bebidas frias", "Bebidas calientes", "Pasteleria", "Tostados", "Ensaladas"];

function formatoPrecio($n) {
    return "$" . number_format($n, 0, ",", ".");
}

$carrito = $_SESSION["carrito"] ?? [];
$totalItems = array_sum(array_column($carrito, "cantidad"));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - Punto Café</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/mesas.css">
    <link rel="stylesheet" href="../css/cliente.css">
</head>
<body>

    <nav class="navbar">
        <a href="productos.php" class="navbar-brand">
            <span class="brand-icon">☕</span>
            <span class="brand-text">
                <span class="brand-name">PUNTO CAFÉ</span>
            </span>
        </a>
        <div class="navbar-center">
            <a href="productos.php" class="nav-link active">Productos</a>
            <a href="mispedidos.php" class="nav-link">Mis pedidos</a>
            <a href="reportes.php" class="nav-link">Reportes</a>
        </div>
        <div class="navbar-right">
            <span class="status-badge">
                <span class="status-dot"></span> Abierto ahora
            </span>
            <a href="carrito.php" class="carrito-btn">
                🛒
                <?php if ($totalItems > 0): ?>
                    <span class="carrito-badge"><?= $totalItems ?></span>
                <?php endif; ?>
            </a>
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

    <div class="cli-layout">

        <aside class="cli-sidebar">

            <div class="sidebar-section">
                <div class="sidebar-titulo">Categorías</div>
                <ul class="sidebar-lista">
                    <?php foreach ($categorias as $cat): ?>
                        <li class="sidebar-item">
                            <span class="sidebar-icon">☕</span> <?= $cat ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="sidebar-section">
                <div class="sidebar-titulo">Rango de precio</div>
                <div class="sidebar-precio-label">$0 - $15.000</div>
                <input type="range" class="sidebar-range" min="0" max="15000" value="15000">
            </div>

            <div class="sidebar-promo">
                <div class="sidebar-promo-icon">☕🤝</div>
                <div class="sidebar-promo-titulo">¡Invitá a tus amigos!</div>
                <div class="sidebar-promo-texto">Compartí <strong>PUNTO CAFÉ</strong> y ganaté descuentos exclusivos.</div>
                <button class="sidebar-promo-btn">Invitar ahora</button>
            </div>

            <div class="sidebar-section sidebar-horario">
                <div class="sidebar-horario-titulo">🕐 Horario del local</div>
                <div class="sidebar-horario-dias">Lunes a Domingos</div>
                <div class="sidebar-horario-horas">09:00 - 18:00</div>
                <div class="sidebar-horario-nota">No se pueden realizar pedidos fuera del horario de atención.</div>
            </div>

        </aside>

        <main class="cli-main">

            <div class="cli-topbar">
                <div class="np-search-wrapper">
                    <span class="np-search-icon">🔍</span>
                    <input type="text" class="np-search cli-search" placeholder="Buscar productos...">
                </div>
                <div class="cli-filtros">
                    <button class="cli-filtro active">Nuevo</button>
                    <button class="cli-filtro">Precio mayor</button>
                    <button class="cli-filtro">Precio menor</button>
                    <button class="cli-filtro">Rating</button>
                </div>
            </div>

            <div class="cli-productos-wrapper">
                <button class="cli-arrow cli-arrow-izq" onclick="scrollCarrusel(-1)">&#8249;</button>

                <div class="cli-productos-grid" id="carrusel">
                    <?php foreach ($productos as $p): ?>
                        <div class="cli-producto-card">
                            <img
                                src="<?= $p["imagen"] ?>"
                                alt="<?= $p["nombre"] ?>"
                                class="cli-producto-img"
                            >
                            <div class="cli-producto-nombre"><?= $p["nombre"] ?></div>
                            <div class="cli-producto-precio"><?= formatoPrecio($p["precio"]) ?></div>
                            <form method="POST" action="agregar-carrito.php">
                                <input type="hidden" name="nombre"      value="<?= htmlspecialchars($p["nombre"]) ?>">
                                <input type="hidden" name="precio"      value="<?= $p["precio"] ?>">
                                <input type="hidden" name="descripcion" value="<?= htmlspecialchars($p["descripcion"]) ?>">
                                <input type="hidden" name="imagen"      value="<?= $p["imagen"] ?>">
                                <button type="submit" class="cli-btn-agregar">Agregar <span>+</span></button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>

                <button class="cli-arrow cli-arrow-der" onclick="scrollCarrusel(1)">&#8250;</button>
            </div>

            <div class="cli-banner">
                <img src="../assets/banner.jpeg" alt="Promo Mayo" class="cli-banner-img">
            </div>

            <div class="cli-features">
                <div class="cli-feature">
                    <span class="cli-feature-icon">🛵</span>
                    <div>
                        <div class="cli-feature-titulo">Delivery rápido</div>
                        <div class="cli-feature-desc">Recibí tu pedido en 30 - 45 min</div>
                    </div>
                </div>
                <div class="cli-feature">
                    <span class="cli-feature-icon">🛍</span>
                    <div>
                        <div class="cli-feature-titulo">Para llevar</div>
                        <div class="cli-feature-desc">Retirá tu pedido sin filas</div>
                    </div>
                </div>
                <div class="cli-feature">
                    <span class="cli-feature-icon">💳</span>
                    <div>
                        <div class="cli-feature-titulo">Pago seguro</div>
                        <div class="cli-feature-desc">Múltiples métodos de pago</div>
                    </div>
                </div>
                <div class="cli-feature">
                    <span class="cli-feature-icon">🏆</span>
                    <div>
                        <div class="cli-feature-titulo">Productos frescos</div>
                        <div class="cli-feature-desc">Ingredientes de calidad todos los días</div>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <script>
        function scrollCarrusel(dir) {
            const c = document.getElementById('carrusel');
            c.scrollBy({ left: dir * 200, behavior: 'smooth' });
        }
    </script>

</body>
</html>