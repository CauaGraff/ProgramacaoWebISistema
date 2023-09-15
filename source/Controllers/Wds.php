<?php

namespace Source\Controllers;

use Source\Models\Usuario;
use CoffeeCode\Router\Router;
use Source\Controllers\Controller;
use CoffeeCode\DataLayer\Connect;
use Source\Models\Clientes;

class Wds extends Controller
{
    public function __construct(Router $router)
    {
        parent::__construct($router);
    }

    public function index()
    {
        echo $this->view->render('WDS/wds');
    }

    public function clientes()
    {
        $linhas = [];
        /*
 * GET PDO instance AND errors
 */
        $connect = Connect::getInstance();
        $error = Connect::getError();

        /*
 * CHECK connection/errors
 */
        if ($error) {
            echo $error->getMessage();
            exit;
        }
        /*
 * FETCH DATA
 */
        $clientes = $connect->query("SELECT c.id, c.nome, c.dataNasc, c.CPF, c.email, c.fone, c.uf, c.ncasa, ci.ds_cidade FROM clientes c inner JOIN cidades ci on ci.cd_cidade = c.cidade_id ");

        foreach ($clientes as $cliente) {
            $id = $cliente->id;
            $nome = $cliente->nome;
            $dataNasc = $cliente->dataNasc;
            $cpf = $cliente->CPF;
            $email = $cliente->email;
            $fone = $cliente->fone;
            $uf = $cliente->uf;
            $cidade_id = $cliente->ds_cidade;
            $nCasa = $cliente->ncasa;
            $linhas[] = ['id' => $id, 'nome' => $nome, 'dataNasc' => $dataNasc, 'cpf' => $cpf, 'email' => $email, 'fone' => $fone, 'uf' => $uf, 'cidade_id' => $cidade_id, 'nCasa' => $nCasa];
        }


        $json_string = json_encode($linhas);
        echo $json_string;
        return;
    }
}
