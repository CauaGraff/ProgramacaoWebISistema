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
use DateTimeZone;
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
                    $timeZone = new DateTimeZone("America/Sao_Paulo");
                    $log = new LogsWS();
                    $log->dataAcesso = (new DateTime("now", $timeZone))->format("Y-m-d H:m:s");
                    $log->es = "S";
                    $log->entidade = "Clientes";
                    $log->origem = $_REQUEST["id"];
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
                    $timeZone = new DateTimeZone("America/Sao_Paulo");
                    $log = new LogsWS();
                    $log->dataAcesso = (new DateTime("now", $timeZone))->format("Y-m-d H:m:s");
                    $log->es = "S";
                    $log->entidade = "Empresas";
                    $log->origem = $_REQUEST["id"];
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
                    $timeZone = new DateTimeZone("America/Sao_Paulo");
                    $log = new LogsWS();
                    $log->dataAcesso = (new DateTime("now", $timeZone))->format("Y-m-d H:m:s");
                    $log->es = "S";
                    $log->entidade = "Produtos";
                    $log->origem = $_REQUEST["id"];
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
                    $timeZone = new DateTimeZone("America/Sao_Paulo");
                    $log = new LogsWS();
                    $log->dataAcesso = (new DateTime("now", $timeZone))->format("Y-m-d H:m:s");
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

    public function insere()
    {
        if (!empty($_REQUEST["id"]) || !empty($_REQUEST["pwd"]) || !empty($_REQUEST["entidade"])) {
            $id = $_REQUEST["id"];
            $pwd = $_REQUEST["pwd"];
            $dados = compact("id", "pwd");
            if ((intval($id) > 1) || (strlen($pwd) > 2)) {
                if (Auth::attemptUserWs($dados)) {
                    $entidade = $_REQUEST["entidade"];
                    if ($entidade == "clientes" || $entidade == "empresas" || $entidade == "produtos" || $entidade == "unidadesMedida") {
                        if ($entidade == "clientes") {
                            $this->insereClientes();
                            return;
                        } else if ($entidade == "empresas") {
                            $this->insereEmpresas();
                            return;
                        } else if ($entidade == "produtos") {
                            echo $this->insereProdutos();
                            return;
                        }
                    }
                    $json_string = json_encode([
                        "type" => "erro",
                        "mensagem" => "Entidade {$entidade} não encontrada"
                    ]);
                    echo $json_string;
                    return;
                }
                $json_string = json_encode([
                    "type" => "erro",
                    "mensagem" => "acesso negado verefique o id e pwd"
                ]);
                echo $json_string;
                return;
            }
            $json_string = json_encode([
                "type" => "erro",
                "mensagem" => "acesso negado verefique o id e pwd"
            ]);
            echo $json_string;
            return;
        }
        $json_string = json_encode([
            "type" => "erro",
            "mensagem" => "passe os parametros ?id=1&pwd=Max&entidade=nomeDaEntiadade"
        ]);
        echo $json_string;
        return;
    }

    public function insereClientes()
    {
        $erro = [];
        if (!array_key_exists("nome", $_REQUEST)) {
            $erro[] = "nome";
        }
        if (!array_key_exists("dataNasc", $_REQUEST)) {
            $erro[] = "dataNasc";
        }
        if (!array_key_exists("cpf", $_REQUEST)) {
            $erro[] = "cpf";
        }
        if (!array_key_exists("email", $_REQUEST)) {
            $erro[] = "email";
        }
        if (!array_key_exists("fone", $_REQUEST)) {
            $erro[] = "fone";
        }
        if (!array_key_exists("nCasa", $_REQUEST)) {
            $erro[] = "nCasa";
        }
        if (!empty($erro)) {
            $json_string = json_encode([
                "type" => "erro",
                "mensagem" => "Parametros não encontrados",
                "parametros" => $erro
            ]);
            echo $json_string;
            return;
        }

        $cliente = new Clientes();
        $cliente->nome = $_REQUEST["nome"];
        $cliente->CPF = $_REQUEST["cpf"];
        $cliente->dataNasc = $_REQUEST["dataNasc"];
        $cliente->ncasa = $_REQUEST["nCasa"];
        $cliente->cidade_id = 1874;
        $cliente->uf = "SC";
        $cliente->email = $_REQUEST["email"];
        $cliente->fone = $_REQUEST["fone"];

        if ($cliente->save()) {
            $timeZone = new DateTimeZone("America/Sao_Paulo");
            $log = new LogsWS();
            $log->dataAcesso = (new DateTime("now", $timeZone))->format("Y-m-d H:m:s");
            $log->es = "E";
            $log->entidade = "Clientes";
            $log->origem = $_REQUEST["id"];
            $log->registros = 1;
            $log->atualizados = 0;
            $log->inseridos = 0;
            $log->save();
            $json_string = json_encode([
                "type" => "sucesso",
                "mensagem" => "cliente cadastrado com sucesso",
                "dados" => $cliente->data()
            ]);
            echo $json_string;
            return;
        }
        $json_string = json_encode([
            "type" => "erro",
            "mensagem" => "cliente não cadastrado",
            "dados" => $cliente->data()
        ]);
        echo $json_string;
        return;
    }
    public function insereEmpresas()
    {
        $erro = [];
        if (!array_key_exists("cnpj", $_REQUEST)) {
            $erro[] = "cnpj";
        }
        if (!array_key_exists("razaoSocial", $_REQUEST)) {
            $erro[] = "razaoSocial";
        }
        if (!array_key_exists("email", $_REQUEST)) {
            $erro[] = "email";
        }
        if (!array_key_exists("fone", $_REQUEST)) {
            $erro[] = "fone";
        }

        if (!empty($erro)) {
            $json_string = json_encode([
                "type" => "erro",
                "mensagem" => "Parametros não encontrados",
                "parametros" => $erro
            ]);
            echo $json_string;
            return;
        }
        $empresa = new Empresa();
        $empresa->CNPJ = $_REQUEST["cnpj"];
        $empresa->razaoSocial = $_REQUEST["razaoSocial"];
        $empresa->fone = $_REQUEST["fone"];
        $empresa->id_cidade = 1874;
        $empresa->uf = "SC";
        $empresa->email = $_REQUEST["email"];


        if ($empresa->save()) {
            $timeZone = new DateTimeZone("America/Sao_Paulo");
            $log = new LogsWS();
            $log->dataAcesso = (new DateTime("now", $timeZone))->format("Y-m-d H:m:s");
            $log->es = "E";
            $log->entidade = "Eempresas";
            $log->origem = $_REQUEST["id"];
            $log->registros = 1;
            $log->atualizados = 0;
            $log->inseridos = 0;
            $log->save();
            $json_string = json_encode([
                "type" => "sucesso",
                "mensagem" => "empresa cadastrado com sucesso",
                "dados" => $empresa->data()
            ]);
            echo $json_string;
            return;
        }
        $json_string = json_encode([
            "type" => "erro",
            "mensagem" => "empresa não cadastrado",
            "dados" => $empresa->data()
        ]);
        echo $json_string;
        return;
    }
    public function insereProdutos()
    {
        $erro = [];
        if (!array_key_exists("nome", $_REQUEST)) {
            $erro[] = "nome";
        }
        if (!array_key_exists("qtd", $_REQUEST)) {
            $erro[] = "qtd";
        }
        if (!array_key_exists("preco", $_REQUEST)) {
            $erro[] = "preco";
        }
        if (!array_key_exists("descricao", $_REQUEST)) {
            $erro[] = "descricao";
        }
        if (!array_key_exists("empresaId", $_REQUEST)) {
            $erro[] = "empresaId";
        }
        if (!array_key_exists("unidadeId", $_REQUEST)) {
            $erro[] = "unidadeId";
        }
        if (!empty($erro)) {
            $json_string = json_encode([
                "type" => "erro",
                "mensagem" => "Parametros não encontrados",
                "parametros" => $erro
            ]);
            echo $json_string;
            return;
        }
        $produto = new Produto();
        $produto->nome = $_REQUEST["nome"];
        $produto->qtd = $_REQUEST["qtd"];
        $produto->preco = $_REQUEST["preco"];
        $produto->descricao = $_REQUEST["descricao"];
        $produto->id_empresa = $_REQUEST["empresaId"];
        $produto->id_uni = $_REQUEST["unidadeId"];
        if ($produto->save()) {
            $timeZone = new DateTimeZone("America/Sao_Paulo");
            $log = new LogsWS();
            $log->dataAcesso = (new DateTime("now", $timeZone))->format("Y-m-d H:m:s");
            $log->es = "E";
            $log->entidade = "Produto";
            $log->origem = $_REQUEST["id"];
            $log->registros = 1;
            $log->atualizados = 0;
            $log->inseridos = 0;
            $log->save();
            $json_string = json_encode([
                "type" => "sucesso",
                "mensagem" => "Produto cadastrado com sucesso",
                "dados" => $produto->data()
            ]);
            echo $json_string;
            return;
        }
        $json_string = json_encode([
            "type" => "erro",
            "mensagem" => "Produto não cadastrado",
            "dados" => $produto->data()
        ]);
        echo $json_string;
        return;
    }
}
