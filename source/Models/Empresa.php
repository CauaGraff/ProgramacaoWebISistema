<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Empresa extends DataLayer
{
    public function __construct()
    {
        parent::__construct(
            "empresas",
            [
                "CNPJ",
                "razaoSocial",
                "email",
                "fone",
                "uf",
                "id_cidade"
            ],
            'id',
            false
        );
    }
}
