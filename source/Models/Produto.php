<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Produto extends DataLayer
{
    public function __construct()
    {
        parent::__construct(
            'produto',
            [
                "nome",
                "qtd",
                "preco",
                "descricao",
                "id_empresa",
                "id_uni"
            ],
            "id",
            false
        );
    }

    public function total()
    {
        return "R$ " . number_format($this->qtd * $this->preco, 2, ",", ".");
    }

    public function paraBrl()
    {
        return "R$ " . number_format($this->preco, 2, ",", ".");
    }
}
