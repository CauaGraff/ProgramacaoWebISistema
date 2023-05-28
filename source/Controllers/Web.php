<?php

namespace Source\Controllers;

use CoffeeCode\DataLayer\Connect;
use CoffeeCode\Router\Router;
use Source\Controllers\Controller;
use Source\Models\Usuario;

class Web extends Controller
{
    public function __construct(Router $router)
    {
        parent::__construct($router);
    }

    public function home()
    {
        if (Auth::verify('usuario_id')) {
            echo $this->view->render('home');
            return;
        }

        $this->router->redirect('web.login');
        return;
    }

    public function contato()
    {
        echo $this->view->render('contato');
    }

    public function register(array $dados)
    {
        if (!empty($dados)) {
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

    public function cidades(array $data)
    {
        $ds_uf = $data['ufid'];
        /** GET PDO instance AND errors*/
        $connect = Connect::getInstance();
        $error = Connect::getError();

        /** CHECK connection/errors */
        if ($error) {
            echo $error->getMessage();
            exit;
        }

        /** FETCH DATA*/
        $cidades = $connect->query("SELECT cd_cidade, ds_cidade FROM cidades WHERE ds_uf = '" . $ds_uf . "' ORDER BY ds_cidade ASC")
            ->fetchAll();
        echo json_encode($cidades);
    }

    public function login(array $dados)
    {
        // se ele não tem sessão
        if (!Auth::verify('usuario_id')) {
            if (!empty($dados)) {
                $senha = $dados['ds_senha'];
                $email = $dados['ds_email'];

                if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo "E-mail inválido";
                    return;
                }

                if (empty($senha)) {
                    echo "Senha inválida";
                    return;
                }

                if (Auth::attempt($dados)) {
                    $this->router->redirect('web.home');
                    return;
                }

                echo "Não foi possível realizar o login " . $email;
                return;
            }

            echo $this->view->render('login');
            return;
        }

        $this->router->redirect('web.home');
    }

    public function logout()
    {
        if (Auth::verify('usuario_id')) {
            session_destroy();

            $this->router->redirect('web.login');
        }
    }

    public function usuarios()
    {
        if (Auth::verify('usuario_id')) {

            $usuarios = (new Usuario())->find()->fetch(true);
            echo $this->view->render('listausuarios', compact('usuarios'));
            return;
        }

        $this->router->redirect('web.login');
        return;
    }

    public  function atualizaUsuarios(array $data)
    {
        var_dump($data);
    }
}
