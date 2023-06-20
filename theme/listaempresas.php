<?php $v->layout("_theme"); ?>
<?php $v->start("css") ?>
<style>
    td,
    th {
        text-align: center;
    }
</style>
<?php $v->end() ?>
<!-- Main content -->
<section class="content mt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="card-title">Tabela Fornecedores</h3>
                        <div class="ml-3">
                            <a href="<?= $router->route("empresas.register"); ?>"><button type="button" class="btn btn-success">Novo</button></a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>CNPJ</th>
                                    <th>Razão Social</th>
                                    <th>E-mail</th>
                                    <th>Telefone</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($empresas)) : ?>
                                    <?php foreach ($empresas as $empresa) : ?>
                                        <tr data-id="<?= $empresa->id ?>">
                                            <td><?= $empresa->id ?></td>
                                            <td><?= $empresa->CNPJ ?></td>
                                            <td><?= $empresa->razaoSocial ?></td>
                                            <td><?= $empresa->email ?></td>
                                            <td><?= $empresa->fone ?></td>
                                            <td style="text-align: center;"><a href="<?= $router->route("empresas.update", ["id" => $empresa->id]) ?>" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a></td>
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
                                    <th>CNPJ</th>
                                    <th>Razão Social</th>
                                    <th>E-mail</th>
                                    <th>Telefone</th>
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