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
        var_dump($dados);
        if (!empty($dados)) {
            $nome = $dados['nome'];
            $cpf = $dados['cpf'];
            $dataNasc  = $dados['dataNasc'];
            $uf = $dados['uf'];
            $cidade = $dados['cidade'];
            $senha = $dados['senha'];
            $email = $dados['email'];

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
        echo $this->view->render('register', compact('ufs'));
    }

    public  function update(array $data)
    {
        if (Auth::verify('usuario_id')) {

            echo $this->view->render('register');
            return;
        }
        $this->router->redirect('web.login');
        return;
    }
}
