<?php

namespace Source\Controllers;

use Source\Models\Cidades;
use Source\Models\Empresa;
use Source\Models\Produto;
use Source\Models\Clientes;
use CoffeeCode\Router\Router;
use Source\Models\UnidadeMedida;
use CoffeeCode\DataLayer\Connect;
use Source\Controllers\Controller;
use Source\Models\UsuarioWS;

class wsWesley extends Controller
{
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
                $produto = new Produto();
                $produto->nome = $dados->ds_prod;
                $produto->qtd = $dados->estoque;
                $produto->preco = $dados->precovenda;
                $produto->descricao = ".";
                $produto->id_empresa = 2;
                $produto->id_uni = 1;
                $produto->save();
            }
            // $SQL = "insert into ws_log (dt_wsl,ds_entidade,ds_origem,ds_es,nr_registros,nr_update,nr_insert) values (now(),'Cadastros','Cauan','E'," . ($inse + $upda) . ",$upda,$inse)";
            // $cone->query($SQL);
        } else {
            echo "Json Vazio ou com Problema";
        }
    }
}
