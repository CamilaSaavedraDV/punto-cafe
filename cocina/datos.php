<?php

require_once "funciones.php";

$pedidos = obtenerDatos("pedidos.json");
$stock = obtenerDatos("stock.json");

$resumen = [
    "pendiente" => count(filtrarPedidosPorEstado($pedidos, "pendiente")),
    "en_preparacion" => count(filtrarPedidosPorEstado($pedidos, "en_preparacion")),
    "disponible" => count(filtrarPedidosPorEstado($pedidos, "disponible")),
    "cancelado" => count(filtrarPedidosPorEstado($pedidos, "cancelado"))
];