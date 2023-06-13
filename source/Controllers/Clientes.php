<?php

namespace Source\Controllers;

use CoffeeCode\DataLayer\Connect;
use CoffeeCode\Router\Router;
use Source\Controllers\Controller;
use Source\Models\Clientes as ModelsClientes;

class Clientes extends Controller
{
    public function __construct(Router $router)
    {
        parent::__construct($router);
    }

    public function index()
    {
        if (Auth::verify('usuario_id')) {
            $clientes = (new ModelsClientes())->find()->fetch(true);
            echo $this->view->render('listaclientes', compact('clientes'));
            return;
        }

        $this->router->redirect('web.login');
        return;
    }

    public function register(array $dados)
    {
        if (Auth::verify('usuario_id')) {

            if (!empty($dados)) {
                $nome = $dados['nome'];
                $cpf = $dados['cpf'];
                $fone  = $dados['fone'];
                $uf = $dados['uf'];
                $cidade = $dados['cidade'];
                $email = $dados['email'];
                $ncasa = $dados['ncasa'];
                $dataNasc = $dados['dataNasc'];

                if (empty($nome)) {
                    $erro['nome'] = "Preencha um nome";
                }

                if (empty($cpf) || !validaCPF($cpf)) {
                    $erro['cpf'] = "Preencha um CPF valido";
                }

                if (empty($fone)) {
                    $erro['fone'] = "Preencha o telefone";
                }

                if (empty($uf)) {
                    $erro['uf'] = "Selecione um Estado";
                }

                if (empty($cidade)) {
                    $erro['cidade'] = "Selecione uma Cidade";
                }

                if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $erro['email'] = "E-mail invalido";
                }

                if (empty($ncasa)) {
                    $erro['ncasa'] = "Preencha o Nº casa";
                }

                if (empty($dataNasc)) {
                    $erro['dataNasc'] = "Preencha a data de nascimento";
                }

                if (!empty($erro)) {
                    echo $this->ajaxResponse($erro);
                    return;
                }

                $cliente = new ModelsClientes();
                $cliente->nome = $nome;
                $cliente->CPF = $cpf;
                $cliente->dataNasc = $dataNasc;
                $cliente->ncasa = $ncasa;
                $cliente->cidade_id = $cidade;
                $cliente->uf = $uf;
                $cliente->email = $email;
                $cliente->fone = $fone;

                if ($cliente->save()) {
                    echo $this->ajaxResponse([
                        'type' => 'success',
                        'redirect' => $this->router->route('clientes.home')
                    ]);
                    return;
                }

                return;
            }

            /** GET PDO instance AND errors*/
            $connect = Connect::getInstance();
            $error = Connect::getError();

            /** CHECK connection/errors */
            if ($error) {
                echo $error->getMessage();
                exit;
            }

            /** FETCH DATA*/
            $ufs = $connect->query("SELECT ds_uf FROM cidades GROUP BY ds_uf ORDER BY ds_uf")->fetchAll();
            $clienteId = 0;
            echo $this->view->render('registerclientes', compact('ufs', 'clienteId'));
            return;
        }

        $this->router->redirect('web.login');
        return;
    }

    public  function update(array $data)
    {
        if (Auth::verify('usuario_id')) {
            if (!empty($data)) {
                if (array_key_exists("type", $data)) {
                    $id = $data['id'];
                    $nome = $data['nome'];
                    $cpf = $data['cpf'];
                    $fone  = $data['fone'];
                    $uf = $data['uf'];
                    $cidade = $data['cidade'];
                    $email = $data['email'];
                    $ncasa = $data['ncasa'];
                    $dataNasc = $data['dataNasc'];

                    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        echo $this->ajaxResponse([
                            'type' => 'error',
                            'mensagem' => 'E-mail inválido'
                        ]);
                        return;
                    }

                    $cliente = (new ModelsClientes())->findById($id);
                    $cliente->nome = $nome;
                    $cliente->CPF = $cpf;
                    $cliente->dataNasc = $dataNasc;
                    $cliente->ncasa = $ncasa;
                    $cliente->cidade_id = $cidade;
                    $cliente->uf = $uf;
                    $cliente->email = $email;
                    $cliente->fone = $fone;
                    if ($cliente->save()) {
                        echo $this->ajaxResponse([
                            'type' => 'success',
                            'redirect' => $this->router->route('clientes.home')
                        ]);
                        return;
                    }
                    return;
                }
                $clienteId = $data['id'];
                /** GET PDO instance AND errors*/
                $connect = Connect::getInstance();
                $error = Connect::getError();

                /** CHECK connection/errors */
                if ($error) {
                    echo $error->getMessage();
                    exit;
                }

                /** FETCH DATA*/
                $ufs = $connect->query("SELECT ds_uf FROM cidades GROUP BY ds_uf ORDER BY ds_uf")
                    ->fetchAll();
                echo $this->view->render('registerclientes', compact('clienteId', 'ufs'));
                return;
            }
        }
        $this->router->redirect('web.login');
        return;
    }

    public function dados(array $data)
    {
        if (Auth::verify('usuario_id')) {
            if (!empty($data)) {
                $id = $data['id'];
                /* * GET PDO instance AND errors */
                $connect = Connect::getInstance();
                $error = Connect::getError();
                /* * CHECK connection/errors */
                if ($error) {
                    echo $error->getMessage();
                    exit;
                }
                /* * FETCH DATA */
                $users = [];
                $users = $connect->query("SELECT * FROM clientes WHERE id={$id}")->fetchAll();
                echo $this->ajaxResponse([
                    "data" => $users,
                    "type" => "success"
                ]);
                return;
            }
        }
        $this->router->redirect('web.login');
        return;
    }

    public function delet(array $data)
    {
        if (Auth::verify('usuario_id')) {
            if (!empty($data)) {
                $id = $data['id'];
                $user = (new ModelsClientes())->findById($id);
                if ($user->destroy()) {
                    echo $this->ajaxResponse([
                        'type' => 'success',
                        'redirect' => $this->router->route('clientes.home')
                    ]);
                    return;
                }
            }
        }
        $this->router->redirect('web.login');
        return;
    }
}
