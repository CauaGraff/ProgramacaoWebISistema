<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="<?= $router->route('web.home') ?>">
        Projeto
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav mr-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height: 100px;">
            <li class="nav-item active">
                <a class="nav-link" href="<?= $router->route('web.home') ?>">
                    Home <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= $router->route('carrinho.index') ?>">
                    Carrinho
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    Produtos
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                    <li>
                        <a class="dropdown-item" href="<?= $router->route('produto.index') ?>">
                            Todos
                        </a>
                    </li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled">Link</a>
            </li>
        </ul>
        <!--  -->
        <ul class="navbar-nav">
            <?php if (!$user) : ?>
                <li class="nav-item">
                    <a href="<?= $router->route('web.login') ?>" class="nav-link">Entrar</a>
                </li>
                <li class="nav-item">
                    <a href="<?= $router->route('web.register') ?>" class="nav-link">Cadastrar</a>
                </li>
            <?php endif ?>

            <?php if ($user) : ?>
                <li class="nav-item">
                    <a class="nav-link disabled"> Bem vindo(a) <?= $user->primeiro_nome ?> </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $router->route('auth.logout') ?>" class="nav-link">Sair</a>
                </li>
            <?php endif ?>
        </ul>
    </div>
</nav>