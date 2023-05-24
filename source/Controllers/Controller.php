<?php

namespace Source\Controllers;

use League\Plates\Engine;
use Source\Controllers\Auth;
use CoffeeCode\Router\Router;

class Controller
{
    protected $view;
    protected $router;

    public function __construct(Router $router)
    {
        $this->view = Engine::create(dirname(__DIR__, 2) . "/theme", "php");
        $this->router = $router;

        // adicionar uma variável a todas as rotas
        $this->view->addData([
            'router' => $this->router,
            'user' => Auth::user()
        ]);
    }

    public function ajaxResponse(array $mensagem)
    {
        return json_encode($mensagem);
    }
}
