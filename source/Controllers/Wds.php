<?php

namespace Source\Controllers;

use Source\Models\Clientes;
use CoffeeCode\Router\Router;
use Source\Models\Empresa;
use Source\Controllers\Controller;
use Source\Models\Cidades;
use Source\Models\Produto;
use Source\Models\UnidadeMedida;

class Wds extends Controller
{
    public function __construct(Router $router)
    {
        parent::__construct($router);
    }

    public function index()
    {
        echo $this->view->render('WDS/wds');
    }

    public function clientes()
    {
        $id = $_REQUEST["id"] == null ? $_REQUEST["id"] : null;
        $psw = $_REQUEST["psw"] == null ? $_REQUEST["psw"] : null;
        $dados = compact("id", "psw");
        if ((intval($id) > 1) || (strlen($psw) > 2)) {
            if (Auth::attemptUserWs($dados)) {
                $linhas = [];
                $clientes = (new Clientes())->find()->fetch(true);;
                foreach ($clientes as $cliente) {
                    $id = $cliente->id;
                    $nome = $cliente->nome;
                    $dataNasc = $cliente->dataNasc;
                    $cpf = $cliente->CPF;
                    $email = $cliente->email;
                    $fone = $cliente->fone;
                    $uf = $cliente->uf;
                    $cidade_id = $cliente->cidade_id;
                    $nCasa = $cliente->ncasa;
                    $linhas[] = ['id' => $id, 'nome' => $nome, 'dataNasc' => $dataNasc, 'cpf' => $cpf, 'email' => $email, 'fone' => $fone, 'uf' => $uf, 'cidadeId' => $cidade_id, 'nCasa' => $nCasa];
                }
                $json_string = json_encode($linhas);
                echo $json_string;
                return;
            }
            echo " Usuario / Senha ERRADO";
            exit();
        }
        echo "Usuario / Senha invalido";
        exit();
    }

    public function empresas()
    {
        $id = $_REQUEST["id"];
        $psw = $_REQUEST["psw"];
        $dados = compact("id", "psw");
        if ((intval($id) > 1) || (strlen($psw) > 2)) {
            if (Auth::attemptUserWs($dados)) {
                $linhas = [];
                $empresas = (new Empresa())->find()->fetch(true);;
                foreach ($empresas as $empresa) {
                    $id = $empresa->id;
                    $CNPJ = $empresa->CNPJ;
                    $razaoSocial = $empresa->razaoSocial;
                    $email = $empresa->email;
                    $fone = $empresa->fone;
                    $uf = $empresa->uf;
                    $cidade_id = $empresa->id_cidade;
                    $linhas[] = ['id' => $id, 'CNPJ' => $CNPJ, 'razaoSocial' => $razaoSocial, 'email' => $email, 'fone' => $fone, 'uf' => $uf, 'cidadeId' => $cidade_id];
                }
                $json_string = json_encode($linhas);
                echo $json_string;
                return;
            }
            echo " Usuario / Senha ERRADO";
            exit();
        }
        echo "Usuario / Senha invalido";
        exit();
    }
    public function produtos()
    {
        $id = $_REQUEST["id"];
        $psw = $_REQUEST["psw"];
        $dados = compact("id", "psw");
        if ((intval($id) > 1) || (strlen($psw) > 2)) {
            if (Auth::attemptUserWs($dados)) {
                $linhas = [];
                $produtos = (new Produto())->find()->fetch(true);;
                foreach ($produtos as $produto) {
                    $id = $produto->id;
                    $nome = $produto->nome;
                    $qtd = $produto->qtd;
                    $preco = $produto->preco;
                    $descricao = $produto->descricao;
                    $empresaId = $produto->id_empresa;
                    $unidadeId = $produto->id_uni;
                    $linhas[] = ['id' => $id, 'nome$nome' => $nome, 'qtd' => $qtd, 'preco' => $preco, 'descricao' => $descricao, 'empresaId' => $empresaId, 'unidadeId' => $unidadeId];
                }
                $json_string = json_encode($linhas);
                echo $json_string;
                return;
            }
            echo " Usuario / Senha ERRADO";
            exit();
        }
        echo "Usuario / Senha invalido";
        exit();
    }
    public function unidadesMedida()
    {
        $id = $_REQUEST["id"];
        $psw = $_REQUEST["psw"];
        $dados = compact("id", "psw");
        if ((intval($id) > 1) || (strlen($psw) > 2)) {
            if (Auth::attemptUserWs($dados)) {
                $linhas = [];
                $unidades = (new UnidadeMedida())->find()->fetch(true);;
                foreach ($unidades as $unidade) {
                    $id = $unidade->id;
                    $nome = $unidade->nome;
                    $simbolo = $unidade->simbolo;
                    $descricao = $unidade->descricao;
                    $linhas[] = ['id' => $id, 'nome$nome' => $nome, 'simbolo' => $simbolo, 'descricao' => $descricao];
                }
                $json_string = json_encode($linhas);
                echo $json_string;
                return;
            }
            echo " Usuario / Senha ERRADO";
            exit();
        }
        echo "Usuario / Senha invalido";
        exit();
    }
    public function cidades()
    {
        $id = $_REQUEST["id"];
        $psw = $_REQUEST["psw"];
        $dados = compact("id", "psw");
        if ((intval($id) > 1) || (strlen($psw) > 2)) {
            if (Auth::attemptUserWs($dados)) {
                $linhas = [];
                $cidades = (new Cidades())->find()->fetch(true);
                foreach ($cidades as $cidade) {
                    $id = $cidade->ds_cidade;
                    $ibge = $cidade->cd_cidade_ibge;
                    $uf = $cidade->ds_uf;
                    $ufIbge = $cidade->cd_uf_ibge;
                    $latitude = $cidade->vl_latitude;
                    $longitude = $cidade->vl_longitude;
                    $linhas[] = ['id' => $id, 'ibge' => $ibge, 'uf' => $uf, 'ufIbge' => $ufIbge, 'latitude' => $latitude, 'longitude' => $longitude];
                }
                $json_string = json_encode($linhas);
                echo $json_string;
                return;
            }
            echo " Usuario / Senha ERRADO";
            exit();
        }
        echo "Usuario / Senha invalido";
        exit();
    }
}
