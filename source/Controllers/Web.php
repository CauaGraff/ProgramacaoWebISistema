<?php

namespace Source\Controllers;

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
        echo $this->view->render('home');
    }

    public function contato()
    {
        echo $this->view->render('contato');
    }

    public function register(array $dados)
    {
        if (!empty($dados)) {
            $senha = $dados['senha'];
            $email = $dados['email'];
            $primeironome = $dados['primeiroNome'];
            $sobrenome = $dados['sobrenome'];

            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo $this->ajaxResponse([
                    'type' => 'error',
                    'mensagem' => 'E-mail inválido'
                ]);
                return;
            }

            $usuario = new Usuario();
            $usuario->primeiro_nome = $primeironome;
            $usuario->sobrenome = $sobrenome;
            $usuario->senha = password_hash($senha, PASSWORD_DEFAULT);
            $usuario->email = $email;

            if ($usuario->save()) {
                $attempt = compact('email', 'senha');

                // ['email' => 'example@gmail.com', 'senha' => '123']

                if (Auth::attempt($attempt)) {
                    echo $this->ajaxResponse([
                        'type' => 'success',
                        'redirect' => $this->router->route('web.home')
                    ]);

                    return;
                }

                echo $this->ajaxResponse([
                    'type' => 'error',
                    'mensagem' => 'Houve um erro ao tentar realizar o login'
                ]);
                return;
            }

            return;
        }

        echo $this->view->render('register');
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
                    echo "Logado com sucesso!";
                    return;
                }

                echo "Não foi possível realizar o login" . $email;
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
