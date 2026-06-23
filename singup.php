<?php
$errores = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre    = trim($_POST["nombre"]    ?? "");
    $telefono  = trim($_POST["telefono"]  ?? "");
    $email     = trim($_POST["email"]     ?? "");
    $direccion = trim($_POST["direccion"] ?? "");

    if (empty($nombre))    $errores["nombre"]    = "Este campo es obligatorio.";
    if (empty($telefono))  $errores["telefono"]  = "Este campo es obligatorio.";
    if (empty($email))     $errores["email"]     = "Este campo es obligatorio.";
    if (empty($direccion)) $errores["direccion"] = "Este campo es obligatorio.";

    if (empty($errores)) {
        header("Location: mesas.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Punto Café – Crear cuenta</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <nav class="navbar">
        <a href="index.php" class="navbar-brand">
            <span class="brand-icon">☕</span>
            <span class="brand-text">
                <span class="brand-name">PUNTO CAFÉ</span>
            </span>
        </a>
        <a href="login.php" class="navbar-login">
            <svg viewBox="0 0 24 24">
                <circle cx="12" cy="8" r="4"/>
                <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
            </svg>
            Iniciar sesión
        </a>
    </nav>

    <main class="main">
        <div class="card">

            <div class="card-header">
                <div class="card-logo">☕</div>
                <div class="card-brand">PUNTO CAFÉ</div>
                <h1 class="card-title">Crear cuenta</h1>
                <p class="card-subtitle">Registrate para realizar pedidos</p>
            </div>

            <form method="POST" action="singup.php" autocomplete="off">

                <div class="form-group">
                    <label class="form-label">Nombre y apellido</label>
                    <?php if (isset($errores["nombre"])): ?>
                        <span class="form-required">* <?= $errores["nombre"] ?></span>
                    <?php endif; ?>
                    <div class="input-wrapper">
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                        <input
                            type="text"
                            name="nombre"
                            class="form-control"
                            placeholder="Ingresa tu nombre y apellido"
                            value="<?= htmlspecialchars($_POST["nombre"] ?? "") ?>"
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Teléfono</label>
                    <?php if (isset($errores["telefono"])): ?>
                        <span class="form-required">* <?= $errores["telefono"] ?></span>
                    <?php endif; ?>
                    <div class="input-wrapper">
                        <svg viewBox="0 0 24 24"><path d="M6.6 10.8a15.1 15.1 0 0 0 6.6 6.6l2.2-2.2a1 1 0 0 1 1-.25 11.4 11.4 0 0 0 3.6.6 1 1 0 0 1 1 1V18a1 1 0 0 1-1 1A17 17 0 0 1 3 5a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.45.57 3.57a1 1 0 0 1-.25 1z"/></svg>
                        <input
                            type="tel"
                            name="telefono"
                            class="form-control"
                            placeholder="Ingresa tu teléfono de contacto"
                            value="<?= htmlspecialchars($_POST["telefono"] ?? "") ?>"
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <?php if (isset($errores["email"])): ?>
                        <span class="form-required">* <?= $errores["email"] ?></span>
                    <?php endif; ?>
                    <div class="input-wrapper">
                        <svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg>
                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            placeholder="Ingresa tu email"
                            value="<?= htmlspecialchars($_POST["email"] ?? "") ?>"
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Dirección</label>
                    <?php if (isset($errores["direccion"])): ?>
                        <span class="form-required">* <?= $errores["direccion"] ?></span>
                    <?php endif; ?>
                    <div class="input-wrapper">
                        <svg viewBox="0 0 24 24"><path d="M12 2C8.1 2 5 5.1 5 9c0 5.2 7 13 7 13s7-7.8 7-13c0-3.9-3.1-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>
                        <input
                            type="text"
                            name="direccion"
                            class="form-control"
                            placeholder="Ingresa tu dirección"
                            value="<?= htmlspecialchars($_POST["direccion"] ?? "") ?>"
                        >
                    </div>
                </div>

                <button type="submit" class="btn-primary">Registrarse</button>

                <div class="divider">
                    <div class="divider-line"></div>
                    <div class="divider-dot"></div>
                    <div class="divider-line"></div>
                </div>

                <div class="card-footer">
                    ¿Ya tenes cuenta? <a href="login.php">Iniciar sesión</a>
                </div>

            </form>
        </div>
    </main>

</body>
</html>