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

            <h2>Entidade CADASTROS</h2>
            End point: usuarios_ws.php
            <table border="">
                <tbody>
                    <tr>
                        <td>Campo</td>
                        <td>tipo</td>
                        <td>Tamanho</td>
                        <td>Obs</td>
                    </tr>
                    <tr>
                        <td>cd_nome</td>
                        <td>Int</td>
                        <td>-</td>
                        <td>Chave primaria</td>
                    </tr>
                    <tr>
                        <td>ds_nome</td>
                        <td>string</td>
                        <td>50</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>ds_email</td>
                        <td>string</td>
                        <td>100</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>ds_cpf</td>
                        <td>string</td>
                        <td>15</td>
                        <td>Chave estarngeira</td>
                    </tr>
                </tbody>
            </table>
            <br>

            <h2>Entidade Produtos</h2>
            End point: produtos_ws.php
            <table border="">
                <tbody>
                    <tr>
                        <td>Campo</td>
                        <td>tipo</td>
                        <td>Tamanho</td>
                        <td>Obs</td>
                    </tr>
                    <tr>
                        <td>cd_produto</td>
                        <td>Int</td>
                        <td>-</td>
                        <td>Chave primaria</td>
                    </tr>
                    <tr>
                        <td>ds_produto</td>
                        <td>string</td>
                        <td>50</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>ds_unidade</td>
                        <td>string</td>
                        <td>100</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>vl_unitario</td>
                        <td>string</td>
                        <td>15</td>
                        <td>Chave estarngeira</td>
                    </tr>
                </tbody>
            </table>


        </ol>
    </div>
</body>

</html>