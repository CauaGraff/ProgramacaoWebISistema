<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class UsuarioWS extends DataLayer
{
    public function __construct()
    {
        parent::__construct(
            "user_ws",
            [
                "user",
                "psw"
            ],
            'id',
            false
        );
    }
}
