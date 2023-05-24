<?php

namespace Source\Controllers;

use CoffeeCode\Router\Router;
use Source\Controllers\Controller;
use Source\Models\Produto;

class Carrinho extends Controller
{
    public function __construct(Router $router)
    {
        parent::__construct($router);
    }

    public function index()
    {
        $produtos = [];
        $carrinho = !empty($_SESSION['produtos']) ? $_SESSION['produtos'] : false;

        if ($carrinho) {
            foreach ($carrinho as $produto) {
                $produto = (new Produto())
                    ->find('id = :id', "id={$produto['produtoId']}")
                    ->fetch()
                    ->data();

                $carrinho[$produto->id]['nome'] = $produto->nome;
                $carrinho[$produto->id]['descricao'] = $produto->descricao;
            }
        }

        echo $this->view->render('carrinho', compact('carrinho'));
    }

    public function add(array $dados)
    {
        $produtoId = $dados['produtoId'];
        $quantidade = $dados['quantidade'];

        if (!intval($quantidade)) {
            $quantidade = str_replace('+=', '', $quantidade);
            $_SESSION['produtos'][$produtoId]['quantidade'] += $quantidade;

            echo $this->ajaxResponse([
                'message' => 'Produto adicionado.',
                'type' => 'success',
                'quantidade' => $_SESSION['produtos'][$produtoId]['quantidade']
            ]);
            return;
        }


        $produto = new Produto();

        if ($produto = $produto->find('id = :id', "id={$produtoId}")->fetch()) {

            if (empty($_SESSION['produtos'][$produtoId])) {
                $_SESSION['produtos'][$produtoId] = [
                    'produtoId' => $produtoId,
                    'quantidade' => $quantidade
                ];
            }

            if (!empty($_SESSION['produtos'][$produtoId])) {
                $_SESSION['produtos'][$produtoId]['quantidade'] = $quantidade;
            }

            var_dump($_SESSION);
            return;
        }
    }

    public function remove(array $dados)
    {
        $produtoId = $dados['produtoId'];
        $quantidade = $dados['quantidade'];


        if (!intval($quantidade)) {
            $quantidade = str_replace('+=', '', $quantidade);
            $_SESSION['produtos'][$produtoId]['quantidade'] -= $quantidade;

            echo $this->ajaxResponse([
                'message' => 'Produto removido.',
                'type' => 'success',
                'quantidade' => $_SESSION['produtos'][$produtoId]['quantidade']
            ]);
            return;
        }


        if (empty($quantidade)) {
            unset($_SESSION['produtos'][$produtoId]);

            echo $this->ajaxResponse([
                'type' => 'success',
                'message' => 'Produtos removidos'
            ]);
            return;
        }
    }
}
