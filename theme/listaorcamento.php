<?php $v->layout("_theme"); ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Orçamentos</h1>
        <a href="<?= $router->route("orcamento.cadastro"); ?>"><button type="button" class="btn btn-success">Novo</button></a>
    </div>

    <table id="example" class="table table-bordered table-hover" style="width:100%">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Dia</th>
                <th>Cliente</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($orcamentos)) : ?>
                <?php foreach ($orcamentos as $orcamento) : ?>
                    <tr data-id="<?= $orcamento->id ?>" title="Clique na linha para editar">
                        <td><?= $orcamento->id ?></td>
                        <td><?= $orcamento->dataOrcamento ?></td>
                        <td><?= $orcamento->nomeCliente ?></td>
                        <td><?= $orcamento->valor ?></td>
                    </tr>
                <?php endforeach ?>
            <?php else : ?>
                <tr>
                    <td colspan="6" style="text-align: center">Não há Orçamentos cadastradas</td>
                </tr>
            <?php endif ?>
        </tbody>
    </table>

</main>
<?php $v->start('js') ?>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
        $("tr").click(function() {
            var idOrcamento = $(this).data('id');
            console.log(idOrcamento);

        })
    });


    // function Clica(cd_orcamento) {
    //     window.open('menu.php?modulo=cadastro_orcamento&cd_orcamento=' + cd_orcamento, "_self");
    // }
</script>
<?php $v->end() ?>