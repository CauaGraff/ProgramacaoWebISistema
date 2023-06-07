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

/** AUTH */
$router->post('/login', 'Web:login', 'auth.login');
$router->get('/logout', 'Web:logout', 'auth.logout');


/**USUARIOS */
$router->group('usuarios');
$router->get('/', 'Usuarios:index', 'usuarios.index');
$router->get('/cadastro', 'Usuarios:register', 'usuarios.register');
$router->post('/register', 'Usuarios:register', 'usuarios.post.register');
$router->get('/atualiza/{id}', 'Usuarios:update', 'usuarios.update');
$router->post('/update', 'Usuarios:update', 'usuarios.post.update');
$router->post('/dados', 'Usuarios:dados', 'usuarios.post.dados');
$router->post('/delet', 'Usuarios:delet', 'usuarios.delet');


/**EMPRESAS */
$router->group('empresas');
$router->get('/', 'Empresas:index', 'empresas.index');
$router->get('/cadastro', 'Empresas:register', 'empresas.register');
$router->post('/register', 'Empresas:register', 'empresas.post.register');
$router->get('/atualiza/{id}', 'Empresas:update', 'empresas.update');
$router->post('/update', 'Empresas:update', 'empresas.post.update');
$router->post('/dados', 'Empresas:dados', 'empresas.post.dados');
$router->post('/delet', 'Empresas:delet', 'empresas.delet');


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
