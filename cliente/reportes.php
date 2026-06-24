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
    <title>Punto Café - Reportes</title>
    <link rel="stylesheet" href="../css/reportes.css">
</head>
<body>

    <header class="main-header">
        <div class="header-container">
            <div class="logo">
                <span>☕ PUNTO CAFÉ</span>
            </div>
            
            <nav class="navbar-center">
                <a href="#" class="nav-link">Productos</a>
                <a href="#" class="nav-link">Mis pedidos</a>
                <a href="#" class="nav-link active">Reportes</a>
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

                        <form action="procesar_reporte.php" method="POST" class="report-form">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <div class="input-wrapper">
                                    <span class="input-emoji">👤</span>
                                    <input type="text" id="nombre" name="nombre" placeholder="Escribí tu nombre" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="apellido">Apellido</label>
                                <div class="input-wrapper">
                                    <span class="input-emoji">👤</span>
                                    <input type="text" id="apellido" name="apellido" placeholder="Escribí tu apellido" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <div class="input-wrapper">
                                    <span class="input-emoji">✉️</span>
                                    <input type="email" id="email" name="email" placeholder="Escribí tu email" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="reporte">Reporte</label>
                                <div class="input-wrapper alignment-top">
                                    <span class="input-emoji">💬</span>
                                    <textarea id="reporte" name="reporte" placeholder="Contanos tu consulta, sugerencia o incidencia..." rows="3" required></textarea>
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