<?php $v->layout('_theme'); ?>
<form action="<?= $router->route('auth.login') ?>" method="post" class="col-8">
    <div class="form-group">
        <label for="email">E-mail:</label>
        <input type="text" name="email" id="email" class="form-control">
    </div>

    <div class="form-group">
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" class="form-control">
    </div>

    <button class="btn btn-success" type="submit">Login</button>
</form>