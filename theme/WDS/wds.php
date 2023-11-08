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
                <tr>
                    <th>Dia</th>
                    <th>Acao</th>
                    <th>Usuário</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>13/09/23 20:25</td>
                    <td>Criação da versão 1</td>
                    <td>Cauã</td>
                </tr>
                <tr>
                    <td>01/11/23 20:25</td>
                    <td>Inserir dados</td>
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
            <p><b>URL:</b></p>
            <p><?= CONF_SITE_URL ?>/json/{entidade}?id=1&pwd=Max</p>
            <table>
                <thead>
                    <tr>
                        <th colspan="2">Logins de acesso</th>
                    </tr>
                    <tr>
                        <th>id</th>
                        <th>pwd</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($userWs as $user) : ?>
                        <tr>
                            <td><?= $user->id ?></td>
                            <td><?= $user->psw ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h2>Entidade CLIENTES - OK</h2>
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
                        <td>varchar</td>
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
                        <td>varchar</td>
                        <td>40</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>fone</td>
                        <td>varchar</td>
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

            <h2>Entidade EMPRESAS - OK</h2>
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
                        <td>varchar</td>
                        <td>18</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>razaoSocial</td>
                        <td>varchar</td>
                        <td>40</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>email</td>
                        <td>varchar</td>
                        <td>40</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>fone</td>
                        <td>varchar</td>
                        <td>40</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>uf</td>
                        <td>varchar</td>
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
            <h2>Entidade PRODUTOS - OK</h2>
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
                        <td>varchar</td>
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

            <h2>Entidade UNIDADES DE MEDIDA - OK</h2>
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
                        <td>varchar</td>
                        <td>40</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>simbolo</td>
                        <td>varchar</td>
                        <td>10</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>descricao</td>
                        <td>varchar</td>
                        <td>40</td>
                        <td>-</td>
                    </tr>
                </tbody>
            </table>
            <h1>
                <li>
                    Inserir dados
                </li>
            </h1>
            <p>Este endpoint permite aos usuários inserir dados no sistema.</p>
            <p><b>URL:</b></p>
            <p><?= CONF_SITE_URL ?>/json/inserir?id=1&pwd=Max&entidade=nomeDaEntiadade</p>
            <p>Nas entidades disponiveis a baixo estão listados os parametros obrigatoros para cada entidade para fazer a inserção de dados.</p>
            <h2>Entidade PRODUTOS - OK</h2>
            End point: <a href="<?= $router->route("wds.insere") ?>">/inserir?entidade=produtos</a>
            <table border="">
                <thead>
                    <tr>
                        <th>Parametros</th>
                        <th>tipo</th>
                        <th>Tamanho</th>
                        <th>Obs</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>nome</td>
                        <td>varchar</td>
                        <td>40</td>
                        <td>obrigatório</td>
                    </tr>
                    <tr>
                        <td>qtd</td>
                        <td>int</td>
                        <td>-</td>
                        <td>obrigatório</td>
                    </tr>
                    <tr>
                        <td>preco</td>
                        <td>float</td>
                        <td>18.2</td>
                        <td>obrigatório</td>
                    </tr>
                    <tr>
                        <td>descricao</td>
                        <td>text</td>
                        <td>-</td>
                        <td>obrigatório</td>
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
            <h2>Entidade CLIENTES - OK</h2>
            End point: <a href="<?= $router->route("wds.insere") ?>">/inserir?entidade=clientes</a>
            <table border="">
                <thead>
                    <tr>
                        <th>Parametros</th>
                        <th>tipo</th>
                        <th>Tamanho</th>
                        <th>Obs</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>nome</td>
                        <td>varchar</td>
                        <td>40</td>
                        <td>obrigatório</td>
                    </tr>
                    <tr>
                        <td>dataNasc</td>
                        <td>date</td>
                        <td>-</td>
                        <td>obrigatório</td>
                    </tr>
                    <tr>
                        <td>cpf</td>
                        <td>char</td>
                        <td>15</td>
                        <td>obrigatório</td>
                    </tr>
                    <tr>
                        <td>email</td>
                        <td>varchar</td>
                        <td>40</td>
                        <td>obrigatório</td>
                    </tr>
                    <tr>
                        <td>fone</td>
                        <td>varchar</td>
                        <td>40</td>
                        <td>obrigatório</td>
                    </tr>
                    <tr>
                        <td>nCasa</td>
                        <td>int</td>
                        <td>-</td>
                        <td>obrigatório</td>
                    </tr>
                </tbody>
            </table>
            <h2>Entidade EMPRESAS - OK</h2>
            End point: <a href="<?= $router->route("wds.insere") ?>">/inserir?entidade=empresas</a>
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
                        <td>cnpj</td>
                        <td>varchar</td>
                        <td>18</td>
                        <td>obrigatório</td>
                    </tr>
                    <tr>
                        <td>razaoSocial</td>
                        <td>varchar</td>
                        <td>40</td>
                        <td>obrigatório</td>
                    </tr>
                    <tr>
                        <td>email</td>
                        <td>varchar</td>
                        <td>40</td>
                        <td>obrigatório</td>
                    </tr>
                    <tr>
                        <td>fone</td>
                        <td>varchar</td>
                        <td>40</td>
                        <td>obrigatório</td>
                    </tr>
                </tbody>
            </table>
        </ol>
    </div>
</body>

</html>