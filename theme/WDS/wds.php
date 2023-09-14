<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WS Cauã</title>
</head>

<body>
    <table border="">
        <tbody>
            <tr>
                <td>Dia</td>
                <td>Acao</td>
                <td>Usuário</td>
            </tr>
            <tr>
                <td>13/09/23 20:25</td>
                <td>Criação da versão 1</td>
                <td>Max</td>
            </tr>
        </tbody>
    </table>


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
    <br>



</body>

</html>