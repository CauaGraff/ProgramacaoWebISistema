<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Usuario extends DataLayer
{
    public function __construct()
    {
        parent::__construct("usuarios", [
            "primeiro_nome", "sobrenome",
            "email", "senha"
        ], 'id', false);
    }
}
