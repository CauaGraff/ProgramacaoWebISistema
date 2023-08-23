<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= shared_plugins("fontawesome-free/css/all.min.css") ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= shared_css("adminlte.min.css") ?>">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?= $router->route('web.home') ?>"><b>Sistema LTE</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-header">
                <p class="login-box-msg">Conecte-se</p>
            </div>
            <div class="card-body login-card-body">
                <form action="<?= $router->route("auth.login") ?>" method="post">
                    <div class="input-group mb-3">
                        <input type="email" id='email' name='email' class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" id='senha' name='senha' class="form-control" placeholder="Senha">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= shared_plugins("jquery/jquery.min.js") ?>"></script>
    <!-- ajax para mostrar mensagem do login -->
    <!-- Bootstrap 4 -->
    <script src="<?= shared_plugins("bootstrap/js/bootstrap.bundle.min.js") ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= shared_css("adminlte.min.js") ?>"></script>
</body>

</html>