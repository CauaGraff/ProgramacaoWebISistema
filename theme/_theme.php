<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= shared_plugins("fontawesome-free/css/all.min.css") ?>">
    <link rel="stylesheet" href="<?= shared_plugins("datatables-bs4/css/dataTables.bootstrap4.min.css") ?>">
    <link rel="stylesheet" href="<?= shared_plugins("datatables-responsive/css/responsive.bootstrap4.min.css") ?>">
    <link rel="stylesheet" href="<?= shared_plugins("datatables-buttons/css/buttons.bootstrap4.min.css") ?>">
    <link rel="stylesheet" href="<?= shared_css("adminlte.min.css") ?>">
    <?= $v->section('css') ?>
    <title>Sistema 2023</title>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="../../index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index.php?desconecta=sim" class="nav-link">Desconectar</a>
                </li>
            </ul>

        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="../../index3.html" class="brand-link">
                <img src="<?= shared_img("AdminLTELogo.png") ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= shared_img("user2-160x160.jpg") ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><? echo $_SESSION["DS_USUARIO"]; ?></a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Cadastros
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="menu.php?modulo=lista_usuarios" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Usuario</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="menu.php?modulo=cadastro_empresa" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Empresas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../forms/advanced.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Produtos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../forms/editors.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Editors</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../forms/validation.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Validation</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Charts
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="../charts/chartjs.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>ChartJS</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../charts/flot.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Flot</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../charts/inline.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Inline</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../charts/uplot.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>uPlot</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    Tables
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="../tables/simple.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Simple Tables</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../tables/data.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>DataTables</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../tables/jsgrid.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>jsGrid</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <? include $modulo . ".php"; ?>
        </div>
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>
    <?= $v->section('modal') ?>
    <script src="<?= shared_plugins("jquery/jquery.min.js") ?>"></script>
    <script src="<?= shared_plugins("bootstrap/js/bootstrap.bundle.min.js") ?>"></script>
    <script src="<?= shared_plugins("datatables/jquery.dataTables.min.js") ?>"></script>
    <script src="<?= shared_plugins("datatables-bs4/js/dataTables.bootstrap4.min.js") ?>"></script>
    <script src="<?= shared_plugins("datatables-responsive/js/dataTables.responsive.min.js") ?>"></script>
    <script src="<?= shared_plugins("datatables-responsive/js/responsive.bootstrap4.min.js") ?>"></script>
    <script src="<?= shared_plugins("datatables-buttons/js/dataTables.buttons.min.js") ?>"></script>
    <script src="<?= shared_plugins("datatables-buttons/js/buttons.bootstrap4.min.js") ?>"></script>
    <script src="<?= shared_plugins("jszip/jszip.min.js") ?>"></script>
    <script src="<?= shared_plugins("pdfmake/pdfmake.min.js") ?>"></script>
    <script src="<?= shared_plugins("pdfmake/vfs_fonts.js") ?>"></script>
    <script src="<?= shared_plugins("datatables-buttons/js/buttons.html5.min.js") ?>"></script>
    <script src="<?= shared_plugins("datatables-buttons/js/buttons.print.min.js") ?>"></script>
    <script src="<?= shared_plugins("datatables-buttons/js/buttons.colVis.min.js") ?>"></script>
    <script src="<?= shared_plugins("bs-custom-file-input/bs-custom-file-input.min.js") ?>"></script>
    <script src="<?= shared_js("js/adminlte.min.js") ?>"></script>
    <script src="<?= shared_js("js/de_mo.js") ?>"></script>

    <!-- Meus scripts -->
    <?= $v->section('js') ?>
</body>

</html>