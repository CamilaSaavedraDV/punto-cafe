<?php

function obtenerUsuarios() {
    return [
        [
            "id" => 1,
            "nombre" => "Milagros Fernandez",
            "email" => "admin@puntocafe.com",
            "password" => "admin",
            "rol" => "admin",
            "vista" => "admin/index.php"
        ],
        [
            "id" => 2,
            "nombre" => "Marcos Baez",
            "email" => "marcos@puntocafe.com",
            "password" => "cocina",
            "rol" => "cocina",
            "vista" => "cocina/index.php"
        ],
        [
            "id" => 3,
            "nombre" => "Mariela Diaz",
            "email" => "mariela@puntocafe.com",
            "password" => "cocina",
            "rol" => "cocina",
            "vista" => "cocina/index.php"
        ],
        [
            "id" => 4,
            "nombre" => "Valentina Martinez",
            "email" => "vale@puntocafe.com",
            "password" => "recepcion",
            "rol" => "recepcion",
            "vista" => "recepcionista/index.php"
        ],

        [
            "id" => 5,
            "nombre" => "Martin Gomez",
            "email" => "martin@puntocafe.com",
            "password" => "encargado",
            "rol" => "encargado",
            "vista" => "encargado/index.php"
        ],

        [
            "id" => 6,
            "nombre" => "Luz Rodriguez",
            "email" => "luzrodriguez@puntocafe.com",
            "password" => "cliente",
            "rol" => "cliente",
            "vista" => "cliente/index.php"
        ]

    ];
}