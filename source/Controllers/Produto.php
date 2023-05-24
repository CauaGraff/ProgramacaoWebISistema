<?php

namespace Source\Controllers;

use Source\Models\Produto as ProdutoModel;
use Source\Models\Usuario;
use CoffeeCode\Router\Router;
use Source\Controllers\Controller;

class Produto extends Controller
{
    public function __construct(Router $router)
    {
        parent::__construct($router);
    }

    public function index()
    {
        $produtos = (new ProdutoModel())->find()->fetch(true);
        echo $this->view->render('produtos', compact('produtos'));
    }
}
