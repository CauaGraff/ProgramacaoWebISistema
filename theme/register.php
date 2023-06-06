<?php $v->layout('_theme') ?>

<script type="text/javascript">

</script>
<!-- Main content -->
<section class="content mt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        Novo Usuario
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="" method="">
                        <input type='hidden' name='id' id='id' value=''>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Nome do usuário</label>
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome ...">
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">CPF usuário</label>
                                        <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF ...">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Data Nascimento</label>
                                        <input type="date" class="form-control" id="dataNasc" name="dataNasc">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="uf" class="form-label">UF</span></label>
                                        <select id="uf" name="uf" class="form-control">
                                            <option value=""></option>
                                            <?php foreach ($ufs as $uf) : ?>
                                                <option value="<?= $uf->ds_uf; ?>"><?= $uf->ds_uf; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-9">
                                        <label for="cidade" class="form-label">Cidade</label>
                                        <div>
                                            <select id="cidade" name="cidade" class="form-control">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="exampleInputPassword1">Senha</label>
                                        <input type="password" class="form-control" id="senha" name="senha" placeholder="Password">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
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
        var cod;
        var nome;
        var exercicio;
        var frases;
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
        $("#cod").keyup(function() {
            aluno();
        })

        function aluno() {
            if (($("#cod").val().length) != 4) {
                return;
            }
            var config = {
                "cod": $("#cod").val()
            };
            $.post("source/aluno.php", config, function(data) {
                data = JSON.parse(data);
                if (!data.erro) {
                    var nome = data.nome;
                    exercicio = data.exercicio;
                    frases = data.frases;
                    $("#nome").val(nome);
                    $("#exercicio").val(exercicio);
                    $("#frases").val(frases);
                } else {
                    $("#nome").val("");
                    $("#exercicio").val("1");
                    $("#frases").val("0");
                    $("#nome").focus();
                }

                $("input").each(function(i, e) {
                    if ($(this).val()) {
                        $(this).siblings().addClass("up");
                    }
                });

            });
        }

        function sal() {
            var id = $("#id").val();
            var nome = $("#nome").val();
            var cpf = $("#cpf").val();
            var dataNasc = $("#dataNasc").val();
            var uf = $("#uf").val();
            var cidade = $("#cidade").val();
            var senha = $("#senha").val();
            var email = $("#email").val();
            var config = {
                "nome": nome,
                "cpf": cpf,
                "dataNasc": dataNasc,
                "uf": uf,
                "cidade": cidade,
                "senha": senha,
                "email": email
            }
            $.post("<?= $router->route("usuarios.post.register"); ?>",
                config,
                function(result) {
                    if (result.type == "success") {
                        window.location.replace(result.redirect)

                    } else if (data.type == "erro") {
                        alert("Erro ao cadastrar aluno.");
                    } else if (data.type == "existe") {
                        alert("Aluno já existe.");
                    } else {
                        alert("Erro desconhecido.");
                    }

                }, "json");
        }

        function excluir() {
            cod = $("#cod").val();
            config = {
                "cod": cod
            }
            $.post("source/excluir.php", config, function(data) {
                data = JSON.parse(data);
                if (data.situacao == "sucesso") {
                    alert("Aluno excluído com sucesso!");
                    $("#cod").val("");
                    $("#nome").val("");
                    $("#exercicio").val("1");
                    $("#frases").val("0");
                    $("#cod").focus();
                } else {
                    alert("Erro ao excluir aluno.");
                }
            })
        }

        function alterar() {
            cod = $("#cod").val();
            nome = $("#nome").val();
            exercicio = $("#exercicio").val();
            frases = $("#frases").val();
            config = {
                "cod": cod,
                "nome": nome,
                "exercicio": exercicio,
                "frases": frases
            }
            $.post("source/alterar.php", config, function(data) {
                data = JSON.parse(data);
                if (data.situacao == "sucesso") {
                    alert("Aluno alterado com sucesso!");
                } else if (data.situacao == "erro") {
                    alert("Erro ao alterar aluno.");
                } else if (data.situacao == "n_existe") {
                    alert("Aluno não existe.");
                } else {
                    alert("Erro desconhecido.");
                }

            });
        }
    });


    // $(function() {
    //     var $form = $("form");
    //     var $alert = $("div.alert");

    //     $form.submit(function(e) {
    //         e.preventDefault();

    //         var action = $form.attr('action');

    //         $.ajax({
    //             method: "POST",
    //             url: action,
    //             data: $form.serialize(),
    //             dataType: "json",
    //             error: function() {},
    //             success: function(response) {
    //                 if (response.type == "error") {
    //                     $alert.addClass('alert-danger');
    //                     $alert.text(response.mensagem);
    //                 }

    //                 if (response.type == "success") {
    //                     window.location.href = response.redirect
    //                 }
    //             },
    //             beforeSend: function() {}
    //         });
    //     });
    // });
</script>
<?php $v->end() ?>