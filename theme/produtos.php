<?php $v->layout('_theme') ?>
<?php $v->start('css') ?>
<style>
    .produtos {
        display: flex;
        justify-content: space-evenly;
        flex-wrap: wrap;
        padding: 2rem;
    }
</style>
<?php $v->end() ?>
<div class="produtos">
    <?php if (!empty($produtos)) : ?>
        <?php foreach ($produtos as $produto) : ?>

            <div class="card" style="width: 18rem;">
                <img class="card-img-top" style="height: 10rem;" src="<?= $produto->imagem ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $produto->nome ?></h5>
                    <p class="card-text">
                        <?= mb_strimwidth($produto->descricao, 0, 80, '...') ?>
                    </p>
                    <form action="<?= $router->route('carrinho.add', ['produtoId' => $produto->id]) ?>" method="POST">
                        <div class="form-group">
                            <label for="quantidade" class="label-control">Qtd</label>
                            <input type="number" value="1" class="form-control" id="quantidade" name="quantidade">
                        </div>
                        <button class="btn btn-success" style="width: 100%;">Adicionar ao carrinho</button>
                    </form>
                </div>
            </div>

        <?php endforeach ?>
    <?php else : ?>
        <h5>Nenhum produto encontrado</h5>
    <?php endif ?>
</div>