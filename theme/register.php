<?php $v->layout('_theme') ?>

<script type="text/javascript">

</script>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action='<?php
                                    if (intval($usuarioId) == 0) {
                                        echo $router->route("usuarios.post.register");
                                    } else {
                                        echo $router->route("usuarios.post.update");
                                    }

                                    ?>' method='post'>
                        <input type='hidden' name='id' id='id' value='<? echo intval($usuarioId); ?>'>
                        <input type='hidden' name='acao' id='acao' value='
                        <?php
                        if (intval($usuarioId) == 0) {
                            echo "save";
                        } else {
                            echo "update";
                        }

                        ?>'>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Nome do usuário</label>
                                <input type="text" class="form-control" id="ds_usuario" name="ds_usuario" placeholder="Nome ..." value='<?= $usuario->ds_usuario ?>'>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">CPF usuário</label>
                                        <input type="text" class="form-control" id="ds_cpf" name="ds_cpf" placeholder="CPF ..." value='<?= $usuario->ds_cpf ?>'>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Data Nascimento</label>
                                        <input type="date" class="form-control" id="dt_nascimento" name="dt_nascimento" value='<?= $usuario->ds_dataNasc ?>'>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="uf" class="form-label">UF</span></label>
                                        <select id="ds_uf" name="ds_uf" class="form-control">
                                            <option value="<?= $usuario->ds_estado ?>"><?= $usuario->ds_estado ?></option>
                                            <?php foreach ($ufs as $uf) : ?>
                                                <option value="<?= $uf->ds_uf; ?>"><?= $uf->ds_uf; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-9">
                                        <label for="cidade" class="form-label">Cidade</label>
                                        <div>
                                            <select id="ds_cidade" name="ds_cidade" class="form-control">
                                                <option value="<?= $usuario->ds_cidade ?>"></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="exampleInputPassword1">Senha</label>
                                        <input type="password" class="form-control" id="ds_senha" name="ds_senha" placeholder="Password" value='<?= $usuario->ds_senha ?>'>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" id="ds_email" name="ds_email" placeholder="Enter email" value='<?= $usuario->ds_email ?>'>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Salvar</button>
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
        $("#ds_uf").change(function() {
            var value = $(this).val();
            $.post(" <?= $router->route("web.cidades"); ?>", {
                ufid: value
            }, function(result) {
                $("#ds_cidade").empty();
                if (result) {
                    var options = '';
                    $.each(result, function(i, v) {
                        options = options + '<option value="' + v.cd_cidade + '">' + v.ds_cidade + '</option>'
                    });
                    $("#ds_cidade").html(options);
                }
            }, "json");
        });
    });


    $(function() {
        var $form = $("form");
        var $alert = $("div.alert");

        $form.submit(function(e) {
            e.preventDefault();

            var action = $form.attr('action');

            $.ajax({
                method: "POST",
                url: action,
                data: $form.serialize(),
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
        });
    });
</script>
<?php $v->end() ?>