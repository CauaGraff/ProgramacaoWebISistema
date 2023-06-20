<?php

namespace Source\Controllers;

use CoffeeCode\Router\Router;
use CoffeeCode\DataLayer\Connect;
use Source\Controllers\Controller;
use Source\Models\Produto as ModelsProduto;

class Produto extends Controller
{
    public function __construct(Router $router)
    {
        parent::__construct($router);
    }

    public function index()
    {
        if (Auth::verify('usuario_id')) {

            $produtos = (new ModelsProduto())->find()->fetch(true);
            echo $this->view->render('listaprodutos', compact('produtos'));
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
                $qtd = $dados['qtd'];
                $preco = $dados['preco'];
                $descricao = $dados['descricao'];
                $id_empresa = $dados['id_empresa'];
                $id_uni = ['id_uni'];

                if (empty($nome)) {
                    $erro['nome'] = "Preencha o nome do produto";
                }

                if (empty($qtd) || $qtd < 0) {
                    $erro['qtd'] = "Preencha a quantidade";
                }

                if (empty($preco)) {
                    $erro['preco'] = "Preencha preco";
                }

                if (empty($descricao)) {
                    $erro['descricao'] = "Preencha a Descricao";
                }

                if (empty($id_empresa)) {
                    $erro['id_empresa'] = "Selecione um Fornecedor";
                }
                if (empty($id_uni)) {
                    $erro['id_uni'] = "Selecione uma unidade de medida";
                }

                if (!empty($erro)) {
                    echo $this->ajaxResponse($erro);
                    return;
                }
               
                $produto = new ModelsProduto();
                $produto->nome = $nome;
                $produto->qtd = $qtd;
                $produto->preco = $preco;
                $produto->descricao = $descricao;
                $produto->id_empresa = $id_empresa;
                $produto->id_uni = $id_uni;

                if ($produto->save()) {
                    echo $this->ajaxResponse([
                        'type' => 'success',
                        'redirect' => $this->router->route('produto.index')
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
            $unis = $connect->query("SELECT * FROM unidademedida")->fetchAll();
            $fornec = $connect->query("SELECT * FROM empresas")->fetchAll();
            $produtoId = 0;
            echo $this->view->render('registerprodutos', compact('unis', "produtoId", "fornec"));
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
