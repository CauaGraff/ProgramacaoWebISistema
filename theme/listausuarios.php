<?php $v->layout("_theme"); ?>

<!-- Main content -->
<section class="content mt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="card-title">Tabela Usuarios</h3>
                        <div class="ml-3">
                            <a href="<?= $router->route("usuarios.register"); ?>"><button type="button" class="btn btn-success">Novo</button></a>
                        </div>
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
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($usuarios as $usuario) : ?>
                                    <tr data-id="<?= $usuario->cd_usuario ?>">
                                        <td><?= $usuario->cd_usuario ?></td>
                                        <td><?= $usuario->ds_usuario ?></td>
                                        <td><?= $usuario->ds_cpf ?></td>
                                        <td><?= $usuario->ds_email ?></td>
                                        <td><a href="<?= $router->route("usuarios.update", ["id" => $usuario->cd_usuario]) ?>" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Usuário</th>
                                    <th>CPF</th>
                                    <th>E-mail</th>
                                    <th>Ações</th>
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