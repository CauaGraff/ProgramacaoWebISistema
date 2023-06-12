<?php $v->layout("_theme"); ?>
<?php $v->start("css")?>
<style>
    td, th{
        text-align: center;
    }
</style>
<?php $v->end()?>
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
                                <?php if (!empty($usuarios)) : ?>
                                    <?php foreach ($usuarios as $usuario) : ?>
                                        <tr data-id="<?= $usuario->id ?>">
                                            <td><?= $usuario->id ?></td>
                                            <td><?= $usuario->nome ?></td>
                                            <td><?= $usuario->CPF ?></td>
                                            <td><?= $usuario->email ?></td>
                                            <td style="text-align: center;"><a href="<?= $router->route("usuarios.update", ["id" => $usuario->id]) ?>" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a></td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="6" style="text-align: center">Não há empresas cadastradas</td>
                                    </tr>
                                <?php endif ?>
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