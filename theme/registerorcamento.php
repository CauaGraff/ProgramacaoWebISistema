<?php $v->layout("_theme"); ?>

<?php $v->start("css"); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<?php $v->end(); ?>


<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <center>
        <h2>Orçamento Nº 0</h2>
    </center>
    <div class="row g-5">
        <div class="col-md-12 col-lg-12">
            <form class="needs-validation" novalidate action="menu.php">
                <div class="row g-3">
                    <div class="col-sm-3">
                        <label for="firstName" class="form-label">Dia</label>
                        <input type="date" class="form-control" id="dataOrcamento" name="dataOrcamento" value="" readonly='true'>
                    </div>

                    <div class="col">
                        <label for="cliente" class="form-label">Cliente</label>
                        <select name='cliente' id='cliente' class="form-control">

                        </select>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-3">Item: <span class="cart_amount">0</span></div>
                    <div class="col-sm-3">Total: R$ <span class="cart_total">0,00</span></div>
                    <div class="col"><button class="w-100 btn btn-primary btn-lg" data-action="<?= $router->route("cart.clear"); ?>">Limpar</button></div>
                    <div class="col"><a class="w-100 btn btn-primary btn-lg" href="<?= $router->route("web.order"); ?>">Concluir</a></div>
                </div>
                <hr class="my-4">

                <div class="row g-5">

            </form>
        </div>
    </div>

    <div class="col-md-5 col-lg-5" style='margin:6px;background-color:#EEEEEE;border-radius:9px;'>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Disponiveis</h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        <li class="page-item"><a class="page-link" href="#">«</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">»</a></li>
                    </ul>
                </div>
            </div>

            <div class="card-body p-0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Produto</th>
                            <th>QTD</th>
                            <th style="width: 40px">Preço</th>
                        </tr>
                    </thead>
                    <tbody>,
                        <?php foreach ($produtos as $produto) : ?>
                            <tr>
                                <td><?= $produto->id ?>.</td>
                                <td><?= $produto->nome ?></td>
                                <td> <?= $produto->qtd ?> </td>
                                <td><span class=" badge bg-success" style="width: 100%;"><?= $produto->paraBrl() ?></span></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-5 col-lg-5" style='margin:6px;background-color:#EEEEEE;border-radius:9px;'>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Selecionados</h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        <li class="page-item"><a class="page-link" href="#">«</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">»</a></li>
                    </ul>
                </div>
            </div>

            <div class="card-body p-0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Produto</th>
                            <th>QTD</th>
                            <th style="width: 40px">Preço</th>
                        </tr>
                    </thead>
                    <tbody>,
                        <?php foreach ($produtos as $produto) : ?>
                            <tr>
                                <td><?= $produto->id ?>.</td>
                                <td><?= $produto->nome ?></td>
                                <td> <?= $produto->qtd ?> </td>
                                <div class="cart-row-cell quant">

                                    <ul>
                                        <li><a href="#">-</a></li>

                                        <li>2</li>

                                        <li><a href="#">+</a></li>
                                    </ul>

                                </div>
                                <td><span class=" badge bg-success" style="width: 100%;"><?= $produto->paraBrl() ?></span></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</main>


<?php $v->start("js"); ?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#cliente').select2();
    });
</script>

<script>
    $(function() {
        $("[data-action]").click(function(e) {
            e.preventDefault();
            var data = $(this).data();

            $.post(data.action, function(cart) {
                ajaxCart(cart);
            }, "json");
        });

        $.post("<?= $router->route("cart.cart"); ?>", function(cart) {
            ajaxCart(cart);
        });


        function ajaxCart(cart) {
            var cart_message = $(".cart_message");
            var cart_amount = $(".cart_amount");
            var cart_total = $(".cart_total");
            var formater = Intl.NumberFormat("pt-BR", {
                style: "currency",
                currency: "BRL"
            });

            if (cart.message) {
                cart.message.fadeOut(200, function() {
                    $(this).html(cart.message).fadeIn(200);
                });
            } else {
                cart_message.fadeOut(200);
            }

            $("span[class^='item_']").html("0");
            if (cart.items) {
                $.each(cart.items, function(index, item) {
                    $(".item_" + item.id).html(item.amount);
                });
            }

            if (cart.amount) {
                cart_amount.html(cart.amount);

            } else {
                cart_amount.html("0");
            }

            if (cart.total) {
                cart_total.html(formater.format(cart.total));
            } else {
                cart_total.html("0,00");
            }
        }

    });
</script>
<?php $v->end(); ?>