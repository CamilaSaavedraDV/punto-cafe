<?php
$usuarioLogueado = [
    "nombre" => "Martin",
    "rol"    => "ENCARGADO"
];

$menu = [
    "Dulces" => [
        "icono" => "🧁",
        "productos" => [
            [
                "nombre"      => "Medialuna",
                "descripcion" => "Medialuna dulce de manteca.",
                "precio"      => 2000,
                "imagen"      => "../assets/medialuna.jpg"
            ],
            [
                "nombre"      => "Porcion de torta",
                "descripcion" => "A elegir entre Matilda/Red Velvet/Carrot Cake.",
                "precio"      => 11000,
                "imagen"      => "../assets/torta.jpg"
            ],
        ]
    ],
    "Salados" => [
        "icono" => "🍽",
        "productos" => [
            [
                "nombre"      => "Avocado toast",
                "descripcion" => "Tostada con palta, huevo y pimienta.",
                "precio"      => 9000,
                "imagen"      => "../assets/avocado.jpg"
            ],
            [
                "nombre"      => "Ensalada César",
                "descripcion" => "Base de lechuga crutones, queso parmesano y aderezo césar.",
                "precio"      => 9000,
                "imagen"      => "../assets/cesar.jpg"
            ],
        ]
    ],
    "Bebidas" => [
        "icono" => "🥤",
        "productos" => [
            [
                "nombre"      => "Latte",
                "descripcion" => "Puede ser pedido frio o caliente.",
                "precio"      => 5000,
                "imagen"      => "../assets/latte.jpg"
            ],
            [
                "nombre"      => "Matcha latte",
                "descripcion" => "Puede ser pedido frio o caliente.",
                "precio"      => 5000,
                "imagen"      => "../assets/matcha.webp"
            ],
        ]
    ],
];

function formatoPrecio($n) {
    return "$" . number_format($n, 0, ",", ".");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Punto Café</title>
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
            <a href="encargado.php" class="nav-link">Reportes</a>
            <a href="encargado.php" class="nav-link">Stock</a>
            <a href="menu.php" class="nav-link active">Menu</a>
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

            <div class="menu-header">
                <div class="menu-header-icon">
                    <svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="#5c3317" stroke-width="2" stroke-linecap="round">
                        <line x1="3" y1="6"  x2="21" y2="6"/>
                        <line x1="3" y1="12" x2="21" y2="12"/>
                        <line x1="3" y1="18" x2="21" y2="18"/>
                    </svg>
                </div>
                <div>
                    <h2 class="panel-title">Menu</h2>
                    <p class="panel-subtitle">Mantene actualizado el menu con sus precios.</p>
                </div>
            </div>

            <hr class="menu-divider">

            <div class="menu-categorias">
                <?php foreach ($menu as $categoria => $data): ?>
                    <div class="menu-categoria">
                        <div class="menu-categoria-titulo">
                            <span><?= $data["icono"] ?></span>
                            <h3><?= $categoria ?></h3>
                        </div>
                        <div class="menu-productos">
                            <?php foreach ($data["productos"] as $producto): ?>
                                <div class="menu-producto">
                                    <img
                                        src="<?= $producto["imagen"] ?>"
                                        alt="<?= $producto["nombre"] ?>"
                                        class="menu-producto-img"
                                    >
                                    <div class="menu-producto-info">
                                        <div class="menu-producto-nombre"><?= $producto["nombre"] ?></div>
                                        <div class="menu-producto-desc"><?= $producto["descripcion"] ?></div>
                                        <div class="menu-producto-precio"><?= formatoPrecio($producto["precio"]) ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </section>

        <div class="enc-aviso enc-aviso-row">
            <div class="enc-aviso-izq">
                <span class="enc-aviso-icon">💡</span>
                <div>
                    <div class="enc-aviso-titulo">Recordá mantener el menu actualizado</div>
                    <div class="enc-aviso-sub">Mantené el menu al día para evitar faltantes y mejorar la experiencia</div>
                </div>
            </div>
            <button class="btn-actualizar-menu" onclick="abrirModal('modal-actualizar')">✏ Actualizar menu</button>
        </div>

        <button class="btn-agregar-menu" onclick="abrirModal('modal-agregar')">+</button>
    </div>

    <div class="modal-overlay" id="modal-agregar">
        <div class="modal">
            <h2 class="modal-titulo">Agregar nuevo producto</h2>
            <form method="POST" action="menu.php">

                <div class="modal-group">
                    <label class="modal-label">Nombre</label>
                    <input type="text" name="nombre" class="modal-input" placeholder="Ingrese el nombre">
                </div>

                <div class="modal-group">
                    <label class="modal-label">Categoría</label>
                    <select name="categoria" class="modal-input">
                        <option value="" disabled selected>Seleccioná una categoría</option>
                        <option value="Dulces">Dulces</option>
                        <option value="Salados">Salados</option>
                        <option value="Bebidas">Bebidas</option>
                    </select>
                </div>

                <div class="modal-group">
                    <label class="modal-label">Descripción</label>
                    <input type="text" name="descripcion" class="modal-input" placeholder="Ingrese la descripción">
                </div>

                <div class="modal-group">
                    <label class="modal-label">Precio</label>
                    <input type="number" name="precio" class="modal-input" placeholder="Ingrese el precio">
                </div>

                <button type="submit" class="btn-primary modal-btn">Crear</button>
            </form>
            <button class="modal-cerrar" onclick="cerrarModal('modal-agregar')">✕</button>
        </div>
    </div>

    <div class="modal-overlay" id="modal-actualizar">
        <div class="modal">
            <h2 class="modal-titulo">Actualizar menu</h2>
            <form method="POST" action="menu.php">

                <div class="modal-group">
                    <label class="modal-label">Seleccioná el producto</label>
                    <select name="producto_id" class="modal-input">
                        <option value="" disabled selected>Elegí un producto</option>
                        <?php foreach ($menu as $categoria => $data): ?>
                            <optgroup label="<?= $categoria ?>">
                                <?php foreach ($data["productos"] as $i => $p): ?>
                                    <option value="<?= $categoria ?>_<?= $i ?>">
                                        <?= $p["nombre"] ?>
                                    </option>
                                <?php endforeach; ?>
                            </optgroup>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="modal-group">
                    <label class="modal-label">Nuevo nombre</label>
                    <input type="text" name="nuevo_nombre" class="modal-input" placeholder="Dejá vacío para no cambiar">
                </div>

                <div class="modal-group">
                    <label class="modal-label">Nueva descripción</label>
                    <input type="text" name="nueva_descripcion" class="modal-input" placeholder="Dejá vacío para no cambiar">
                </div>

                <div class="modal-group">
                    <label class="modal-label">Nuevo precio</label>
                    <input type="number" name="nuevo_precio" class="modal-input" placeholder="Dejá vacío para no cambiar">
                </div>

                <button type="submit" class="btn-primary modal-btn">Guardar cambios</button>
            </form>
            <button class="modal-cerrar" onclick="cerrarModal('modal-actualizar')">✕</button>
        </div>
    </div>

    <script>
        function abrirModal(id) {
            document.getElementById(id).style.display = 'flex';
        }

        function cerrarModal(id) {
            document.getElementById(id).style.display = 'none';
        }

        document.querySelectorAll('.modal-overlay').forEach(overlay => {
            overlay.addEventListener('click', function(e) {
                if (e.target === this) cerrarModal(this.id);
            });
        });
    </script>

</body>
</html>