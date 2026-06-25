<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre      = $_POST["nombre"]      ?? "";
    $precio      = intval($_POST["precio"] ?? 0);
    $descripcion = $_POST["descripcion"] ?? "";
    $imagen      = $_POST["imagen"]      ?? "";

    $encontrado = false;
    foreach ($_SESSION["carrito"] as &$item) {
        if ($item["nombre"] === $nombre) {
            $item["cantidad"]++;
            $encontrado = true;
            break;
        }
    }

    if (!$encontrado) {
        $_SESSION["carrito"][] = [
            "nombre"      => $nombre,
            "precio"      => $precio,
            "descripcion" => $descripcion,
            "imagen"      => $imagen,
            "cantidad"    => 1
        ];
    }
}

header("Location: productos.php");
exit;