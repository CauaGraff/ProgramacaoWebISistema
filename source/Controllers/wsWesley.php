<?php

namespace Source\Controllers;

use DateTime;
use DateTimeZone;
use Source\Models\LogsWS;
use Source\Models\Produto;
use Source\Models\Clientes;
use CoffeeCode\Router\Router;
use CoffeeCode\DataLayer\Connect;
use Source\Controllers\Controller;

class wsWesley extends Controller
{
    private $idWsUsuario = 4;
    public function __construct(Router $router)
    {
        parent::__construct($router);
    }

    public function index()
    {
    }

    public function produtos()
    {
        $json = file_get_contents(IP_WESLEY . "/Sistema/WS/produtos.php");    // Check in your php.ini so allow_url_fopen is set to on.
        $obj = json_decode($json);

        if (json_last_error() != 0) {
            echo 'OCORREU UM ERRO!</br>';
            switch (json_last_error()) {
                case JSON_ERROR_DEPTH:
                    echo ' - profundidade maxima excedida';
                    break;
                case JSON_ERROR_STATE_MISMATCH:
                    echo ' - Erro de sintaxe genérico';
                    break;
                case JSON_ERROR_CTRL_CHAR:
                    echo ' - Caracter de controle encontrado';
                    break;
                case JSON_ERROR_SYNTAX:
                    echo ' - Erro de sintaxe! String JSON mal-formatado!';
                    break;
                case JSON_ERROR_UTF8:
                    echo ' - Erro na codificação UTF-8';
                    break;
                default:
                    echo ' – Erro desconhecido';
                    break;
            }
        }

        if (count($obj) > 0) {
            $i = 0;
            $inse = 0;
            $upda = 0;
            foreach ($obj as $dados) {
                $connect = Connect::getInstance();
                $error = Connect::getError();
                if ($error) {
                    echo $error->getMessage();
                    exit;
                }

                $idProdutos = $connect->query("SELECT id FROM produto WHERE nome = '$dados->ds_prod'")->fetch();
                if ($idProdutos) {
                    $produto = (new Produto())->findById($idProdutos->id);
                    if ($produto) {
                        $produto->nome = $dados->ds_prod;
                        $produto->qtd = $dados->estoque;
                        $produto->preco = $dados->precovenda;
                        $produto->descricao = "sem descrição";
                        $produto->id_empresa = 2;
                        $produto->id_uni = 1;
                        $produto->save();
                        var_dump($produto);
                        $upda++;
                    } else {
                        $produto = new Produto();
                        $produto->nome = $dados->ds_prod;
                        $produto->qtd = $dados->estoque;
                        $produto->preco = $dados->precovenda;
                        $produto->descricao = "sem descrição";
                        $produto->id_empresa = 2;
                        $produto->id_uni = 1;
                        $produto->save();
                        $inse++;
                    }
                }
            }
            $timeZone = new DateTimeZone("America/Sao_Paulo");
            $log = new LogsWS();
            $log->dataAcesso = (new DateTime("now", $timeZone))->format("Y-m-d H:m:s");
            $log->es = "E";
            $log->entidade = "Produto";
            $log->origem = $this->idWsUsuario;
            $log->registros = ($inse + $upda);
            $log->atualizados = 0;
            $log->inseridos = $upda;
            $log->save();
        } else {
            echo "Json Vazio ou com Problema";
        }
    }

    public function clientes()
    {
        $json = file_get_contents(IP_WESLEY . "/Sistema/WS/produtos.php");    // Check in your php.ini so allow_url_fopen is set to on.
        $obj = json_decode($json);

        if (json_last_error() != 0) {
            echo 'OCORREU UM ERRO!</br>';
            switch (json_last_error()) {
                case JSON_ERROR_DEPTH:
                    echo ' - profundidade maxima excedida';
                    break;
                case JSON_ERROR_STATE_MISMATCH:
                    echo ' - Erro de sintaxe genérico';
                    break;
                case JSON_ERROR_CTRL_CHAR:
                    echo ' - Caracter de controle encontrado';
                    break;
                case JSON_ERROR_SYNTAX:
                    echo ' - Erro de sintaxe! String JSON mal-formatado!';
                    break;
                case JSON_ERROR_UTF8:
                    echo ' - Erro na codificação UTF-8';
                    break;
                default:
                    echo ' – Erro desconhecido';
                    break;
            }
        }

        if (count($obj) > 0) {
            $i = 0;
            $inse = 0;
            $upda = 0;
            foreach ($obj as $dados) {
                $connect = Connect::getInstance();
                $error = Connect::getError();
                if ($error) {
                    echo $error->getMessage();
                    exit;
                }
                $idClientes = $connect->query("SELECT id FROM clientes WHERE cpf = '$dados->ds_email'")->fetch();
                if ($idClientes) {
                    $cliente = (new Clientes())->findById($idClientes->id);
                    if ($cliente) {
                        $cliente->nome = $dados->ds_usuario;
                        $cliente->dataNasc = "0000-00-00";
                        $cliente->ncasa = 0;
                        $cliente->CPF = "116.757.079-01";
                        $cliente->cidade_id = 1874;
                        $cliente->uf = "SC";
                        $cliente->email = $dados->ds_email;
                        $cliente->fone = "(49)98803-6060";
                        $cliente->save();
                        $upda++;
                    } else {
                        $cliente = new Clientes();
                        $cliente->nome = $dados->ds_usuario;
                        $cliente->dataNasc = $dados->dt_nascimento;
                        $cliente->ncasa = 0;
                        $cliente->cidade_id = 1874;
                        $cliente->uf = "SC";
                        $cliente->email = $dados->ds_email;
                        $cliente->fone = $dados->ds_celular;
                        $cliente->save();
                        $upda++;
                    }
                }
            }
            $timeZone = new DateTimeZone("America/Sao_Paulo");
            $log = new LogsWS();
            $log->dataAcesso = (new DateTime("now", $timeZone))->format("Y-m-d H:m:s");
            $log->es = "E";
            $log->entidade = "Empresas";
            $log->origem = $this->idWsUsuario;
            $log->registros = ($inse + $upda);
            $log->atualizados = $inse;
            $log->inseridos = $upda;
            $log->save();
        } else {
            echo "Json Vazio ou com Problema";
        }
    }
}
