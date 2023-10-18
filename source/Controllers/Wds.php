<?php

namespace Source\Controllers;

use DateTime;
use Source\Models\LogsWS;
use Source\Models\Cidades;
use Source\Models\Empresa;
use Source\Models\Produto;
use Source\Models\Clientes;
use Source\Models\UsuarioWS;
use CoffeeCode\Router\Router;
use Source\Models\UnidadeMedida;
use Source\Controllers\Controller;

class Wds extends Controller
{
    public function __construct(Router $router)
    {
        parent::__construct($router);
    }

    public function index()
    {
        $userWs = (new UsuarioWS())->find()->fetch(true);
        echo $this->view->render("WDS/wds", compact("userWs"));
    }

    public function clientes()
    {
        if (!empty($_REQUEST["id"]) || !empty($_REQUEST["pwd"])) {
            $id = $_REQUEST["id"];
            $pwd = $_REQUEST["pwd"];
            $dados = compact("id", "pwd");
            if ((intval($id) > 1) || (strlen($pwd) > 2)) {
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
                        $linhas[] = ["id" => $id, "nome" => $nome, "dataNasc" => $dataNasc, "cpf" => $cpf, "email" => $email, "fone" => $fone, "uf" => $uf, "cidadeId" => $cidade_id, "nCasa" => $nCasa];
                    }
                    $log = new LogsWS();
                    $log->dataAcesso = (new DateTime())->format("Y-m-d H:m:s");
                    $log->es = "S";
                    $log->entidade = "Clientes";
                    $log->origem = $id;
                    $log->registros = count($linhas);
                    $log->atualizados = 0;
                    $log->inseridos = 0;
                    $log->save();
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
        echo "passe os parametros ?id=x&pwd=x";
        exit();
    }

    public function empresas()
    {
        if (!empty($_REQUEST["id"]) || !empty($_REQUEST["pwd"])) {
            $id = $_REQUEST["id"];
            $pwd = $_REQUEST["pwd"];
            $dados = compact("id", "pwd");
            if ((intval($id) > 1) || (strlen($pwd) > 2)) {
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
                        $linhas[] = ["id" => $id, "CNPJ" => $CNPJ, "razaoSocial" => $razaoSocial, "email" => $email, "fone" => $fone, "uf" => $uf, "cidadeId" => $cidade_id];
                    }
                    $log = new LogsWS();
                    $log->dataAcesso = (new DateTime())->format("Y-m-d H:m:s");
                    $log->es = "S";
                    $log->entidade = "Empresas";
                    $log->origem = $id;
                    $log->registros = count($linhas);
                    $log->atualizados = 0;
                    $log->inseridos = 0;
                    $log->save();
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
        echo "passe os parametros ?id=x&pwd=x";
        exit();
    }
    public function produtos()
    {
        if (!empty($_REQUEST["id"]) || !empty($_REQUEST["pwd"])) {
            $id = $_REQUEST["id"];
            $pwd = $_REQUEST["pwd"];
            $dados = compact("id", "pwd");
            if ((intval($id) > 1) || (strlen($pwd) > 2)) {
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
                        $linhas[] = ["id" => $id, "nome" => $nome, "qtd" => $qtd, "preco" => $preco, "descricao" => $descricao, "empresaId" => $empresaId, "unidadeId" => $unidadeId];
                    }
                    $log = new LogsWS();
                    $log->dataAcesso = (new DateTime())->format("Y-m-d H:m:s");
                    $log->es = "S";
                    $log->entidade = "Produtos";
                    $log->origem = $id;
                    $log->registros = count($linhas);
                    $log->atualizados = 0;
                    $log->inseridos = 0;
                    $log->save();
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
        echo "passe os parametros ?id=x&pwd=x";
        exit();
    }
    public function unidadesMedida()
    {
        if (!empty($_REQUEST["id"]) || !empty($_REQUEST["pwd"])) {
            $id = $_REQUEST["id"];
            $pwd = $_REQUEST["pwd"];
            $dados = compact("id", "pwd");
            if ((intval($id) > 1) || (strlen($pwd) > 2)) {
                if (Auth::attemptUserWs($dados)) {
                    $linhas = [];
                    $unidades = (new UnidadeMedida())->find()->fetch(true);;
                    foreach ($unidades as $unidade) {
                        $id = $unidade->id;
                        $nome = $unidade->nome;
                        $simbolo = $unidade->simbolo;
                        $descricao = $unidade->descricao;
                        $linhas[] = ["id" => $id, "nome$nome" => $nome, "simbolo" => $simbolo, "descricao" => $descricao];
                    }
                    $log = new LogsWS();
                    $log->dataAcesso = (new DateTime())->format("Y-m-d H:m:s");
                    $log->es = "S";
                    $log->entidade = "UnidadeMedida";
                    $log->origem = $id;
                    $log->registros = count($linhas);
                    $log->atualizados = 0;
                    $log->inseridos = 0;
                    $log->save();
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
        echo "passe os parametros ?id=x&pwd=x";
        exit();
    }
    public function cidades($dados)
    {
        if (!empty($_REQUEST["id"]) || !empty($_REQUEST["pwd"])) {

            $id = $_REQUEST["id"];
            $pwd = $_REQUEST["pwd"];
            $dados = compact("id", "pwd");
            if ((intval($id) > 1) || (strlen($pwd) > 2)) {
                if (Auth::attemptUserWs($dados)) {
                    $linhas = [];
                    $cidades = (new Cidades())->find()->fetch(true);
                    foreach ($cidades as $cidade) {
                        // var_dump($cidade->data());
                        $id = isset($cidade->cd_cidade) ? $cidade->cd_cidade : null;
                        $cidade = isset($cidade->ds_cidade) ? $cidade->ds_cidade : null;
                        $ibge = isset($cidade->cd_cidade_ibge) ? $cidade->cd_cidade_ibge : null;
                        $uf = isset($cidade->ds_uf) ? $cidade->cd_cidade_ibge : null;
                        $ufIbge = isset($cidade->cd_uf_ibge) ? $cidade->cd_uf_ibge : null;
                        $latitude = isset($cidade->vl_latitude) ? $cidade->vl_latitude : null;
                        $longitude = isset($cidade->vl_longitude) ? $cidade->vl_longitude : null;
                        $linhas[] = ["id" => $id, "cidade" => $cidade, "ibge" => $ibge, "uf" => $uf, "ufIbge" => $ufIbge, "latitude" => $latitude, "longitude" => $longitude];
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
        echo "passe os parametros ?id=x&pwd=x";
        exit();
    }
}
