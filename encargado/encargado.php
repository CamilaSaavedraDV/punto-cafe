<?php
$usuarioLogueado = [
    "nombre" => "Martin",
    "rol"    => "ENCARGADO"
];

$reportes = [
    [
        "nombre"  => "Juan Rodriguez",
        "mensaje" => "Agregaría mas variedad al menu.",
        "estado"  => "leido",
        "email"   => "Juan3879@gmail.com"
    ],
    [
        "nombre"  => "Mel Juarez",
        "mensaje" => "Hice un pedido y tuvo una demora de 1 hora y media",
        "estado"  => "leido",
        "email"   => "mel.juarez@gmail.com"
    ],
    [
        "nombre"  => "Jorge Ramirez",
        "mensaje" => "La comida estaba bien pero el latte estaba helado",
        "estado"  => "pendiente",
        "email"   => "jorge.ramirez@gmail.com"
    ],
    [
        "nombre"  => "Malena Figueroa",
        "mensaje" => "Nunca me llego mi pedido.",
        "estado"  => "pendiente",
        "email"   => "malena.figueroa@gmail.com"
    ],
];

$stock = [
    ["nombre" => "Huevo",                   "icono" => "🥚", "cantidad" => 26,  "nivel" => "bajo"],
    ["nombre" => "Leche",                   "icono" => "🥛", "cantidad" => 150, "nivel" => "bueno"],
    ["nombre" => "Cafe",                    "icono" => "☕", "cantidad" => 109, "nivel" => "bueno"],
    ["nombre" => "Chocolate cobertura",     "icono" => "🍫", "cantidad" => 110, "nivel" => "bueno"],
    ["nombre" => "Palta",                   "icono" => "🥑", "cantidad" => 10,  "nivel" => "critico"],
    ["nombre" => "Harina",                  "icono" => "🌾", "cantidad" => 26,  "nivel" => "bajo"],
    ["nombre" => "Crema de leche",          "icono" => "🍶", "cantidad" => 10,  "nivel" => "critico"],
    ["nombre" => "Pan",                     "icono" => "🍞", "cantidad" => 109, "nivel" => "bueno"],
    ["nombre" => "Polvo para hornear",      "icono" => "🧂", "cantidad" => 110, "nivel" => "bueno"],
    ["nombre" => "Matcha",                  "icono" => "🍵", "cantidad" => 10,  "nivel" => "critico"],
    ["nombre" => "Medialunas para hornear", "icono" => "🥐", "cantidad" => 150, "nivel" => "bueno"],
    ["nombre" => "Azucar",                  "icono" => "🍬", "cantidad" => 150, "nivel" => "bueno"],
    ["nombre" => "Sal",                     "icono" => "🧂", "cantidad" => 25,  "nivel" => "bajo"],
    ["nombre" => "Pimienta",                "icono" => "🌶",  "cantidad" => 110, "nivel" => "bueno"],
    ["nombre" => "Agua mineral",            "icono" => "💧", "cantidad" => 10,  "nivel" => "critico"],
];

$nivelClases = [
    "bueno"   => "nivel-bueno",
    "bajo"    => "nivel-bajo",
    "critico" => "nivel-critico",
];

$nivelLabels = [
    "bueno"   => "Buen nivel",
    "bajo"    => "Stock bajo",
    "critico" => "Stock crítico",
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encargado - Punto Café</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/mesas.css">
    <link rel="stylesheet" href="../css/encargado.css">
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
            <a href="encargado.php" class="nav-link active">Reportes</a>
            <a href="encargado.php" class="nav-link">Stock</a>
            <a href="menu.php" class="nav-link">Menu</a>
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

    <div class="enc-page">

        <section class="enc-section">
            <div class="enc-section-header">
                <span class="enc-section-icon">📋</span>
                <div>
                    <h2 class="panel-title">Reportes</h2>
                    <div class="enc-legend">
                        <span class="enc-legend-item">
                            <span class="enc-dot enc-dot-green"></span> Leido
                        </span>
                        <span class="enc-legend-item">
                            <span class="enc-dot enc-dot-blue"></span> Pendiente
                        </span>
                    </div>
                </div>
            </div>

            <div class="enc-reportes-grid">
                <?php foreach ($reportes as $i => $reporte): ?>
                    <div class="enc-reporte-card">
                        <div class="enc-reporte-top">
                            <div class="enc-reporte-avatar">👤</div>
                            <span class="enc-estado-dot enc-dot-<?= $reporte["estado"] === "leido" ? "green" : "blue" ?>"></span>
                        </div>
                        <div class="enc-reporte-nombre"><?= $reporte["nombre"] ?></div>
                        <div class="enc-reporte-mensaje"><?= $reporte["mensaje"] ?></div>
                        <div class="enc-reporte-actions">
                            <button
                                class="btn-contactar"
                                onclick="toggleEmail(<?= $i ?>)"
                            >Contactar</button>
                            <span
                                class="enc-email"
                                id="email-<?= $i ?>"
                                style="display:none"
                            >✉ <?= $reporte["email"] ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <div class="enc-aviso">
            <span class="enc-aviso-icon">💡</span>
            <div>
                <div class="enc-aviso-titulo">Recordá responder todos los reportes</div>
                <div class="enc-aviso-sub">Es importante que los clientes se sientan escuchados para mejorar su experiencia</div>
            </div>
        </div>

        <section class="enc-section">
            <div class="enc-stock-header">
                <div class="enc-section-header">
                    <span class="enc-section-icon">🛒</span>
                    <h2 class="panel-title">Stock general</h2>
                </div>
                <div class="np-search-wrapper">
                    <span class="np-search-icon">🔍</span>
                    <input type="text" class="np-search" placeholder="Buscar productos...">
                </div>
            </div>

            <div class="enc-stock-grid">
                <?php foreach ($stock as $item): ?>
                    <div class="enc-stock-item">
                        <span class="enc-stock-icono"><?= $item["icono"] ?></span>
                        <span class="enc-stock-nombre"><?= $item["nombre"] ?></span>
                        <span class="enc-stock-cantidad">x<?= $item["cantidad"] ?></span>
                        <button class="enc-stock-editar">✏</button>
                        <span class="enc-nivel <?= $nivelClases[$item["nivel"]] ?>">
                            <?= $nivelLabels[$item["nivel"]] ?>
                        </span>
                    </div>
                <?php endforeach; ?>
            </div>

            <button class="enc-btn-actualizar">🖥 Actualizar</button>
        </section>

    </div>

    <script>
        function toggleEmail(i) {
            const el = document.getElementById('email-' + i);
            el.style.display = el.style.display === 'none' ? 'flex' : 'none';
        }
    </script>

</body>
</html>