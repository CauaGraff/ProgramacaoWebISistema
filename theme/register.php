<?php $v->layout('_theme') ?>

<div class="container h-100">
    <div class="d-flex justify-content-center h-100">
        <div class="d-flex justify-content-center card-body">
            <form action="<?= $router->route('web.post.register') ?>" method="POST" class="col-5">
                <div class="alert"></div>
                <div class="form-group">
                    <label for="primeiroNome">Primeiro Nome:</label>
                    <input type="text" name="primeiroNome" id="primeiroNome" class="form-control">
                </div>

                <div class="form-group">
                    <label for="sobrenome">Sobrenome:</label>
                    <input type="text" name="sobrenome" id="sobrenome" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="text" name="email" id="email" class="form-control">
                </div>

                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" name="senha" id="senha" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Cadastrar</button>
                <button type="reset" class="btn btn-secondary">Limpar</button>
            </form>
        </div>
    </div>
</div>

<?php $v->start('js') ?>
<script>
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