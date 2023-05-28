<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Usuario extends DataLayer
{
    public function __construct()
    {
        parent::__construct(
            "usuarios",
            [
                "ds_usuario",
                "ds_cpf",
                "ds_senha",
                "ds_email",
                "ds_dataNasc",
                "ds_cidade",
                "ds_estado"
            ],
            'cd_usuario',
            false
        );
    }
}
