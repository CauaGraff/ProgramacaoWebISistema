<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Orcamento extends DataLayer
{
    public function __construct()
    {
        parent::__construct(
            'orcamentos',
            [
                "dataOrcamento",
                "cliente_id",
                "usuario_id",
                "valor",
                "obs",
            ],
            "id",
            false
        );
    }
}
