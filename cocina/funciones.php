<?php

function obtenerDatos($archivo)
{
    if (!file_exists($archivo)) {
        return [];
    }

    $contenido = file_get_contents($archivo);
    return json_decode($contenido, true);
}

function guardarDatos($archivo, $datos)
{
    file_put_contents(
        $archivo,
        json_encode($datos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    );
}

function filtrarPedidosPorEstado($pedidos, $estado)
{
    return array_filter($pedidos, function ($pedido) use ($estado) {
        return $pedido["estado"] === $estado;
    });
}