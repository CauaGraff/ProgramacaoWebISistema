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
        if (!empty($dados) && $dados['id'] == 0) {
            $nome = $dados['ds_usuario'];
            $cpf = $dados['ds_cpf'];
            $dataNasc  = $dados['dt_nascimento'];
            $uf = $dados['ds_uf'];
            $cidade = $dados['ds_cidade'];
            $senha = $dados['ds_senha'];
            $email = $dados['ds_email'];

            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo $this->ajaxResponse([
                    'type' => 'error',
                    'mensagem' => 'E-mail inválido'
                ]);
                return;
            }

            $usuario = new Usuario();
            $usuario->ds_usuario = $nome;
            $usuario->ds_cpf = $cpf;
            $usuario->ds_senha = password_hash($senha, PASSWORD_DEFAULT);
            $usuario->ds_email = $email;
            $usuario->ds_dataNasc = $dataNasc;
            $usuario->ds_cidade = $cidade;
            $usuario->ds_estado = $uf;


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

            if (!empty($data) && $data['acao'] == "update") {
                echo "ATUALIZAR";
                return;
            }
            $usuarioId = $data["id"];
            $model = new Usuario();
            $usuario = $model->findById($usuarioId)->data();

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
            echo $this->view->render('register', compact('usuario', 'ufs', 'usuarioId'));
            return;
        }
        $this->router->redirect('web.login');
        return;
    }
}
