<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WS Cauã</title>
    <style>
        body {
            margin: 0 20%;
        }

        .titulo {
            text-align: center;
        }

        p {
            text-align: justify;
            text-indent: 1cm;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>
    <div>
        <h1 class="titulo">Documentação WS</h1>
        <table border="">
            <thead>
                <tr>
                    <th colspan="3">Histórico de Alterações </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Dia</th>
                    <th>Acao</th>
                    <th>Usuário</th>
                </tr>
                <tr>
                    <td>13/09/23 20:25</td>
                    <td>Criação da versão 1</td>
                    <td>Cauã</td>
                </tr>
            </tbody>
        </table>
        <ol>
            <h1>
                <li>
                    Introdução
                </li>
            </h1>
            <p>Este documento tem como objetivo especificar o serviço de integração para o sistema <b>RP</b>.Nas seções subsequentes serão apresentadas as operações disponíveis junto aos seus respectivos parâmetros de entrada e de saída.</p>
            <h1>
                <li>
                    Definições e Permissões
                </li>
            </h1>

            <p>Para acessar as entidades, sempre usar o id e o pwd de cadastro.</p>



            <p>http://192.168.0.103/ProgramacaoWebISistema/json/{entidade}?id=1&pwd=Max</p>

            <h2>Entidade CLIENTES</h2>
            End point: <a href="<?= $router->route("wds.clientes") ?>"> /clientes</a>
            <table border="">
                <thead>
                    <tr>
                        <th>Campo</th>
                        <th>tipo</th>
                        <th>Tamanho</th>
                        <th>Obs</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>id</td>
                        <td>Int</td>
                        <td>-</td>
                        <td>Chave primaria</td>
                    </tr>
                    <tr>
                        <td>nome</td>
                        <td>string</td>
                        <td>40</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>dataNasc</td>
                        <td>date</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>cpf</td>
                        <td>char</td>
                        <td>15</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>email</td>
                        <td>string</td>
                        <td>40</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>fone</td>
                        <td>string</td>
                        <td>40</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>uf</td>
                        <td>char</td>
                        <td>2</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>cidadeId</td>
                        <td>int</td>
                        <td>-</td>
                        <td>Chave estarngeira</td>
                    </tr>
                    <tr>
                        <td>nCasa</td>
                        <td>int</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                </tbody>
            </table>

            <h2>Entidade EMPRESAS</h2>
            End point: <a href="<?= $router->route("wds.empresas") ?>"> /empresas</a>
            <table border="">
                <thead>
                    <tr>
                        <th>Campo</th>
                        <th>tipo</th>
                        <th>Tamanho</th>
                        <th>Obs</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>id</td>
                        <td>Int</td>
                        <td>-</td>
                        <td>Chave primaria</td>
                    </tr>
                    <tr>
                        <td>CNPJ</td>
                        <td>string</td>
                        <td>18</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>razaoSocial</td>
                        <td>string</td>
                        <td>40</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>email</td>
                        <td>string</td>
                        <td>40</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>fone</td>
                        <td>string</td>
                        <td>40</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>uf</td>
                        <td>string</td>
                        <td>2</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>cidadeId</td>
                        <td>int</td>
                        <td>-</td>
                        <td>Chave estarngeira</td>
                    </tr>
                </tbody>
            </table>
            <h2>Entidade PRODUTOS</h2>
            End point: <a href="<?= $router->route("wds.produtos") ?>"> /produtos</a>
            <table border="">
                <thead>
                    <tr>
                        <th>Campo</th>
                        <th>tipo</th>
                        <th>Tamanho</th>
                        <th>Obs</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>id</td>
                        <td>Int</td>
                        <td>-</td>
                        <td>Chave primaria</td>
                    </tr>
                    <tr>
                        <td>nome</td>
                        <td>string</td>
                        <td>40</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>qtd</td>
                        <td>int</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>preco</td>
                        <td>float</td>
                        <td>18.2</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>descricao</td>
                        <td>text</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>empresaId</td>
                        <td>int</td>
                        <td>-</td>
                        <td>Chave estrangeira</td>
                    </tr>
                    <tr>
                        <td>unidadeId</td>
                        <td>int</td>
                        <td>-</td>
                        <td>Chave estarngeira</td>
                    </tr>
                </tbody>
            </table>

            <h2>Entidade UNIDADES DE MEDIDA</h2>
            End point: <a href="<?= $router->route("wds.unidadesmedida") ?>"> /unidadesMedida</a>
            <table border="">
                <thead>
                    <tr>
                        <th>Campo</th>
                        <th>tipo</th>
                        <th>Tamanho</th>
                        <th>Obs</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>id</td>
                        <td>Int</td>
                        <td>-</td>
                        <td>Chave primaria</td>
                    </tr>
                    <tr>
                        <td>nome</td>
                        <td>string</td>
                        <td>40</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>simbolo</td>
                        <td>string</td>
                        <td>10</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>descricao</td>
                        <td>string</td>
                        <td>40</td>
                        <td>-</td>
                    </tr>
                </tbody>
            </table>
        </ol>
    </div>
</body>

</html>