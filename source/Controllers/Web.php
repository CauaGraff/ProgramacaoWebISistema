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

        if (!empty($dados)) {
            $senha = $dados['senha'];
            $email = $dados['email'];

            $erro = [];

            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $erro["email"] = "Prencha o e-mail";
            }

            if (empty($senha)) {
                $erro["senha"] = "Preencha a senha";
            }

            if (!empty($erro)) {
                echo $this->ajaxResponse($erro);
                return;
            }

            if (Auth::attempt($dados)) {
                echo $this->ajaxResponse([
                    'type' => 'success',
                    'redirect' => $this->router->route('web.home')
                ]);
                return;
            }

            echo $this->ajaxResponse(
                [
                    "type" => "erro",
                    "mensagem" => "Não foi possível realizar o login " . $email
                ]
            );
            return;
        }

        echo $this->view->render('login');
        return;
    }

    public function logout()
    {
        if (Auth::verify('usuario_id')) {
            session_destroy();

            $this->router->redirect('web.login');
        }
    }
}
