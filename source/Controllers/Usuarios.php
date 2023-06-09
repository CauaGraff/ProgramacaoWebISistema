<?php

namespace Source\Controllers;

use CoffeeCode\DataLayer\Connect;
use CoffeeCode\Router\Router;
use Source\Controllers\Controller;
use Source\Models\Usuario;

class Usuarios extends Controller
{
    public function __construct(Router $router)
    {
        parent::__construct($router);
    }

    public function index()
    {
        if (Auth::verify('usuario_id')) {

            $usuarios = (new Usuario())->find()->fetch(true);
            echo $this->view->render('listausuarios', compact('usuarios'));
            return;
        }

        $this->router->redirect('web.login');
        return;
    }

    public function register(array $dados)
    {

        if (!empty($dados)) {
            $nome = $dados['nome'];
            $cpf = $dados['cpf'];
            $dataNasc  = $dados['dataNasc'];
            $uf = $dados['uf'];
            $cidade = $dados['cidade'];
            $senha = $dados['senha'];
            $email = $dados['email'];

            $erro = [];

            if (empty($nome)) {
                $erro['nome'] = "Preencha o Nome";
            }

            if (empty($cpf)) {
                $erro['cpf'] = "Preencha o CPF";
            }

            if (empty($dataNasc)) {
                $erro['dataNasc'] = "Preencha a data de nascimento";
            }

            if (empty($uf)) {
                $erro['uf'] = "Selecione um estado";
            }

            if (empty($cidade)) {
                $erro['cidade'] = "Selecione uma cidade";
            }

            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $erro['email'] = "E-mail invalido";
            }

            if (empty($senha) || strlen($senha) <= 7) {
                $erro['senha'] = "Senha Invalida, Minimo de digitos é 8";
            }

            if (!empty($erro)) {
                echo $this->ajaxResponse($erro);
                return;
            }

            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo $this->ajaxResponse([
                    'type' => 'error',
                    'mensagem' => 'E-mail inválido'
                ]);
                return;
            }

            $usuario = new Usuario();
            $usuario->nome = $nome;
            $usuario->CPF = $cpf;
            $usuario->senha = password_hash($senha, PASSWORD_DEFAULT);
            $usuario->email = $email;
            $usuario->dataNasc = $dataNasc;
            $usuario->cidade = $cidade;
            $usuario->estado = $uf;


            if ($usuario->save()) {
                // $attempt = compact('email', 'senha');

                // // ['email' => 'example@gmail.com', 'senha' => '123']

                // if (Auth::attempt($attempt)) {
                //     echo $this->ajaxResponse([
                //         'type' => 'success',
                //         'redirect' => $this->router->route('web.home')
                //     ]);

                //     return;
                // }


                echo $this->ajaxResponse([
                    'type' => 'success',
                    'redirect' => $this->router->route('web.home')
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
        $ufs = $connect->query("SELECT ds_uf FROM cidades GROUP BY ds_uf ORDER BY ds_uf")
            ->fetchAll();
        $usuarioId = 0;
        echo $this->view->render('register', compact('ufs', 'usuarioId'));
    }

    public  function update(array $data)
    {
        if (Auth::verify('usuario_id')) {
            if (!empty($data)) {
                if (array_key_exists("type", $data)) {
                    $id = $data['id'];
                    $nome = $data['nome'];
                    $cpf = $data['cpf'];
                    $dataNasc  = $data['dataNasc'];
                    $uf = $data['uf'];
                    $cidade = $data['cidade'];
                    $senha = $data['senha'];
                    $email = $data['email'];

                    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        echo $this->ajaxResponse([
                            'type' => 'error',
                            'mensagem' => 'E-mail inválido'
                        ]);
                        return;
                    }

                    $usuario = (new Usuario())->findById($id);
                    $usuario->nome = $nome;
                    $usuario->CPF = $cpf;
                    if ($usuario->senha !== $senha) {
                        $usuario->senha = password_hash($senha, PASSWORD_DEFAULT);
                    }
                    $usuario->email = $email;
                    $usuario->dataNasc = $dataNasc;
                    $usuario->cidade = $cidade;
                    $usuario->estado = $uf;
                    if ($usuario->save()) {
                        echo $this->ajaxResponse([
                            'type' => 'success',
                            'redirect' => $this->router->route('web.home')
                        ]);
                        return;
                    }
                    return;
                }
                $usuarioId = $data['id'];
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
                echo $this->view->render('register', compact('usuarioId', 'ufs'));
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
                $users = $connect->query("SELECT u.*, c.ds_cidade FROM usuarios u INNER JOIN cidades c on u.cidade = c.cd_cidade WHERE id={$id}")->fetchAll();
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
                $user = (new Usuario())->findById($id);
                if ($user->destroy()) {
                    echo $this->ajaxResponse([
                        'type' => 'success',
                        'redirect' => $this->router->route('web.home')
                    ]);
                    return;
                }
            }
        }
        $this->router->redirect('web.login');
        return;
    }
}
