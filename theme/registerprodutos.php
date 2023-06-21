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
                                        <label for="preco">Preço</label>
                                        <input type="text" class="form-control" id="preco" name="preco" min="0">
                                        <small class="form-text rounded" data-alert="preco"></small>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="qtd">Quantidade</label>
                                        <input type="number" class="form-control" id="qtd" name="qtd" min="0">
                                        <small class="form-text rounded" data-alert="qtd"></small>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="id_uni" class="form-label">Unidade</span></label>
                                        <select id="id_uni" name="id_uni" class="form-control">
                                            <option value="">Selecione uma unidade</option>
                                            <?php foreach ($unis as $uni) : ?>
                                                <option value="<?= $uni->id; ?>" title="<?= $uni->descricao ?>"><?= $uni->simbolo; ?></option>
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
                                <textarea class="form-control" id="descricao" name="descricao" placeholder="" style="height:125px! important"></textarea>
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
<script>
    $(function() {
        $("#id_uni").change(function() {
            var qtd = $("#qtd").val();
            var preco = $("#preco").val();
            var total = qtd * preco;
            $("#total").val(total.toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            }));
        })
    });
    $(function() {
        $("form").submit(function(e) {
            e.preventDefault();
        });

        var id;
        var nome;
        var preco;
        var qtd;
        var id_uni;
        var descricao;
        var id_empresa;
        $("#sal").click(function() {
            id = $("#id").val();
            if (id == 0) {
                sal();
            } else {
                alterar();
            }
        })
        $("#exc").click(function() {
            excluir();
        })
        $(document).ready(function() {
            prodto();
        })

        function prodto() {
            if (($("#id").val()) == 0) {
                return;
            }
            var id = $("#id").val();
            $.ajax({
                method: "POST",
                url: "<?= $router->route("produto.post.dados"); ?>",
                data: {
                    "id": id
                },
                dataType: "json",
                error: function() {},
                success: function(response) {
                    if (response.type == "success") {
                        $("#nome").val(response.data.nome);
                        $("#preco").val(response.data.preco);
                        $("#qtd").val(response.data.qtd);
                        $("#id_uni").val(response.data.id_uni);
                        $("#descricao").val(response.data.descricao);
                        $("#id_empresa").val(response.data.id_empresa);
                        $("#header").text("Atualizar dados Produto ID " + response.data.id);
                    }
                },
                beforeSend: function() {}
            });
        }

        function sal() {
            nome = $("#nome").val();
            preco = $("#preco").val();
            qtd = $("#qtd").val();
            id_uni = $("#id_uni").val();
            descricao = $("#descricao").val();
            id_empresa = $("#id_empresa").val();
            $.ajax({
                method: "POST",
                url: "<?= $router->route("produto.post.register"); ?>",
                data: {
                    "nome": nome,
                    "preco": preco,
                    "qtd": qtd,
                    "id_uni": id_uni,
                    "descricao": descricao,
                    "id_empresa": id_empresa
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
                url: "<?= $router->route("produto.delet"); ?>",
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
            nome = $("#nome").val();
            preco = $("#preco").val();
            qtd = $("#qtd").val();
            id_uni = $("#id_uni").val();
            descricao = $("#descricao").val();
            id_empresa = $("#id_empresa").val();
            $.ajax({
                method: "POST",
                url: "<?= $router->route("produto.post.update"); ?>",
                data: {
                    "id": id,
                    "nome": nome,
                    "preco": preco,
                    "qtd": qtd,
                    "id_uni": id_uni,
                    "descricao": descricao,
                    "id_empresa": id_empresa,
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