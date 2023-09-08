<?php

namespace Source\Controllers;

use CoffeeCode\Router\Router;
use Source\Models\UnidadeMedida;
use CoffeeCode\DataLayer\Connect;
use Source\Controllers\Controller;
use Source\Models\Orcamento as ModelsOrcamento;
use Source\Models\Produto as ModelsProduto;
use Source\Facades\Cart;

class Orcamento extends Controller
{
    private $cart;

    public function __construct(Router $router)
    {
        parent::__construct($router);
        $this->cart = new Cart();
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
            $orcamentos = $connect->query("SELECT o.*, u.nome as nomeUsuario, c.nome as nomeCliente FROM orcamentos o INNER JOIN usuarios u on o.usuarioId = u.id INNER JOIN clientes c on o.clienteId = c.id")->fetchAll();
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
            $produtos = (new ModelsProduto())->find()->fetch(true);
            echo $this->view->render('registerorcamento', compact("produtos"));
            return;
        }

        $this->router->redirect('web.login');
        return;
    }

    public function add(array $data): void
    {
        $id = filter_var($data["id"], FILTER_VALIDATE_INT);
        $product = (new ModelsProduto())->findById($id);
        if (!$id || !$product) {
            echo $this->ajaxResponse([
                "type" => "error",
                "mensage" => "Erro ao adicinar produto"
            ]);
            return;
        }

        $this->cart->add($product);
        echo json_encode($this->cart->cart());
    }

    public function remove(array $data): void
    {
        $id = filter_var($data["id"], FILTER_VALIDATE_INT);
        $product = (new ModelsProduto())->findById($id);
        if (!$id || !$product) {
            echo $this->ajaxResponse([
                "type" => "error",
                "mensage" => "Erro ao remover produto"
            ]);
            return;
        }

        $this->cart->remove($product);
        echo json_encode($this->cart->cart());
    }
    public function clear(): void
    {
        $this->cart->clear();
        echo json_encode($this->cart->cart());
    }
}
