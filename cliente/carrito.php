<?php
session_start();

$usuarioLogueado = [
    "nombre" => "Luz",
    "rol"    => "CLIENTE"
];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["accion"])) {
    $idx = intval($_POST["idx"] ?? -1);

    if ($_POST["accion"] === "sumar" && isset($_SESSION["carrito"][$idx])) {
        $_SESSION["carrito"][$idx]["cantidad"]++;
    }
    if ($_POST["accion"] === "restar" && isset($_SESSION["carrito"][$idx])) {
        $_SESSION["carrito"][$idx]["cantidad"]--;
        if ($_SESSION["carrito"][$idx]["cantidad"] <= 0) {
            array_splice($_SESSION["carrito"], $idx, 1);
        }
    }
    if ($_POST["accion"] === "eliminar" && isset($_SESSION["carrito"][$idx])) {
        array_splice($_SESSION["carrito"], $idx, 1);
    }
    if ($_POST["accion"] === "pagar") {
        $_SESSION["pedido_confirmado"] = true;
        $_SESSION["pedido_numero"]     = rand(20, 99);
        $_SESSION["pedido_items"]      = $_SESSION["carrito"];
        $_SESSION["pedido_total"]      = array_sum(array_map(fn($i) => $i["precio"] * $i["cantidad"], $_SESSION["carrito"]));
        $_SESSION["carrito"]           = [];
        header("Location: carrito.php");
        exit;
    }

    header("Location: carrito.php");
    exit;
}

$carrito    = $_SESSION["carrito"] ?? [];
$subtotal   = array_sum(array_map(fn($i) => $i["precio"] * $i["cantidad"], $carrito));
$totalItems = array_sum(array_column($carrito, "cantidad"));

$mostrarConfirmado = $_SESSION["pedido_confirmado"] ?? false;
$pedidoNumero      = $_SESSION["pedido_numero"]     ?? "";
$pedidoItems       = $_SESSION["pedido_items"]      ?? [];
$pedidoTotal       = $_SESSION["pedido_total"]      ?? 0;
if ($mostrarConfirmado) {
    unset($_SESSION["pedido_confirmado"]);
}

function formatoPrecio($n) {
    return "$" . number_format($n, 0, ",", ".");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Carrito - Punto Café</title>
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
                </div>
                <span class="user-chevron">▾</span>
            </div>
        </div>
    </nav>

    <div class="carrito-page">

        <div class="carrito-izq">
            <div class="carrito-titulo-row">
                <a href="productos.php" class="carrito-back">← Mi Carrito</a>
                <p class="carrito-subtitulo">Revisá tu pedido antes de continuar</p>
            </div>

            <div class="carrito-items">
                <?php if (empty($carrito)): ?>
                    <div class="carrito-vacio">Tu carrito está vacío</div>
                <?php endif; ?>
                <?php foreach ($carrito as $idx => $item): ?>
                    <div class="carrito-item">
                        <img src="<?= $item["imagen"] ?>" alt="<?= $item["nombre"] ?>" class="carrito-item-img">
                        <div class="carrito-item-info">
                            <div class="carrito-item-nombre"><?= $item["nombre"] ?></div>
                            <div class="carrito-item-desc"><?= $item["descripcion"] ?></div>
                            <div class="carrito-item-precio"><?= formatoPrecio($item["precio"]) ?></div>
                        </div>
                        <div class="carrito-item-qty">
                            <form method="POST" action="carrito.php" style="display:inline">
                                <input type="hidden" name="idx"    value="<?= $idx ?>">
                                <input type="hidden" name="accion" value="restar">
                                <button class="np-qty-btn">−</button>
                            </form>
                            <span class="np-qty-val"><?= $item["cantidad"] ?></span>
                            <form method="POST" action="carrito.php" style="display:inline">
                                <input type="hidden" name="idx"    value="<?= $idx ?>">
                                <input type="hidden" name="accion" value="sumar">
                                <button class="np-qty-btn">+</button>
                            </form>
                            <form method="POST" action="carrito.php" style="display:inline">
                                <input type="hidden" name="idx"    value="<?= $idx ?>">
                                <input type="hidden" name="accion" value="eliminar">
                                <button class="carrito-delete">🗑</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="carrito-entrega">
                <span class="carrito-entrega-icon">🚚</span>
                <div>
                    <div class="carrito-entrega-titulo">Opciones de entrega</div>
                    <div class="carrito-entrega-desc">Delivery en 30 - 45 min · Retiro en local · Consumo en local</div>
                </div>
                <button class="carrito-entrega-btn">Cambiar</button>
            </div>
        </div>

        <div class="carrito-der">
            <div class="carrito-resumen">
                <div class="carrito-resumen-titulo">
                    <span>🛍</span> Resumen del pedido
                </div>

                <div class="carrito-resumen-items">
                    <?php foreach ($carrito as $item): ?>
                        <div class="carrito-resumen-row">
                            <span>• <?= $item["nombre"] ?></span>
                            <span>x<?= $item["cantidad"] ?></span>
                            <span><?= formatoPrecio($item["precio"] * $item["cantidad"]) ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="carrito-resumen-divider"></div>

                <div class="carrito-resumen-row">
                    <span>Subtotal</span>
                    <span></span>
                    <span><?= formatoPrecio($subtotal) ?></span>
                </div>
                <div class="carrito-resumen-row">
                    <span>Consumo en local</span>
                    <span></span>
                    <span>$0</span>
                </div>

                <div class="carrito-resumen-divider"></div>

                <div class="carrito-resumen-total">
                    <span>Total a pagar</span>
                    <span><?= formatoPrecio($subtotal) ?></span>
                </div>

                <div class="carrito-metodo-titulo">Elegí tu método de pago</div>
                <div class="carrito-metodos">
                    <div class="carrito-metodo active">
                        <img src="../assets/visa.png" alt="Visa" style="height:22px">
                    </div>
                    <div class="carrito-metodo">
                        <img src="../assets/master.webp" alt="Mastercard" style="height:28px">
                    </div>
                    <div class="carrito-metodo">
                        <img src="../assets/mp.png" alt="Mercado Pago" style="height:22px">
                    </div>
                </div>
                <div class="carrito-seguro">🔒 Tus datos están protegidos</div>

                <form method="POST" action="carrito.php">
                    <input type="hidden" name="accion" value="pagar">
                    <button type="submit" class="carrito-btn-pagar" <?= empty($carrito) ? "disabled" : "" ?>>
                        Pagar ahora
                    </button>
                </form>

                <div class="carrito-terminos">
                    Al continuar aceptas nuestros <a href="#">términos y condiciones</a>
                </div>
            </div>
        </div>
    </div>

    <?php if ($mostrarConfirmado): ?>
    <div class="modal-overlay" id="modal-confirmado" style="display:flex">
        <div class="modal confirmado-modal">

            <div class="confirmado-check">
                <svg viewBox="0 0 80 80" width="90" height="90">
                    <circle cx="40" cy="40" r="36" fill="none" stroke="#2ecc71" stroke-width="5"/>
                    <polyline points="24,42 35,53 56,30" fill="none" stroke="#2ecc71" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>

            <h2 class="confirmado-titulo">¡Pedido confirmado!</h2>
            <p class="confirmado-sub">Estamos preparando tu pedido</p>

            <div class="confirmado-detalle">
                <div class="confirmado-num">Pedido #<?= $pedidoNumero ?></div>
                <div class="confirmado-items">
                    <?php foreach ($pedidoItems as $item): ?>
                        <div>- <?= $item["nombre"] ?> x<?= $item["cantidad"] ?></div>
                    <?php endforeach; ?>
                </div>
                <div class="confirmado-total-row">
                    <div>
                        <div class="confirmado-total-label">Total a pagar</div>
                        <div class="confirmado-mesa">Mesa 5</div>
                    </div>
                    <div class="confirmado-right">
                        <div class="confirmado-total-monto"><?= formatoPrecio($pedidoTotal) ?></div>
                        <div class="confirmado-tipo">Consumo en local</div>
                    </div>
                </div>
                <p class="confirmado-nota">Acercate a la caja con tu número de pedido para retirarlo.</p>
            </div>

            <a href="mispedidos.php">
            <button class="btn-primary confirmado-btn-pedidos" onclick="cerrarModal('modal-confirmado')">
                Ver mis pedidos
            </button>
            </a>
            <a href="productos.php" class="confirmado-volver">Volver al inicio</a>
        </div>
    </div>
    <?php endif; ?>

    <script>
        function cerrarModal(id) {
            document.getElementById(id).style.display = 'none';
        }
    </script>

</body>
</html>