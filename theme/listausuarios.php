<?php $v->layout("_theme"); ?>

<!-- Main content -->
<section class="content mt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tabela Usuarios</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Usuário</th>
                                    <th>CPF</th>
                                    <th>E-mail</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($usuarios as $usuario) : ?>
                                    <tr data-id="<?= $usuario->cd_usuario ?>">
                                        <td><?= $usuario->cd_usuario ?></td>
                                        <td><?= $usuario->ds_usuario ?></td>
                                        <td><?= $usuario->ds_cpf ?></td>
                                        <td><?= $usuario->ds_email ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Usuário</th>
                                    <th>CPF</th>
                                    <th>E-mail</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        $("tr").click(function() {
            var id = $(this).data("id");
            $.post(" <?= $router->route("web.put.usuarios"); ?>", {
                idUser: id
            }, function(result) {}, "json");
        })
    });
</script>