<?php

namespace Source\Controllers;

use CoffeeCode\DataLayer\Connect;
use CoffeeCode\Router\Router;
use Source\Controllers\Controller;
use Source\Models\Empresa;

class Empresas extends Controller
{
    public function __construct(Router $router)
    {
        parent::__construct($router);
    }

    public function index()
    {
        if (Auth::verify('usuario_id')) {

            $empresas = (new Empresa())->find()->fetch(true);
            echo $this->view->render('listaempresas', compact('empresas'));
            return;
        }

        $this->router->redirect('web.login');
        return;
    }

    public function register(array $dados)
    {
        if (Auth::verify('usuario_id')) {

            if (!empty($dados)) {
                $CNPJ = $dados['CNPJ'];
                $razaoSocial = $dados['razaoSocial'];
                $fone  = $dados['fone'];
                $uf = $dados['uf'];
                $cidade = $dados['cidade'];
                $email = $dados['email'];

                if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo $this->ajaxResponse([
                        'type' => 'error',
                        'mensagem' => 'E-mail inválido'
                    ]);
                    return;
                }

                $empresa = new Empresa();
                $empresa->CNPJ = $CNPJ;
                $empresa->razaoSocial = $razaoSocial;
                $empresa->fone = $fone;
                $empresa->id_cidade = $cidade;
                $empresa->uf = $uf;
                $empresa->email = $email;

                if ($empresa->save()) {
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
            $empresaId = 0;
            echo $this->view->render('registerempresas', compact('ufs', 'empresaId'));
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
                    $CNPJ = $data['CNPJ'];
                    $razaoSocial = $data['razaoSocial'];
                    $fone  = $data['fone'];
                    $uf = $data['uf'];
                    $cidade = $data['cidade'];
                    $email = $data['email'];

                    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        echo $this->ajaxResponse([
                            'type' => 'error',
                            'mensagem' => 'E-mail inválido'
                        ]);
                        return;
                    }

                    $empresa = (new Empresa())->findById($id);
                    $empresa->CNPJ = $CNPJ;
                    $empresa->razaoSocial = $razaoSocial;
                    $empresa->fone = $fone;
                    $empresa->id_cidade = $cidade;
                    $empresa->uf = $uf;
                    $empresa->email = $email;
                    if ($empresa->save()) {
                        echo $this->ajaxResponse([
                            'type' => 'success',
                            'redirect' => $this->router->route('web.home')
                        ]);
                        return;
                    }
                    return;
                }
                $empresaId = $data['id'];
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
                echo $this->view->render('registerempresas', compact('empresaId', 'ufs'));
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
                $users = $connect->query("SELECT * FROM empresas WHERE id={$id}")->fetchAll();
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
                $user = (new Empresa())->findById($id);
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
