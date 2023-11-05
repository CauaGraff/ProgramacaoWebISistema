<?php

namespace Source\Controllers;

use DateTime;
use DateTimeZone;
use Source\Models\LogsWS;
use Source\Models\Cidades;
use Source\Models\Empresa;
use Source\Models\Produto;
use Source\Models\Clientes;
use Source\Models\UsuarioWS;
use CoffeeCode\Router\Router;
use Source\Models\UnidadeMedida;
use CoffeeCode\DataLayer\Connect;
use Source\Controllers\Controller;

class wsCaua extends Controller
{
    private $idWsUsuario = 2;
    public function __construct(Router $router)
    {
        parent::__construct($router);
    }

    public function index()
    {
    }
}
