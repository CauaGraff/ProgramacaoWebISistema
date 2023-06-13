<?php $v->layout('_theme') ?>

<script type="text/javascript">

</script>
<!-- Main content -->
<section class="content mt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header" id="header">
                        Novo Produto
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="" method="">
                        <input type="hidden" name="id" id="id" value="<?= intval($produtoId) ?>">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome ..." maxlength="18">
                                <small class="form-text rounded" data-alert="nome"></small>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="prco">Preço</label>
                                        <input type="number" class="form-control" id="prco" name="prco" min="0">
                                        <small class="form-text rounded" data-alert="prco"></small>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="qtd">Quantidade</label>
                                        <input type="number" class="form-control" id="qtd" name="qtd" min="0">
                                        <small class="form-text rounded" data-alert="qtd"></small>
                                    </div>
                                    <div class="col-4">
                                        <label for="id_uni" class="form-label">Unidade</span></label>
                                        <select id="id_uni" name="id_uni" class="form-control">
                                            <option value="">Selecione uma unidade</option>
                                            <?php foreach ($unis as $uni) : ?>
                                                <option value="<?= $uni->id; ?>"><?= $uni->descricao; ?> | <?= $uni->unid; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <small class="form-text rounded" data-alert="id_uni"></small>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="total">Total</label>
                                        <input type="text" class="form-control" id="total" name="total" min="0" disabled>
                                        <small class="form-text rounded" data-alert="total"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="descricao">Descricao</label>
                                <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Nome ..." maxlength="18">
                                <small class="form-text rounded" data-alert="descricao"></small>
                            </div>
                            <div class="form-group">
                                <label for="id_empresa" class="form-label">Fornecedor</span></label>
                                <select id="id_empresa" name="id_empresa" class="form-control">
                                    <option value="">Selecione um fornecedor</option>
                                    <?php foreach ($fornec as $for) : ?>
                                        <option value="<?= $for->id; ?>"><?= $for->razaoSocial; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="form-text rounded" data-alert="id_empresa"></small>
                            </div>
                        </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer d-flex justify-content-center gap-3">
                    <button id="sal" class="btn btn-success m-1">Salvar</button>
                    <button id="alt" class="btn btn-warning m-1">Alterar</button>
                    <button id="exc" class="btn btn-danger m-1">Excluir</button>
                    <button type="reset" class="btn  btn-primary m-1">Limpar</button>
                </div>
                </form>
            </div>
        </div>

    </div>
    </div>
</section>

<?php $v->start('js') ?>
<script src="<?= shared_js("formatacnpj.js") ?>"></script>
<script src="<?= shared_js("formatafone.js") ?>"></script>
<script>
    $(function() {
        $("#uf").change(function() {
            var value = $(this).val();
            $.post(" <?= $router->route("web.cidades"); ?>", {
                ufid: value
            }, function(result) {
                $("#cidade").empty();
                if (result) {
                    var options = '';
                    $.each(result, function(i, v) {
                        options = options + '<option value="' + v.cd_cidade + '">' + v.ds_cidade + '</option>'
                    });
                    $("#cidade").html(options);
                }
            }, "json");
        });

    });

    $(function() {
        $("form").submit(function(e) {
            e.preventDefault();
        });

        $("#cod").focus();
        var id;
        var cnpj;
        var razaoSocial;
        var fone;
        var uf;
        var cidade;
        var email;
        $("#sal").click(function() {
            sal();
        })
        $("#alt").click(function() {
            alterar();
        })
        $("#exc").click(function() {
            excluir();
        })
        $(document).ready(function() {
            empresa();
        })

        function empresa() {
            if (($("#id").val()) == 0) {
                console.log($("#id").val());
                return;
            }
            var id = $("#id").val();
            $.ajax({
                method: "POST",
                url: "<?= $router->route("empresas.post.dados"); ?>",
                data: {
                    "id": id
                },
                dataType: "json",
                error: function() {},
                success: function(response) {
                    if (response.type == "success") {
                        $("#CNPJ").val(response.data[0].CNPJ);
                        $("#razaoSocial").val(response.data[0].razaoSocial);
                        $("#fone").val(response.data[0].fone);
                        $("#uf").val(response.data[0].uf);
                        $("#email").val(response.data[0].email);
                        $.post(" <?= $router->route("web.cidades"); ?>", {
                            ufid: response.data[0].uf
                        }, function(result) {
                            $("#cidade").empty();
                            if (result) {
                                var options = '';
                                $.each(result, function(i, v) {
                                    options = options + '<option value="' + v.cd_cidade + '">' + v.ds_cidade + '</option>'
                                });
                                $("#cidade").html(options);
                                $('#cidade').val(response.data[0].id_cidade);
                            }
                        }, "json");;
                        $("#header").text("Atualizar dados Fornecedor ID " + response.data[0].id);
                    }
                },
                beforeSend: function() {}
            });
        }

        function sal() {
            cnpj = $("#CNPJ").val();
            razaoSocial = $("#razaoSocial").val();
            fone = $("#fone").val();
            uf = $("#uf").val();
            cidade = $("#cidade").val();
            email = $("#email").val();
            $.ajax({
                method: "POST",
                url: "<?= $router->route("empresas.post.register"); ?>",
                data: {
                    "CNPJ": cnpj,
                    "razaoSocial": razaoSocial,
                    "fone": fone,
                    "uf": uf,
                    "cidade": cidade,
                    "email": email
                },
                dataType: "json",
                error: function() {},
                success: function(response) {
                    $.each(response, function(indice, valor) {
                        var $campo = $(`[data-alert='${indice}']`)
                        $campo.addClass('text-danger');
                        $campo.html("<i class='fa-sharp fa-solid fa-circle-exclamation' style='color: #ef2929;'></i> " + valor);
                    })
                    if (response.type == "success") {
                        window.location.href = response.redirect
                    }
                },
                beforeSend: function() {
                    var $alert = $("[data-alert]");
                    $alert.removeClass("text-danger");
                    $alert.text("");
                }
            });
        }

        function excluir() {
            id = $("#id").val();

            $.ajax({
                method: "POST",
                url: "<?= $router->route("empresas.delet"); ?>",
                data: {
                    "id": id
                },
                dataType: "json",
                error: function() {},
                success: function(response) {
                    if (response.type == "error") {
                        alert("erro!!!");
                    }
                    if (response.type == "success") {
                        window.location.href = response.redirect;
                    }
                },
                beforeSend: function() {}
            });
        }

        function alterar() {
            id = $("#id").val();
            cnpj = $("#CNPJ").val();
            razaoSocial = $("#razaoSocial").val();
            fone = $("#fone").val();
            uf = $("#uf").val();
            cidade = $("#cidade").val();
            email = $("#email").val();
            $.ajax({
                method: "POST",
                url: "<?= $router->route("empresas.post.update"); ?>",
                data: {
                    "id": id,
                    "CNPJ": cnpj,
                    "razaoSocial": razaoSocial,
                    "fone": fone,
                    "uf": uf,
                    "cidade": cidade,
                    "email": email,
                    "type": "update"
                },
                dataType: "json",
                error: function() {},
                success: function(response) {
                    if (response.type == "error") {
                        $alert.addClass('alert-danger');
                        $alert.text(response.mensagem);
                    }
                    if (response.type == "success") {
                        window.location.href = response.redirect
                    }
                },
                beforeSend: function() {}
            });
        }
    });
</script>
<?php $v->end() ?>