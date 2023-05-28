<?php $v->layout('_theme') ?>

<script type="text/javascript">

</script>

<?php

// $acao        = $_REQUEST['acao'];
// $cd_usuario    = intval($_REQUEST['cd_usuario']);
// if ($acao == "excluir") {
//     echo "DELETE FROM usuarios where cd_usuario=$cd_usuario";
//     $RSS = mysqli_query($conexao, "DELETE FROM usuarios where cd_usuario=$cd_usuario");
//     $cd_usuario = 0;
// }

// if ($acao == "salvar") {
//     $SQL = "select * from usuarios where cd_usuario=" . $cd_usuario;
//     $RSS = mysqli_query($conexao, $SQL) or print(mysqli_error());
//     $RSX = mysqli_fetch_assoc($RSS);
//     if ($RSX["cd_usuario"] == $cd_usuario) {
//         $SQL  = "update usuarios set ds_usuario='" . addslashes($_REQUEST['ds_usuario']) . "',";
//         $SQL .= "ds_celular='" . addslashes($_REQUEST['ds_celular']) . "', ";
//         $SQL .= "ds_cpf='" . addslashes($_REQUEST['ds_cpf']) . "', ";
//         $SQL .= "ds_email='" . addslashes($_REQUEST['ds_email']) . "', ";
//         $SQL .= "ds_senha='" . addslashes($_REQUEST['ds_senha']) . "', ";
//         $SQL .= "dt_nascimento='" . addslashes($_REQUEST['dt_nascimento']) . "' ";
//         $SQL .= "where cd_usuario = '" . $RSX["cd_usuario"] . "'";
//         $RSS = mysqli_query($conexao, $SQL) or die($SQL);
//         //	echo "<script language='JavaScript'>alert('Operacao realizada com sucesso.');</script>";
//     } else {
//         $SQL  = "Insert into usuarios (ds_usuario,ds_celular,ds_cpf,ds_email,ds_senha,dt_nascimento) ";
//         $SQL .= "VALUES ('" . addslashes($_REQUEST['ds_usuario']) . "',";
//         $SQL .= "'" . addslashes($_REQUEST['ds_celular']) . "',";
//         $SQL .= "'" . addslashes($_REQUEST['ds_cpf']) . "',";
//         $SQL .= "'" . addslashes($_REQUEST['ds_email']) . "',";
//         $SQL .= "'" . addslashes($_REQUEST['ds_senha']) . "',";
//         $SQL .= "'" . addslashes($_REQUEST['dt_nascimento']) . "')";
//         $RSS = mysqli_query($conexao, $SQL) or die('erro');

//         $SQL = "select * from usuarios  order by cd_usuario desc limit 1";
//         $RSS = mysqli_query($conexao, $SQL) or print(mysqli_error());
//         $RSX = mysqli_fetch_assoc($RSS);
//         $cd_usuario = $RSX["cd_usuario"];
//         //	echo "<script>alert('Registro Inserido.');</script>";
//     }
//     echo "<script>window.open('menu.php?modulo=lista_usuarios', '_self');</script>";
// }

// $SQL = "select * from usuarios where cd_usuario = $cd_usuario";
// $RSS = mysqli_query($conexao, $SQL) or print(mysqli_error());
// $RS = mysqli_fetch_assoc($RSS);

?>

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
                    <form action='<?= $router->route("web.post.register") ?>' method='post'>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Nome do usuário</label>
                                <input type="text" class="form-control" id="ds_usuario" name="ds_usuario" placeholder="Nome ..." value=''>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">CPF usuário</label>
                                        <input type="text" class="form-control" id="ds_cpf" name="ds_cpf" placeholder="CPF ..." value=''>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Data Nascimento</label>
                                        <input type="date" class="form-control" id="dt_nascimento" name="dt_nascimento" value=''>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="uf" class="form-label">UF</span></label>
                                        <select id="ds_uf" name="ds_uf" class="form-control">
                                            <?php foreach ($ufs as $uf) : ?>
                                                <option value="<?= $uf->ds_uf; ?>"><?= $uf->ds_uf; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-9">
                                        <label for="cidade" class="form-label">Cidade</label>
                                        <div>
                                            <select id="ds_cidade" name="ds_cidade" class="form-control">

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="exampleInputPassword1">Senha</label>
                                        <input type="password" class="form-control" id="ds_senha" name="ds_senha" placeholder="Password" value=''>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" id="ds_email" name="ds_email" placeholder="Enter email" value=''>
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