<?php

namespace Source\Controllers;

use CoffeeCode\Router\Router;
use Source\Controllers\Controller;
use Source\Models\Usuario;
use Source\Models\UsuarioWS;

class Auth extends Controller
{
    public function __construct(Router $router)
    {
        parent::__construct($router);
    }

    public static function attempt(array $dados): bool
    {
        $senha = $dados['senha'];
        $email = $dados['email'];

        $usuario = new Usuario();
        $usuario->find('email = :email', "email={$email}");

        if (!$usuario = $usuario->fetch()) {
            return false;
        }

        if (!password_verify($senha, $usuario->senha)) {
            return false;
        }

        $_SESSION['usuario_id'] = $usuario->id;
        return true;
    }

    public static function attemptUserWs(array $dados): bool
    {
        $pwd = $dados['pwd'];
        $id = $dados['id'];

        $usuario = new UsuarioWS();
        $usuario->findById($id);

        if (!$usuario = $usuario->fetch()) {
            return false;
        }

        if ($pwd != $usuario->psw) {
            return false;
        }

        return true;
    }

    public static function verify(string $chave): bool
    {
        // se existe uma sessão
        if (!empty($_SESSION[$chave])) {
            return true;
        }

        return false;
    }

    public static function user()
    {
        if (static::verify('usuario_id')) {
            $usuarioId = $_SESSION['usuario_id'];

            return (new Usuario)
                ->find('id = :id', "id={$usuarioId}")
                ->fetch()
                ->data();
        }

        return false;
    }
}
