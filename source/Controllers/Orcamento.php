<?php

namespace Source\Controllers;

use CoffeeCode\Router\Router;
use Source\Facades\Orcamento as FacadesOrcamento;
use Source\Models\UnidadeMedida;
use CoffeeCode\DataLayer\Connect;
use Source\Controllers\Controller;
use Source\Models\Produto as ModelsProduto;


class Orcamento extends Controller
{
    private $orcamentos;

    public function __construct(Router $router)
    {
        parent::__construct($router);
        $this->orcamentos = new FacadesOrcamento();
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

        $this->orcamentos->add($product);
        echo json_encode($this->orcamentos->orcamentos());
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

        $this->orcamentos->remove($product);
        echo json_encode($this->orcamentos->orcamentos());
    }
    public function clear(): void
    {
        $this->orcamentos->clear();
        echo json_encode($this->orcamentos->orcamentos());
    }
}
