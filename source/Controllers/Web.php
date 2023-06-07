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
                $senha = $dados['senha'];
                $email = $dados['email'];

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
}
