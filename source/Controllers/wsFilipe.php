<?php

namespace Source\Controllers;

use DateTime;
use DateTimeZone;
use Source\Models\LogsWS;
use Source\Models\Cidades;
use Source\Models\Empresa;
use Source\Models\Produto;
use Source\Models\Clientes;
use Source\Models\UsuarioWS;
use CoffeeCode\Router\Router;
use Source\Models\UnidadeMedida;
use CoffeeCode\DataLayer\Connect;
use Source\Controllers\Controller;

class wsFilipe extends Controller
{
    private $idWsUsuario = 6;
    public function __construct(Router $router)
    {
        parent::__construct($router);
    }

    public function index()
    {
    }


    public function clientes()
    {
        $json = file_get_contents(IP_FILIPE . "/webservice-max/ws/cadastre.get-clients");    // Check in your php.ini so allow_url_fopen is set to on.
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
                $idClientes = $connect->query("SELECT id FROM clientes WHERE email = '$dados->email'")->fetch();
                if ($idClientes) {
                    $cliente = (new Clientes())->findById($idClientes->id);
                    if ($cliente) {
                        $cliente->nome = $dados->name;
                        $cliente->dataNasc = "2004-02-13";
                        $cliente->ncasa = 0;
                        $cliente->cidade_id = 1874;
                        $cliente->uf = "SC";
                        $cliente->email = $dados->email;
                        $cliente->fone = "(66) 98899-6765";
                        $cliente->save();
                        $upda++;
                    } else {
                        $cliente = new Clientes();
                        $cliente->nome = $dados->name;
                        $cliente->dataNasc = "2004-02-13";
                        $cliente->ncasa = 0;
                        $cliente->cidade_id = 1874;
                        $cliente->uf = "SC";
                        $cliente->email = $dados->email;
                        $cliente->fone = "(66) 98899-6765";
                        $cliente->save();
                        $upda++;
                    }
                }
            }
            $timeZone = new DateTimeZone("America/Sao_Paulo");
            $log = new LogsWS();
            $log->dataAcesso = (new DateTime("now", $timeZone))->format("Y-m-d H:m:s");
            $log->es = "E";
            $log->entidade = "Clientes";
            $log->origem = $this->idWsUsuario;
            $log->registros = ($inse + $upda);
            $log->atualizados = $inse;
            $log->inseridos = $upda;
            $log->save();
        } else {
            echo "Json Vazio ou com Problema";
        }
    }

    public function produtos()
    {
        $json = file_get_contents(IP_FILIPE . "/webservice-max/ws/cadastre.get-products");    // Check in your php.ini so allow_url_fopen is set to on.
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

                $idProdutos = $connect->query("SELECT id FROM produto WHERE nome = '$dados->nome'")->fetch();
                if ($idProdutos) {
                    $produto = (new Produto())->findById($idProdutos->id);
                    if ($produto) {
                        $produto->nome = $dados->nome;
                        $produto->qtd = $dados->estoque;
                        $produto->preco = $dados->preco;
                        $produto->descricao = $dados->descricao;
                        $produto->id_empresa = 2;
                        $produto->id_uni = 1;
                        $produto->save();
                        var_dump($produto);
                        $upda++;
                    } else {
                        $produto = new Produto();
                        $produto->nome = $dados->nome;
                        $produto->qtd = $dados->estoque;
                        $produto->preco = $dados->preco;
                        $produto->descricao = $dados->descricao;
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
}
