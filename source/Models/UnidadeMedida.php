<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class UnidadeMedida extends DataLayer
{
    public function __construct()
    {
        parent::__construct(
            "unidademedida",
            [
                "nome", "simbolo", "descricao"
            ],
            'id',
            false
        );
    }
}
