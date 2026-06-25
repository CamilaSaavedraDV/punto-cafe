<?php $usuarioLogueado = [
    "nombre" => "Luz",
    "rol"    => "CLIENTE"
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Punto Café - Mis Pedidos</title>
    <link rel="stylesheet" href="../css/mispedidos.css">
</head>
<body>

    <header class="main-header">
        <div class="header-container">
            <div class="logo">
                <span>☕ PUNTO CAFÉ</span>
            </div>
            
            <nav class="navbar-center">
            <a href="productos.php" class="nav-link active">Productos</a>
            <a href="mispedidos.php" class="nav-link">Mis pedidos</a>
            <a href="reportes.php" class="nav-link">Reportes</a>
            </nav>
            
            <div class="navbar-right">
                <div class="status-badge">
                    <span class="status-dot"></span>
                    <span>Abierto ahora</span>
                </div>
                <div class="cart-icon">🛒</div>
                <div class="user-info">
                    <div class="user-avatar">👤</div>
                    <div class="user-text">
                        <span class="user-name">Hola, <?= $usuarioLogueado["nombre"] ?></span>
                        <span class="user-role"><?= $usuarioLogueado["rol"] ?></span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="page">
        <div class="panel">
            <div class="panel-content-wrapper">
                
                <div class="panel-left-content">
                    <div class="panel-header">
                        <span class="panel-icon">🧾</span>
                        <div>
                            <h1 class="panel-title">Mis pedidos</h1>
                            <p class="panel-subtitle">Seguí el estado de tus pedidos</p>
                        </div>
                    </div>

                    <div class="filters">
                        <button class="filter-btn active">Todos <span class="badge">2</span></button>
                        <button class="filter-btn">Pendientes <span class="badge">1</span></button>
                        <button class="filter-btn">En preparación <span class="badge">0</span></button>
                        <button class="filter-btn">Disponibles <span class="badge">0</span></button>
                        <button class="filter-btn">Entregados <span class="badge">1</span></button>
                        <button class="filter-btn">Cancelados <span class="badge">0</span></button>
                    </div>

                    <div class="orders-list">
                        <div class="order-card">
                            <div class="order-top">
                                <div>
                                    <h2 class="order-title">Pedido #21</h2>
                                    <span class="tag tag-pending">Pendiente</span>
                                </div>
                                <div class="order-right">
                                    <span class="order-price">$27.000</span>
                                    <span class="order-meta">3 productos</span>
                                </div>
                            </div>
                            <div class="order-info-rows">
                                <p class="order-detail-text">📍 Consumo en local &nbsp;-&nbsp; Mesa 5</p>
                                <p class="order-detail-text">🕒 Hace 3 min</p>
                            </div>
                            <div class="order-bottom">
                                <span class="order-warning-text">⚠️ Disponible cuando esté entregado</span>
                                <div class="order-actions">
                                    <button class="btn-outline">Ver detalle</button>
                                    <button class="btn-outline" disabled>🔄 Comprar de nuevo</button>
                                </div>
                            </div>
                        </div>

                        <div class="order-card">
                            <div class="order-top">
                                <div>
                                    <h2 class="order-title">Pedido #13</h2>
                                    <span class="tag tag-delivered">Entregado</span>
                                </div>
                                <div class="order-right">
                                    <span class="order-price">$16.000</span>
                                    <span class="order-meta">2 productos</span>
                                </div>
                            </div>
                            <div class="order-info-rows">
                                <p class="order-detail-text">🛍️ Retiro en local</p>
                                <p class="order-detail-text">🕒 Hace 3 días</p>
                            </div>
                            <div class="order-bottom">
                                <div></div>
                                <div class="order-actions">
                                    <button class="btn-outline">Ver detalle</button>
                                    <button class="btn-outline">🔄 Comprar de nuevo</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="center-footer-action">
                        <button class="btn-continue">Seguir comprando</button>
                    </div>
                </div>

                <div class="info-sidebar">
                    <div class="info-header">
                        <div class="info-emoji">🛍️</div>
                        <h2>Tenés 3 pedidos realizados</h2>
                        <p class="info-desc">🕒 Última actualización: hace 1 min</p>
                        <button class="btn-refresh">Refrescar pedidos</button>
                    </div>
                    <div class="info-footer-illustration">
                        <div class="illustration-placeholder">🧑‍🍳</div>
                        <h3>Te avisaremos cuando tu pedido esté listo para retirar</h3>
                        <p>Presentá tu número de pedido en caja para retirarlo. ¡Gracias!</p>
                    </div>
                </div>

            </div>
        </div>
    </main>

</body>
</html>