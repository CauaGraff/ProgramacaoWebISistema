<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                        <div class="input-group mb-3">
                            <small data-alert="senha"></small>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" id='senha' name='senha' class="form-control" placeholder="Senha">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <small data-alert="senha"></small>
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
    <h1><a href="<?= $router->route('wds.index') ?>">Web Service --- http://192.168.0.101/ws/json</a></h1>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= shared_plugins("jquery/jquery.min.js") ?>"></script>
    <!-- ajax para mostrar mensagem do login -->
    <!-- Bootstrap 4 -->
    <script src="<?= shared_plugins("bootstrap/js/bootstrap.bundle.min.js") ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= shared_js("adminlte.min.js") ?>"></script>
    <script>
        $(document).ready(function() {
            var $form = $("form")
            $form.submit(function(event) {
                event.preventDefault();
                var action = $form.attr("action")
                $.ajax({
                    method: "POST",
                    url: action,
                    data: $form.serializeArray(),
                    dataType: "json",
                    error: function() {},
                    success: function(response) {
                        $.each(response, function(indice, valor) {
                            var $campo = $(`[data-alert='${indice}']`)
                            $campo.addClass('text-danger');
                            $campo.html("<i class='fa-sharp fa-solid fa-circle-exclamation' style='color: #ef2929;'></i> " + valor);

                        })
                        if (response.type == "erro") {
                            alert(response.mensagem)
                        }

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
            })
        })
    </script>
</body>

</html>