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

class wsNicolas extends Controller
{
    public function __construct(Router $router)
    {
        parent::__construct($router);
    }

    public function produto()
    {
        $json = file_get_contents(IP_NICOLAS . "/produto");    // Check in your php.ini so allow_url_fopen is set to on.
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
                $empresa = new Produto();
                $empresa->CNPJ = "99.141.406/0001-51";
                $empresa->razaoSocial = $dados->ds_razao_social;
                $empresa->fone = "(34)12341-2341";
                $empresa->id_cidade = 1874;
                $empresa->uf = "ES";
                $empresa->email = "teste2222@gmail.com";
                $empresa->save();
                $inse++;
            }
            $timeZone = new DateTimeZone("America/Sao_Paulo");
            $log = new LogsWS();
            $log->dataAcesso = (new DateTime("now", $timeZone))->format("Y-m-d H:m:s");
            $log->es = "E";
            $log->entidade = "Produtos";
            $log->origem = 8;
            $log->registros = $inse;
            $log->atualizados = 0;
            $log->inseridos = $inse;
            $log->save();
        } else {
            echo "Json Vazio ou com Problema";
        }
    }
}