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

class wsCaua extends Controller
{
    private $idWsUsuario = 2;
    public function __construct(Router $router)
    {
        parent::__construct($router);
    }

    public function index()
    {
    }

    public function clientes()
    {
        $json = file_get_contents(CONF_SITE_URL . "/json/clientes?id=2&pwd=Cauan");    // Check in your php.ini so allow_url_fopen is set to on.
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
                $idCliente = $connect->query("SELECT id FROM clientes WHERE cpf = '$dados->cpf'")->fetch();
                if ($idCliente) {
                    $cliente = (new Clientes())->findById($idCliente->id);
                    if ($cliente) {
                        $cliente->nome = $dados->nome;
                        $cliente->CPF = $dados->cpf;
                        $cliente->dataNasc = $dados->dataNasc;
                        $cliente->ncasa = $dados->nCasa;
                        $cliente->cidade_id = $dados->cidadeId;
                        $cliente->uf = $dados->uf;
                        $cliente->email = $dados->email;
                        $cliente->fone = $dados->fone;
                        $cliente->save();
                        $upda++;
                    } else {
                        $cliente = new Clientes();
                        $cliente->nome = $dados->nome;
                        $cliente->CPF = $dados->cpf;
                        $cliente->dataNasc = $dados->dataNasc;
                        $cliente->ncasa = $dados->ncasa;
                        $cliente->cidade_id = $dados->cidade;
                        $cliente->uf = $dados->uf;
                        $cliente->email = $dados->email;
                        $cliente->fone = $dados->fone;
                        $cliente->save();
                        $inse++;
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
            $log->atualizados = $upda;
            $log->inseridos = $inse;
            $log->save();
        } else {
            echo "Json Vazio ou com Problema";
        }
    }
}
