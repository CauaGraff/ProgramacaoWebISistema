<?php $v->layout('_theme') ?>

<!-- Main content -->
<section class="content mt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header" id="header">
                        Novo Cliente
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="" method="">
                        <input type="hidden" name="id" id="id" value="<?= intval($clienteId) ?>">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Nome do Cliente</label>
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome ...">
                                <small class="form-text rounded" data-alert="nome"></small>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">CPF Cliente</label>
                                        <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Somente números" MAXLENGTH="14">
                                        <small class="form-text rounded" data-alert="cpf"></small>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Data Nascimento</label>
                                        <input type="date" class="form-control" id="dataNasc" name="dataNasc">
                                        <small class="form-text rounded" data-alert="dataNasc"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="uf" class="form-label">UF</span></label>
                                        <select id="uf" name="uf" class="form-control">
                                            <option value="">Selecione um estado</option>
                                            <?php foreach ($ufs as $uf) : ?>
                                                <option value="<?= $uf->ds_uf; ?>"><?= $uf->ds_uf; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <small class="form-text rounded" data-alert="uf"></small>
                                    </div>
                                    <div class="col-9">
                                        <label for="cidade" class="form-label">Cidade</label>
                                        <div>
                                            <select id="cidade" name="cidade" class="form-control">
                                                <option value=""></option>
                                            </select>
                                            <small class="form-text rounded" data-alert="cidade"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="ncasa">Nº casa</label>
                                        <input type="text" class="form-control" id="ncasa" name="ncasa" placeholder="">
                                        <small class="form-text rounded" data-alert="ncasa"></small>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Telefone</label>
                                        <input type="text" class="form-control" id="fone" name="fone" maxlength="14" placeholder="Somente numeros">
                                        <small class="form-text rounded" data-alert="fone"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                                <small class="form-text rounded" data-alert="email"></small>
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
<script src="<?= shared_js("formatacpf.js") ?>"></script>
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
        var nome;
        var cpf;
        var dataNasc;
        var uf;
        var cidade;
        var ncasa;
        var fone;
        var email;
        var config;
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
            aluno();
        })

        function aluno() {
            if (($("#id").val()) == 0) {
                console.log($("#id").val());
                return;
            }
            var id = $("#id").val();
            $.ajax({
                method: "POST",
                url: "<?= $router->route("clientes.post.dados"); ?>",
                data: {
                    "id": id
                },
                dataType: "json",
                error: function() {},
                success: function(response) {
                    if (response.type == "success") {
                        $("#id").val(response.data[0].id);
                        $("#nome").val(response.data[0].nome);
                        $("#cpf").val(response.data[0].CPF);
                        $("#dataNasc").val(response.data[0].dataNasc);
                        $("#uf").val(response.data[0].uf);
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
                                $('#cidade').val(response.data[0].cidade_id);
                            }
                        }, "json");
                        $("#senha").val(response.data[0].senha);
                        $("#email").val(response.data[0].email);
                        $("#ncasa").val(response.data[0].ncasa);
                        $("#fone").val(response.data[0].fone);

                        $("#header").text("Atualizar dados Usuario id " + response.data[0].id);
                    }
                },
                beforeSend: function() {}
            });
        }

        function sal() {
            nome = $("#nome").val();
            cpf = $("#cpf").val();
            dataNasc = $("#dataNasc").val();
            uf = $("#uf").val();
            cidade = $("#cidade").val();
            ncasa = $("#ncasa").val();
            fone = $("#fone").val();
            email = $("#email").val();
            $.ajax({
                method: "POST",
                url: "<?= $router->route("clientes.post.register"); ?>",
                data: {
                    "nome": nome,
                    "cpf": cpf,
                    "dataNasc": dataNasc,
                    "uf": uf,
                    "cidade": cidade,
                    "ncasa": ncasa,
                    "email": email,
                    "fone": fone
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
                url: "<?= $router->route("usuarios.delet"); ?>",
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
            cpf = $("#cpf").val();
            dataNasc = $("#dataNasc").val();
            uf = $("#uf").val();
            cidade = $("#cidade").val();
            senha = $("#senha").val();
            email = $("#email").val();
            $.ajax({
                method: "POST",
                url: "<?= $router->route("usuarios.post.update"); ?>",
                data: {
                    "id": id,
                    "nome": nome,
                    "cpf": cpf,
                    "dataNasc": dataNasc,
                    "uf": uf,
                    "cidade": cidade,
                    "senha": senha,
                    "email": email,
                    "type": "update"
                },
                dataType: "json",
                error: function() {},
                success: function(response) {

                    if (response.type == "success") {
                        window.location.href = response.redirect
                    }
                },
                beforeSend: function() {

                }
            });
        }
    });
</script>
<?php $v->end() ?>