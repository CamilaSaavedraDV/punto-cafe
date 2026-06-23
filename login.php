<?php

require "usuarios.php";

$errores = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email    = trim($_POST["email"] ?? "");
    $password = trim($_POST["password"] ?? "");

    if (empty($email))    $errores["email"] = "Este campo es obligatorio.";
    if (empty($password)) $errores["password"] = "Este campo es obligatorio.";

    if (empty($errores)) {

        $usuarios = obtenerUsuarios();
        $usuarioEncontrado = null;

        foreach ($usuarios as $u) {
            if ($u["email"] === $email && $u["password"] === $password) {
                $usuarioEncontrado = $u;
                break;
            }
        }

        if ($usuarioEncontrado) {

            session_start();
            $_SESSION["usuario"] = $usuarioEncontrado;

            header("Location: " . $usuarioEncontrado["vista"]);
            exit;

        } else {
            $errores["login"] = "Credenciales incorrectas.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Punto Café – Iniciar sesión</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <nav class="navbar">
        <a href="singup.php" class="navbar-brand">
            <span class="brand-icon">☕</span>
            <span class="brand-text">
                <span class="brand-name">PUNTO CAFÉ</span>
            </span>
        </a>
        <a href="singup.php" class="navbar-login">
            <svg viewBox="0 0 24 24">
                <circle cx="12" cy="8" r="4"/>
                <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
            </svg>
            Registrarse
        </a>
    </nav>

    <main class="main">
        <div class="card">

            <div class="card-header">
                <div class="card-logo">☕</div>
                <div class="card-brand">PUNTO CAFÉ</div>
                <h1 class="card-title">Iniciar sesión</h1>
                <p class="card-subtitle">Ingresá para acceder al sistema</p>
            </div>

            <form method="POST" action="login.php">

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
                    <label class="form-label">Contraseña</label>
                    <?php if (isset($errores["password"])): ?>
                        <span class="form-required">* <?= $errores["password"] ?></span>
                    <?php endif; ?>
                    <div class="input-wrapper">
                        <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="Ingresa tu contraseña"
                        >
                    </div>
                </div>

                <button type="submit" class="btn-primary">Iniciar sesión</button>

                <div class="divider">
                    <div class="divider-line"></div>
                    <div class="divider-dot"></div>
                    <div class="divider-line"></div>
                </div>

                <div class="card-footer">
                    ¿No tenes cuenta? <a href="singup.php">Registrarse</a>
                </div>

            </form>
        </div>
    </main>

</body>
</html>