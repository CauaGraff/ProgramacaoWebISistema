<?php

namespace Source\Controllers;

use CoffeeCode\Router\Router;
use Source\Models\UnidadeMedida;
use CoffeeCode\DataLayer\Connect;
use Source\Controllers\Controller;
use Source\Models\Orcamento as ModelsOrcamento;
use Source\Models\Produto as ModelsProduto;

class Orcamento extends Controller
{
    public function __construct(Router $router)
    {
        parent::__construct($router);
    }

    public function index()
    {
        if (Auth::verify('usuario_id')) {
            /** GET PDO instance AND errors*/
            $connect = Connect::getInstance();
            $error = Connect::getError();

            /** CHECK connection/errors */
            if ($error) {
                echo $error->getMessage();
                exit;
            }

            /** FETCH DATA*/
            $orcamentos = $connect->query("SELECT o.*, u.nome as nomeUsuario, c.nome as nomeCliente FROM orcamentos o INNER JOIN usuarios u on o.usuario_id = u.id INNER JOIN clientes c on o.cliente_id = c.id")->fetchAll();
            echo $this->view->render('listaorcamento', compact('orcamentos'));
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
                $id_uni = $dados['id_uni'];

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
                    $nome = $data['nome'];
                    $qtd = $data['qtd'];
                    $preco = $data['preco'];
                    $descricao = $data['descricao'];
                    $id_empresa = $data['id_empresa'];
                    $id_uni = $data['id_uni'];

                    $produto = (new ModelsProduto())->findById($id);;
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
                $produtoId = $data['id'];

                $unis = (new UnidadeMedida())->find()->fetch(true);
                $fornec = (new Empresa())->find()->fetch(true);
                echo $this->view->render('registerprodutos', compact('produtoId', 'unis', 'fornec'));
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
                $produto = (new ModelsProduto())->findById($id)->data();
                echo $this->ajaxResponse([
                    "data" => $produto,
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
                $user = (new ModelsProduto())->findById($id);
                if ($user->destroy()) {
                    echo $this->ajaxResponse([
                        'type' => 'success',
                        'redirect' => $this->router->route('produto.index')
                    ]);
                    return;
                }
            }
        }
        $this->router->redirect('web.login');
        return;
    }
}
