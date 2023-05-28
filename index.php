<?php

session_start();

use CoffeeCode\Router\Router;

require __DIR__ . "/vendor/autoload.php";

/**
 * Definindo rotas
 */

$router = new Router(CONF_SITE_URL);

$router->namespace('Source\Controllers');

$router->group(null);

/** WEB */
$router->get('/', 'Web:home', 'web.home');
$router->get('/login', 'Web:login', 'web.login');
$router->get('/contato', 'Web:contato', 'web.contato');
$router->post('/cidades', 'Web:cidades', 'web.cidades');

$router->get('/cadastro', 'Web:register', 'web.register');
$router->post('/register', 'Web:register', 'web.post.register');

/**USUARIOS */
$router->get('/usuarios', 'Web:usuarios', 'web.usuarios');
$router->put('/usuarios/{id}', 'Web:atualizaUsuarios', 'web.put.usuarios');


/** AUTH */
$router->post('/login', 'Web:login', 'auth.login');
$router->get('/logout', 'Web:logout', 'auth.logout');

/** PRODUTOS */
$router->group('produtos');
$router->get('/', 'Produto:index', 'produto.index');

/** CARRINHO */
$router->group('carrinho');
$router->get('/', 'Carrinho:index', 'carrinho.index');
$router->post('/add/{produtoId}', 'Carrinho:add', 'carrinho.add');
$router->post('/remove/{produtoId}', 'Carrinho:remove', 'carrinho.remove');

$router->dispatch();

if ($router->error()) {
    echo "Houve um erro " . $router->error();
}
