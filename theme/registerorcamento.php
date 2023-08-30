<?php $v->layot("_theme"); ?>


<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <center>
        <h2>Orçamento Nº <?php echo $cd_orcamento; ?> </h2>
    </center>
    <div class="row g-5">
        <div class="col-md-12 col-lg-12">
            <form class="needs-validation" novalidate action="menu.php">
                <input type='hidden' name='cd_orcamento' id='cd_orcamento' value="<?php echo $cd_orcamento; ?>">
                <input type='hidden' name='acao' id='acao' value='salvar'>
                <input type='hidden' name='modulo' id='modulo' value='cadastro_orcamento'>
                <div class="row g-3">
                    <div class="col-sm-3">
                        <label for="firstName" class="form-label">Dia</label>
                        <input type="date" class="form-control" id="dt_orcamento" name="dt_orcamento" value="<?php echo $RS["dt_orcamento"]; ?>" readonly='true'>
                    </div>

                    <div class="col-sm-6">
                        <label for="lastName" class="form-label">Cliente</label>
                        <select name='cd_cliente_orcamento' id='cd_cliente_orcamento' class="form-control">
                            <?
                            $SQL = "select * from clientes order by ds_cliente";
                            $RRR = mysqli_query($conexao, $SQL) or print(mysqli_error());
                            while ($RR = mysqli_fetch_array($RRR)) {
                                echo "<option value='" . $RR["cd_cliente"] . "' ";
                                if ($RS["cd_cliente_orcamento"] == $RR["cd_cliente"]) {
                                    echo " SELECTED ";
                                }
                                echo ">" . $RR["ds_cliente"] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-3">
                        <label for="email" class="form-label">Valor</label>
                        <input type="number" class="form-control" id="vl_valor" name="vl_valor" value="<? echo $RS["vl_valor"]; ?>">
                    </div>

                </div>
                <hr class="my-4">

                <div class="row g-5">
                    <div class="col-6">
                        <button class="w-100 btn btn-primary btn-lg" type="submit">Salvar os dados</button>
                    </div>
                    <div class="col-3">
                        <button class="w-100 btn btn-primary btn-lg" type="button" onclick='window.open("menu.php?acao=excluir&modulo=cadastro_orcamento&cd_orcamento=<?php echo $cd_orcamento; ?>","_self");'>Excluir</button>
                    </div>
                    <div class="col-3">
                        <button class="w-100 btn btn-primary btn-lg" type="button" onclick='window.open("menu.php?modulo=cadastro_orcamento&cd_orcamento=0","_self");'>Novo</button>
                    </div>
            </form>
        </div>
    </div>

    <div class="col-md-5 col-lg-5" style='margin:6px;background-color:#EEEEEE;border-radius:9px;'>
        <center>
            <h3 style='font-size:14px;'>Disponíveis </h3>
        </center>
        <table style="width:100%">
            <tbody>
                <tr style='font-weight:bold'>
                    <td>Descrição</td>
                    <td style='text-align:right'>Quant</td>
                    <td style='text-align:right'>R$ Venda</td>
                </tr>
                <?
                $SQL = "select * from produtos where cd_produto not in (Select cd_produto_oi from orcamento_itens where cd_orcamento_oi = $cd_orcamento) order by ds_produto";
                $RPP = mysqli_query($conexao, $SQL) or print(mysqli_error());
                while ($RP = mysqli_fetch_array($RPP)) {
                    echo "<tr onClick='seleciona(" . $RP["cd_produto"] . "," . $RP["vl_venda"] . ")' >";
                    echo "<td>" . $RP["ds_produto"] . "</td>";
                    echo "<td style='text-align:right'>" . $RP["vl_estoque"] . "</td>";
                    echo "<td style='text-align:right'>" . $RP["vl_venda"] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="col-md-6 col-lg-6" style='margin:6px;background-color:#EEEEEE;border-radius:9px;'>
        <center>
            <h3 style='font-size:14px;'>Selecionados </h3>
        </center>
        <table style="width:100%">
            <tbody>
                <tr style='font-weight:bold'>
                    <td>Descrição</td>
                    <td style='text-align:right'>Quant</td>
                    <td style='text-align:right'>R$ Unit</td>
                    <td style='text-align:right'>Subtot</td>
                </tr>
                <?
                $SQL = "select * from orcamento_itens,produtos where cd_orcamento_oi = $cd_orcamento and cd_produto_oi=cd_produto order by ds_produto";
                $RPP = mysqli_query($conexao, $SQL) or print(mysqli_error());
                while ($RP = mysqli_fetch_array($RPP)) {
                    $oi = $RP["cd_oi"];
                    echo "<tr>";
                    echo "<td onClick='removendo(" . $RP["cd_produto"] . ")' >" . $RP["ds_produto"] . "</td>";
                    echo "<td style='text-align:right'><input type='number' id='qt" . $oi . "' name='qt" . $oi . "' value='" . $RP["vl_quantidade"] . "' style='text-align:right;width:60px;' onkeyup='if(event.keyCode===13){ ajusta(" . $oi . "); }'></td>";
                    echo "<td style='text-align:right'><input type='number' step='0.01' id='qu" . $oi . "' name='qu" . $oi . "' value='" . $RP["vl_unitario"] . "' style='text-align:right;width:72px;' onkeyup='if(event.keyCode===13){ajusta(" . $oi . "); }'></td>";
                    $subtotal = number_format($RP["vl_quantidade"] * $RP["vl_unitario"], "2", ",", ".");
                    $total += $RP["vl_quantidade"] * $RP["vl_unitario"];
                    echo "<td style='text-align:right'><input type='text' id='st" . $oi . "' name='st" . $oi . "' value='" . $subtotal . "' style='text-align:right;width:75px;' readonly='true'></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</main>
<script src="form-validation.js"></script>

<form action='sql.php' name='form_oi' id='form_oi' method='post' target='divo'>
    <input type='hidden' id='cd_or' name='cd_or' value='<? echo $cd_orcamento; ?>'>
    <input type='hidden' id='cd_oi' name='cd_oi'>
    <input type='hidden' id='vl_qu' name='vl_qu'>
    <input type='hidden' id='vl_un' name='vl_un'>
    <input type='hidden' id='acao' name='acao' value='atualiza_oi'>
</form>

<script>
    function ajusta(cd_oi) {
        document.getElementById("cd_oi").value = cd_oi;
        document.getElementById("vl_qu").value = document.getElementById("qt" + cd_oi).value;
        document.getElementById("vl_un").value = document.getElementById("qu" + cd_oi).value;
        var subtotal = (parseFloat(document.getElementById("vl_qu").value) * parseFloat(document.getElementById("vl_un").value));
        document.getElementById("st" + cd_oi).value = subtotal;
        form_oi.submit();
    }

    function seleciona(cd_produto, vl_venda) {
        window.open('menu.php?modulo=cadastro_orcamento&acao=insere_produto&cd_orcamento=<? echo $cd_orcamento; ?>&cd_produto=' + cd_produto + '&vl_venda=' + vl_venda, '_self')
    }

    function removendo(cd_produto) {
        window.open('menu.php?modulo=cadastro_orcamento&acao=remove_produto&cd_orcamento=<? echo $cd_orcamento; ?>&cd_produto=' + cd_produto, '_self')
    }
</script>