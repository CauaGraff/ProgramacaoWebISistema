<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Clientes extends DataLayer
{
    public function __construct()
    {
        parent::__construct(
            "clientes",
            [
                "nome",
                "dataNasc",
                "CPF",
                "email",
                "fone",
                "uf",
                "cidade_id",
                "ncasa"
            ],
            'id',
            false
        );
    }
}
