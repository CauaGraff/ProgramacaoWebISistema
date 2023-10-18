<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class LogsWS extends DataLayer
{
    public function __construct()
    {
        parent::__construct(
            "logs_ws",
            [
                "dataAcesso",
                "es",
                "entidade",
                "origem",
                "registros",
                "atualizados",
                "inseridos"
            ],
            'id',
            false
        );
    }
}
