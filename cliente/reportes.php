<?php
$usuarioLogueado = [
    "nombre" => "Luz",
    "rol"    => "CLIENTE"
];

$errores = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre   = trim($_POST["nombre"] ?? "");
    $apellido = trim($_POST["apellido"] ?? "");
    $email    = trim($_POST["email"] ?? "");
    $reporte  = trim($_POST["reporte"] ?? "");

    if (empty($nombre))   $errores["nombre"] = "* Este campo es obligatorio.";
    if (empty($apellido)) $errores["apellido"] = "* Este campo es obligatorio.";
    if (empty($email))    $errores["email"] = "* Este campo es obligatorio.";
    if (empty($reporte))  $errores["reporte"] = "* Este campo es obligatorio.";

    if (empty($errores)) {
        header("Location: excelente.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Punto Café - Reportes</title>
    <link rel="stylesheet" href="../css/reportes.css?v=<?php echo time(); ?>">
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
        <div class="panel report-panel">
            <div class="panel-content-wrapper">
                
                <div class="panel-left-content">
                    <div class="panel-header">
                        <span class="panel-icon">📋</span>
                        <div>
                            <h1 class="panel-title">Reportes</h1>
                            <p class="panel-subtitle">Envianos tu consulta, sugerencia o incidencia</p>
                        </div>
                    </div>

                    <div class="form-card">
                        <div class="info-sidebar">
                            <div class="info-header">
                                <div class="info-emoji">💬</div>
                                <h2>Tu opinión nos importa</h2>
                            </div>
                            <p class="info-desc">Contanos cómo podemos mejorar tu experiencia en <strong>PUNTO CAFÉ</strong></p>
                            <div class="info-footer">
                                <span>✔️</span>
                                <p>Tus datos están protegidos y serán usados únicamente para responderte.</p>
                            </div>
                        </div>

                        <form action="reportes.php" method="POST" class="report-form" novalidate>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <?php if (isset($errores["nombre"])): ?>
                                    <span class="error-msg"><?= $errores["nombre"] ?></span>
                                <?php endif; ?>
                                <div class="input-wrapper">
                                    <span class="input-emoji">👤</span>
                                    <input type="text" id="nombre" name="nombre" placeholder="Escribí tu nombre" value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="apellido">Apellido</label>
                                <?php if (isset($errores["apellido"])): ?>
                                    <span class="error-msg"><?= $errores["apellido"] ?></span>
                                <?php endif; ?>
                                <div class="input-wrapper">
                                    <span class="input-emoji">👤</span>
                                    <input type="text" id="apellido" name="apellido" placeholder="Escribí tu apellido" value="<?= htmlspecialchars($_POST['apellido'] ?? '') ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <?php if (isset($errores["email"])): ?>
                                    <span class="error-msg"><?= $errores["email"] ?></span>
                                <?php endif; ?>
                                <div class="input-wrapper">
                                    <span class="input-emoji">✉️</span>
                                    <input type="email" id="email" name="email" placeholder="Escribí tu email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="reporte">Reporte</label>
                                <?php if (isset($errores["reporte"])): ?>
                                    <span class="error-msg"><?= $errores["reporte"] ?></span>
                                <?php endif; ?>
                                <div class="input-wrapper alignment-top">
                                    <span class="input-emoji">💬</span>
                                    <textarea id="reporte" name="reporte" placeholder="Contanos tu consulta, sugerencia o incidencia..." rows="3"><?= htmlspecialchars($_POST['reporte'] ?? '') ?></textarea>
                                </div>
                            </div>

                            <button type="submit" class="btn-submit">
                                🚀 Enviar reporte
                            </button>
                        </form>
                    </div>
                </div>

                <div class="image-sidebar"></div>

            </div>
        </div>

        <footer class="help-footer">
            <div class="help-content">
                <span class="help-emoji">🎧</span>
                <div>
                    <h3>¿Necesitas ayuda inmediata?</h3>
                    <p>Contactanos por nuestras redes o escribinos a <a href="mailto:puntocafe@gmail.com">puntocafe@gmail.com</a></p>
                </div>
            </div>
        </footer>
    </main>

</body>
</html>