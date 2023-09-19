<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Cidades extends DataLayer
{
    public function __construct()
    {
        parent::__construct(
            "cidades",
            [
                "ds_cidade",
                "cd_cidade_ibge",
                "ds_uf",
                "cd_uf_ibge",
                "vl_latitude",
                "vl_longitude"
            ],
            'cd_cidade',
            false
        );
    }
}
