<?php $v->layout("_theme") ?>

<div class="carrinho">
    <div class="box">
        <div class="box-header">
            <h3>Seu carrinho</h3>
        </div>
        <div class="box-body">
            <?php if (!empty($carrinho)) : ?>
                <table class="table table-striped table-hover table-bordered table-sm">
                    <thead>
                        <tr class="table-success">
                            <th>id</th>
                            <th>Nome</th>
                            <th>Descricao</th>
                            <th>Quantidade</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($carrinho as $produto) : ?>
                            <tr>
                                <td><?= $produto['produtoId'] ?></td>
                                <td><?= $produto['nome'] ?></td>
                                <td title="<?= $produto['descricao'] ?>">
                                    <?= mb_strimwidth($produto['descricao'], 0, 40, '...') ?>
                                </td>
                                <td data-td-id="<?= $produto["produtoId"] ?>"><?= $produto['quantidade'] ?></td>
                                <td>
                                    <button data-produto-id="<?= $produto['produtoId'] ?>" data-action="remove" class="btn btn-danger btn-sm">-</button>

                                    <button data-produto-id="<?= $produto['produtoId'] ?>" data-action="add" class="btn btn-success btn-sm">+</button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php else : ?>
                <small>Nenhum produto encontrado</small>
            <?php endif ?>
        </div>
    </div>
</div>
<?php $v->start('js') ?>
<script>
    $(function() {
        $("[data-action]").click(function() {
            var uri = "<?= $router->route('carrinho.index') ?>"
            var action = $(this).data('action');
            var produtoId = $(this).data('produto-id');
            var url = uri + "/" + action + "/" + produtoId;

            $.ajax({
                url: url,
                data: {
                    quantidade: "+=1"
                },
                method: 'POST',
                dataType: 'json',
                success: function(response) {
                    var novaQuantidade = response.quantidade;
                    $(`[data-td-id="${produtoId}"]`).text(novaQuantidade);
                }
            })
        })
    });
</script>
<?php $v->end() ?>