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
    private $idWsUsuario = 5;
    public function __construct(Router $router)
    {
        parent::__construct($router);
    }

    public function index()
    {
    }

    public function clientes()
    {
        $json = file_get_contents(IP_RICARDO . "/teste/usuarios_ws.php?cdu=2&pwd=Cauan");    // Check in your php.ini so allow_url_fopen is set to on.
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
                $idClientes = $connect->query("SELECT id FROM clientes WHERE email = '$dados->ds_email'")->fetch();
                if ($idClientes) {
                    $cliente = (new Clientes())->findById($idClientes->id);
                    if ($cliente) {
                        $cliente->nome = $dados->ds_usuario;
                        $cliente->dataNasc = $dados->dt_nascimento;
                        $cliente->ncasa = 0;
                        $cliente->cidade_id = 1874;
                        $cliente->uf = "SC";
                        $cliente->email = $dados->ds_email;
                        $cliente->fone = "sem telefone";
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
                        $cliente->fone = "sem telefone";
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
}
